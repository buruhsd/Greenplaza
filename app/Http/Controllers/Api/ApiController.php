<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\Models\Produk_grosir;
use App\Models\Log_wallet;
use App\Models\log_transfer;
use App\Models\Shipment;
use App\User;
use App\Models\User_address;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;
use App\Models\Trans_voucher;
use App\Models\Trans;
use App\Models\Trans_gln;
use RajaOngkir;

class ApiController extends Controller
{
    public function done_gln($id){
        $status = 200;
        $message = 'Transaksi berhasil dibayar.';
        $trx = Trans::find($id);
        $order_id = $trx->trans_code;
        $data = [
            'order_id' => $order_id,
            'transaction_status' => 'done'
        ];
        $trans = Trans::whereRaw('trans_code="'.$order_id.'"');
        $address_gln = $trx->pembeli->wallet()->where('wallet_type', 7)->first()->wallet_address;
        $response = FunctionLib::gln('ballance', ['address'=>$address_gln]);
        if($response['status'] == 500){
            $status = 500;
            $message = 'Transaksi gagal dibayar atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
            return redirect('member/transaction/purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $to_address = FunctionLib::get_config('profil_gln_address');
        $seller_address = ($trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists())
            ?$trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists()
            :false;

        if(!$seller_address || $seller_address == null || $seller_address == ""){
            $status = 500;
            $message = 'Seller tidak melayani pembayaran menggunakan GLN.';
            return redirect('member/transaction/purchase')
               ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        return [$response, $to_address, $seller_address];
        
        $amount_total = 0;
        $amount = 0;
        $fee = 0;
        if(!$trans->first()->trans_gln()->exists()){
            if($trans->first()->voucher()){
                $transaksi = $trans->first();
                // rupiah
                $trans_amount = $transaksi->trans_amount;
                $trans_amount_ship = $transaksi->trans_amount_ship;
                $trans_amount_total = FunctionLib::minus_to_zero($transaksi->trans_amount_total - $trans->first()->voucher()->trans_voucher_amount);
                if($trans_amount_total > 0){
                    $trans_fee = (FunctionLib::minus_to_zero($trans_amount - $trans->first()->voucher()->trans_voucher_amount)*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                }else{
                    $trans_fee = 0;
                }
                // gln
                $trans_amount = $trans_amount_total / FunctionLib::gln('compare',[])['data'];
                $trans_amount = round($trans_amount,8, PHP_ROUND_HALF_DOWN);
                $trans_fee = $trans_fee / FunctionLib::gln('compare',[])['data'];
                $trans_fee = round($trans_fee,8, PHP_ROUND_HALF_UP);
                $trans_amount_total = $trans_amount+$trans_fee;
                // untuk insert
                $wallet_to = ($transaksi->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists())
                    ?$transaksi->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->first()->wallet_address
                    :$transaksi->trans_detail->first()->produk->user->id;

                // simpan trans gln 
                $gln = new Trans_gln;
                $gln->trans_gln_form=$address_gln;
                $gln->trans_gln_admin=$to_address;
                $gln->trans_gln_to=$wallet_to;
                $gln->trans_gln_trans_id=$transaksi->id;
                $gln->trans_gln_trans_code=$transaksi->trans_code;
                $gln->trans_gln_detail_id=0;
                $gln->trans_gln_detail_code=0;
                $gln->trans_gln_amount=$trans_amount;
                $gln->trans_gln_amount_fee=$trans_fee;
                $gln->trans_gln_amount_total=$trans_amount_total;
                $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                $gln->trans_gln_note='transfer gln untuk transaksi produk (voucher+gln) sebesar '.$trans_amount_total.' GLN dari member ke admin termasuk fee.';
                $gln->save();

                $amount_total = $amount_total + $trans_amount_total;
            }else{
                foreach ($trans->get() as $item) {
                    foreach ($item->trans_detail as $item2) {
                        // rupiah
                        $detail_amount = $item2->trans_detail_amount;
                        $detail_amount_ship = $item2->trans_detail_amount_ship;
                        $detail_fee = ($detail_amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                        // gln
                        $detail_amount = ($detail_amount + $detail_amount_ship) / FunctionLib::gln('compare',[])['data'];
                        $detail_amount = round($detail_amount,8, PHP_ROUND_HALF_DOWN);
                        // $detail_amount_ship = $detail_amount_ship / FunctionLib::gln('compare',[])['data'];
                        // $detail_amount_ship = round($detail_amount_ship,8, PHP_ROUND_HALF_DOWN);
                        $detail_fee = $detail_fee / FunctionLib::gln('compare',[])['data'];
                        $detail_fee = round($detail_fee,8, PHP_ROUND_HALF_UP);
                        // $detail_amount_total = $detail_amount+$detail_fee+$detail_amount_ship;
                        $detail_amount_total = $detail_amount+$detail_fee;
                        // untuk insert
                        $wallet_to = ($item2->produk->user->wallet()->where('wallet_type', 7)->exists())
                            ?$item2->produk->user->wallet()->where('wallet_type', 7)->first()->wallet_address
                            :$item2->produk->user->id;

                        // simpan trans gln 
                        $gln = new Trans_gln;
                        $gln->trans_gln_form=$address_gln;
                        $gln->trans_gln_admin=$to_address;
                        $gln->trans_gln_to=$wallet_to;
                        $gln->trans_gln_trans_id=$item2->trans->id;
                        $gln->trans_gln_trans_code=$item2->trans->trans_code;
                        $gln->trans_gln_detail_id=$item2->id;
                        $gln->trans_gln_detail_code=$item2->trans_code;
                        // $gln->trans_gln_amount=$detail_amount+$detail_amount_ship;
                        $gln->trans_gln_amount=$detail_amount;
                        $gln->trans_gln_amount_fee=$detail_fee;
                        $gln->trans_gln_amount_total=$detail_amount_total;
                        $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                        $gln->trans_gln_note='transfer gln untuk transaksi produk sebesar '.$detail_amount_total.' GLN dari member ke admin termasuk fee.';
                        $gln->save();

                        $amount_total = $amount_total + $detail_amount_total;
                    }
                }
            }
        }else{
            foreach ($trans->get() as $item) {
                $amount_total = $amount_total + FunctionLib::array_sum_key($item->trans_gln()->get()->toArray(), 'trans_gln_amount_total');
            }
        }
        if($trans->first()->voucher()){
            if($amount_total > 0){
                $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$amount_total,'address'=>$address_gln]);
            }else{
                $transfer['status'] = 200;
            }
            if($transfer['status'] == 200){
                // update wallet admin
                $update_wallet = [
                    'user_id'=>2,
                    'wallet_type'=>1, //update wallet cw
                    'amount'=>$trans->first()->voucher()->trans_voucher_amount,
                    'note'=>'Transaksi transfer '.$trx->pembeli->id.'. Update wallet cw dengan kode transaksi '.$trans->first()->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
            }
        }else{
            $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$amount_total,'address'=>$address_gln]);
        }
        if($transfer['status'] == 200){
            foreach ($trans->get() as $item) {
                $gln = $item->trans_gln()->get();
                foreach ($gln as $item) {
                    $item->trans_gln_status=1;
                    $item->save();
                }
            }

            $response = FunctionLib::done_gln($data);
            if($response['status'] == 500){
                $status = $response['status'];
                $message = $response['message'];
            }
        }else{
            $status = 500;
            $message = 'transfer gagal atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
        }
        return response()->json(['status' => $status,'message' => $message]);
    }

    public function gln(){
        return response()->json(FunctionLib::gln('compare', []));
    }

    /**
    * mendapatkan data konfirmasi pembayaran
    **/
    public function konfirmasi(Request $request, $id)
    {
        $where = 'trans_detail_trans_id ='.$id;
        // status transaksi
        $w_status = ' AND trans_detail_status = 1 AND trans_detail_is_cancel != 1'; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'), 'sys_produk.produk_name')
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    public function saveCheckout(Request $request){
        $status = 200;
        if($request->has('chart') && FunctionLib::array_sum_key($request->get('chart'), 'price') > 0){
            $data = $request->get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            $trans_code = FunctionLib::str_rand(7);
            $tc_detail = FunctionLib::str_rand(8);
            $gross_amount = 0;
            foreach ($trans as $value) {
                foreach ($value as $key => $item) {
                    $produk = Produk::findOrFail($item['id']);
                    if($item['qty'] > $produk->produk_stock){
                        $status = 500;
                        $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;
                        return response()->json(['status' => $status, 'message' => $message]);
                    }
                }
                // return ['request'=>$request->all(), 'user' => User::find($request->get('id'))];
                // add to DB sys_trans
                $bank_id = User::find($request->get('id'))->user_bank()->where('user_bank_status', 1)->first()['id'];
                if(!$bank_id || empty($bank_id) || $bank_id == null){
                    $status = 500;
                    $message = 'Silahkan isikan data bank anda.';
                    return response()->json(['status' => $status, 'message' => $message]);
                }
                $trans = new Trans;
                $trans->trans_code = $trans_code;
                $trans->trans_user_id = $request->get('id');
                $trans->trans_user_bank_id = $bank_id;
                $trans->trans_payment_id = 4;
                $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
                $trans->save();
                foreach ($value as $key => $item) {
                    $produk = Produk::findOrFail($item['id']);
                    $price = ($produk['produk_price']*$item['qty']); //harga produk
                    // return ['produk'=>$produk, 'price'=>$price, 'produk_price' => $produk['produk_price'], 'qty' => $item['qty']]; 
                    // check grosir dan diskon
                    if($produk->grosir()->exists()){
                        foreach ($produk->grosir()->get() as $grosir) {
                            if($item['qty'] >= $grosir->produk_grosir_start && $item['qty'] <= $grosir->produk_grosir_end){
                                // update grosir
                                $price = ($grosir->produk_grosir_price * $item['qty']);
                                // update diskon
                                $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
                                    ?$price-($price*$produk['produk_discount']/100)
                                    :$price;
                                $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['paket']['cost'][0]['value'];
                            }else{
                                // update diskon
                                $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
                                    ?$price-($price*$produk['produk_discount']/100)
                                    :$price;
                                $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['paket']['cost'][0]['value'];
                            }
                        }
                    }else{
                        // check diskon
                        if($produk['produk_discount'] > 0){
                            $item['trans_detail_amount'] = $price-($price*$produk['produk_discount']/100);
                            $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['paket']['cost'][0]['value'];
                        }
                    }
                    $transDetail = new Trans_detail;
                    $transDetail->trans_detail_trans_id = $trans->id;
                    $transDetail->trans_code = $tc_detail;
                    $transDetail->trans_detail_produk_id = $item['id'];
                    $transDetail->trans_detail_shipment_id = $item['courier'];
                    $transDetail->trans_detail_shipment_service = $item['paket']['service'];
                    $transDetail->trans_detail_user_address_id = $item['alamat'];
                    $transDetail->trans_detail_qty = $item['qty'];
                    $transDetail->trans_detail_size = $item['size'];//'s,m,l,xl';
                    $transDetail->trans_detail_color = $item['color'];//'blue,orange,red,green,white';
                    $transDetail->trans_detail_amount = $item['trans_detail_amount'];
                    $transDetail->trans_detail_amount_ship = $item['paket']['cost'][0]['value'];
                    $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
                    $transDetail->trans_detail_status = 1;
                    $transDetail->trans_detail_note = "Transaction ".$tc_detail." at ".date("d-M-Y_H-i-s")."";
                    $transDetail->save();
                    // update stock
                    $produk->produk_stock = $produk->produk_stock - $item['qty'];
                    $produk->save();
                }
                // update amount trans
                $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
                $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
                $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
                $gross_amount += $trans->trans_amount_total;
                $trans->save();
                // send email seller
                // if($trans->trans_detail->first()->exists()){
                //     $send_status = FunctionLib::trans_arr(1);
                //     $config = [
                //         'to' => $trans->trans_detail->first()->produk->user->email,
                //         'data' => [
                //             'trans_code' => $trans->trans_code,
                //             'trans_amount_total' => $trans->trans_amount_total,
                //             'status' => $send_status,
                //         ]
                //     ];
                //     $send_notif = FunctionLib::transaction_notif($config);
                //     if(isset($send_notif['status']) && $send_notif['status'] == 200){
                //         $message .= ' ,'.$send_notif['message'];
                //     }
                // }
            }
            // if(isset($trans->pembeli->email)){
            //     // send email
            //     $send_status = FunctionLib::trans_arr(1);
            //     $config = [
            //         'to' => $trans->pembeli->email,
            //         'data' => [
            //             'trans_code' => $trans_code,
            //             'trans_amount_total' => $gross_amount,
            //             'status' => $send_status,
            //         ]
            //     ];
            //     $send_notif = FunctionLib::transaction_notif($config);
            //     if(isset($send_notif['status']) && $send_notif['status'] == 200){
            //         $message .= ' ,'.$send_notif['message'];
            //     }
            // }

            $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
            $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
            $response['trans_detail'] = $trans_detail;
            $response['trans_id'] = $trans->id;
            return response()->json(['status' => $status, 'data'=>$response]);
        }else{
            $status = 500;
            $message = 'Barang yang anda masukkan ke keranjang kosong.';
            return ['status' => $status, 'message' => $message];
        }
    }

    public function buy(Request $request, $type){
        $status = 200;
        $data = ['berhasil'];
        return response()->json(['status' => $status, 'data'=>$data]);
    }
    /**
    * pembayaran dengan masedi + poin
    **/
    // public function payment_poin(Request $request){
    //     if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
    //         $data = Session::get('chart');
    //         $trans = [];
    //         array_walk($data, function ($item) use (&$trans) {
    //             $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
    //             $trans[$seller_id][] = $item;
    //         });
    //         $trans_code = FunctionLib::str_rand(7);
    //         $gross_amount = 0;
    //         $poin = 0;
    //         $price_poin = FunctionLib::masedi('tukar_poin');
    //         if($price_poin['status'] == 200){
    //             $harga_poin = $price_poin['data']['rupiah'];
    //         }else{
    //             $status = 500;
    //             $message = 'Gagal mendapatkan harga tukar poin. Mohon maaf server sedang mengalami masalah dengan masedi.';
    //             return ['status' => $status, 'message' => $message];
    //         }
    //         foreach ($trans as $key1 => $value) {
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 if($item['trans_detail_qty'] > $produk->produk_stock){
    //                     $status = 500;
    //                     $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;//.', item order akan otomatis dihapus dari chart.';

    //                     return ['status' => $status, 'message' => $message];
    //                 }
    //             }
    //             // add to DB sys_trans
    //             $bank_id = Auth::user()->user_bank()->where('user_bank_status', 1)->first()['id'];
    //             if(!$bank_id || empty($bank_id) || $bank_id == null){
    //                 $status = 500;
    //                 $message = 'Silahkan isikan data bank anda.';
    //                 return ['status' => $status, 'message' => $message];

    //             }
    //             $persen_poin = FunctionLib::UserConfig('user_poin', $key1);
    //             $total_poin = 0;
    //             $total_wallet = 0;
    //             $total_wallet_poin = 0;

    //             $trans = new Trans;
    //             $trans->trans_code = $trans_code;
    //             $trans->trans_user_id = Auth::id();
    //             $trans->trans_user_bank_id = $bank_id;
    //             $trans->trans_payment_id = 6;//pw
    //             $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
    //             $trans->save();
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 $price = ($produk['produk_price']*$item['trans_detail_qty']); //harga produk
    //                 // check grosir dan diskon
    //                 if($produk->grosir()->exists()){
    //                     foreach ($produk->grosir()->get() as $grosir) {
    //                         if($item['trans_detail_qty'] >= $grosir->produk_grosir_start && $item['trans_detail_qty'] <= $grosir->produk_grosir_end){
    //                             // update grosir
    //                             $price = ($grosir->produk_grosir_price * $item['trans_detail_qty']);
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }else{
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }
    //                     }
    //                 }else{
    //                     // check diskon
    //                     if($produk['produk_discount'] > 0){
    //                         $item['trans_detail_amount'] = $price-($price*$produk['produk_discount']/100);
    //                         $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                     }
    //                 }
    //                 // harga persen poin per produk
    //                 $persen_produk = $produk['produk_poin'];

    //                 $transDetail = new Trans_detail;
    //                 $transDetail->trans_detail_trans_id = $trans->id;
    //                 $transDetail->trans_code = $item['trans_code'];
    //                 $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
    //                 $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
    //                 $transDetail->trans_detail_shipment_service = $item['trans_detail_shipment_service'];
    //                 $transDetail->trans_detail_user_address_id = $item['trans_detail_user_address_id'];
    //                 $transDetail->trans_detail_qty = $item['trans_detail_qty'];
    //                 $transDetail->trans_detail_size = $item['trans_detail_size'];//'s,m,l,xl';
    //                 $transDetail->trans_detail_color = $item['trans_detail_color'];//'blue,orange,red,green,white';
    //                 $transDetail->trans_detail_amount = $item['trans_detail_amount'];
    //                 $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
    //                 $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
    //                 $transDetail->trans_detail_persen_poin = $persen_produk;
    //                 $transDetail->trans_detail_amount_poin = ($item['trans_detail_amount_total'] / 100 * $persen_produk) / $harga_poin;
    //                 $transDetail->trans_detail_status = 1;
    //                 $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
    //                 $transDetail->save();
    //                 // update stock
    //                 $produk->produk_stock = $produk->produk_stock - $item['trans_detail_qty'];
    //                 $produk->save();

    //                 // memasukkan poin per produk ke total untuk pembayaran masedi
    //                 $total_poin += $transDetail->trans_detail_amount_poin;
    //                 // wallet per produk yang harus dibayar menggunakan poin
    //                 $total_wallet_poin += ($item['trans_detail_amount_total'] / 100 * $persen_produk);
    //                 // memasukkan wallet per produk ke total untuk pembayaran masedi
    //                 $total_wallet += ($item['trans_detail_amount_total'] - ($item['trans_detail_amount_total'] / 100 * $persen_produk));
    //             }
    //             // update amount trans
    //             $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
    //             $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
    //             $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
    //             // $total_poin = ($trans->trans_amount_total / 100 * $persen_poin) / $harga_poin;
    //             $poin += $total_poin;
    //             $gross_amount += $total_wallet;
    //             $trans->save();

    //             // insert trans_poin
    //             $new_poin = new Trans_poin;
    //             $new_poin->trans_poin_trans_id = $trans->id;
    //             $new_poin->trans_poin_persen = 0;
    //             $new_poin->trans_poin_compare = $harga_poin;
    //             $new_poin->trans_poin_poin_total = $total_poin;
    //             $new_poin->trans_poin_total = $total_wallet_poin;
    //             $new_poin->trans_poin_note = 'pembayaran poin untuk transaksi '.$trans_code.'.';
    //             $new_poin->save();
    //         }
    //         if(Session::has('voucher')){
    //             $voucher = Session::get('voucher');
    //             $new_voucher = new Trans_voucher;
    //             $new_voucher->trans_voucher_user = Auth::id();
    //             $new_voucher->trans_voucher_trans = $trans_code;
    //             $new_voucher->trans_voucher_code = $voucher['code'];
    //             $new_voucher->trans_voucher_amount = $voucher['amount'];
    //             // $new_voucher->trans_voucher_status = 0;
    //             $new_voucher->save();
    //             Session::forget('voucher');
    //         }
    //         Session::forget('chart');
    //         if(isset($trans->pembeli->email)){
    //             // send email
    //             $status = FunctionLib::trans_arr(1);
    //             $config = [
    //                 'to' => $trans->pembeli->email,
    //                 'data' => [
    //                     'trans_code' => $trans_code,
    //                     'trans_amount_total' => FunctionLib::number_to_text($poin).' POIN + '. 'Rp.'.FunctionLib::number_to_text($gross_amount).' masedi wallet',
    //                     'status' => $status,
    //                 ]
    //             ];
    //             $send_notif = FunctionLib::transaction_pw_notif($config);
    //             if(isset($send_notif['status']) && $send_notif['status'] == 200){
    //                 $message .= ' ,'.$send_notif['message'];
    //             }
    //         }

    //         $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
    //         $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
    //         // Required pembayaran masedi
    //         $transaction_details = array(
    //           'note' => $trans_code,
    //           'price' => $gross_amount, // no decimal allowed for creditcard
    //           'poin' => $poin, // no decimal allowed for creditcard
    //         );
    //         try{
    //             $masedi = FunctionLib::masedi('pay_poin', $transaction_details);
    //             // $masedi = FunctionLib::masedi_payment($transaction_details);
    //             // $masedi = [
    //             //       "status" => true,
    //             //       "va" => "WUN2NLT4HJ"
    //             //     ];
    //             if($masedi['status'] == true){
    //                 $trans = Trans::where('trans_code', $trans_code)->update(['trans_qr'=>$masedi['data']['va']]);
    //             }
    //         }catch(\Exception $err){
                
    //         }
    //         $data['trans_detail'] = $trans_detail;
    //         return view('localapi.masedi.index', $data);
    //     }else{
    //         $status = 500;
    //         $message = 'Barang yang anda masukkan ke keranjang kosong.';
    //         return ['status' => $status, 'message' => $message];
    //     }
    // }

    // /**
    // * pembayaran dengan masedi
    // **/
    // public function payment_masedi(Request $request){
    //     if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
    //         $data = Session::get('chart');
    //         $trans = [];
    //         array_walk($data, function ($item) use (&$trans) {
    //             $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
    //             $trans[$seller_id][] = $item;
    //         });
    //         $trans_code = FunctionLib::str_rand(7);
    //         $gross_amount = 0;
    //         if(Session::has('voucher')){
    //             $voucher = Session::get('voucher');
    //             $vcr = Trans_voucher::where('trans_voucher_code', $voucher['code']);
    //             $check = $vcr->exists();
    //             if($check){
    //                 $status = 500;
    //                 $message = 'mohon maaf voucher yang anda gunakan sudah digunakan di transaksi lain, silahkan gunakan voucher lain atau hubungi admin greenplaza';                    
    //                 return ['status' => $status, 'message' => $message];
    //             }
    //         }
    //         foreach ($trans as $value) {
    //             // dd(Session::get('chart'));
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 if($item['trans_detail_qty'] > $produk->produk_stock){
    //                     $status = 500;
    //                     $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;//.', item order akan otomatis dihapus dari chart.';

    //                     // $array = Session::get('chart');
    //                     // unset($array[$id]);
    //                     // $data = $array;
    //                     // Session::forget('chart');
    //                     // Session::put('chart', $data);
    //                     // Session::save();

    //                     return ['status' => $status, 'message' => $message];
    //                     // return redirect()->back()
    //                     //     ->with(['status' => $status, 'message' => $message]);
    //                 }
    //             }
    //             // add to DB sys_trans
    //             $bank_id = Auth::user()->user_bank()->where('user_bank_status', 1)->first()['id'];
    //             if(!$bank_id || empty($bank_id) || $bank_id == null){
    //                 $status = 500;
    //                 $message = 'Silahkan isikan data bank anda.';
    //                 return ['status' => $status, 'message' => $message];

    //             }
    //             $trans = new Trans;
    //             $trans->trans_code = $trans_code;
    //             $trans->trans_user_id = Auth::id();
    //             $trans->trans_user_bank_id = $bank_id;
    //             $trans->trans_payment_id = 3;
    //             $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
    //             $trans->save();
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 $price = ($produk['produk_price']*$item['trans_detail_qty']); //harga produk
    //                 // check grosir dan diskon
    //                 if($produk->grosir()->exists()){
    //                     foreach ($produk->grosir()->get() as $grosir) {
    //                         if($item['trans_detail_qty'] >= $grosir->produk_grosir_start && $item['trans_detail_qty'] <= $grosir->produk_grosir_end){
    //                             // update grosir
    //                             $price = ($grosir->produk_grosir_price * $item['trans_detail_qty']);
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }else{
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }
    //                     }
    //                 }else{
    //                     // check diskon
    //                     if($produk['produk_discount'] > 0){
    //                         $item['trans_detail_amount'] = $price-($price*$produk['produk_discount']/100);
    //                         $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                     }
    //                 }
    //                 $transDetail = new Trans_detail;
    //                 $transDetail->trans_detail_trans_id = $trans->id;
    //                 $transDetail->trans_code = $item['trans_code'];
    //                 $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
    //                 $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
    //                 $transDetail->trans_detail_shipment_service = $item['trans_detail_shipment_service'];
    //                 $transDetail->trans_detail_user_address_id = $item['trans_detail_user_address_id'];
    //                 $transDetail->trans_detail_qty = $item['trans_detail_qty'];
    //                 $transDetail->trans_detail_size = $item['trans_detail_size'];//'s,m,l,xl';
    //                 $transDetail->trans_detail_color = $item['trans_detail_color'];//'blue,orange,red,green,white';
    //                 $transDetail->trans_detail_amount = $item['trans_detail_amount'];
    //                 $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
    //                 $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
    //                 $transDetail->trans_detail_status = 1;
    //                 $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
    //                 $transDetail->save();
    //                 // update stock
    //                 $produk->produk_stock = $produk->produk_stock - $item['trans_detail_qty'];
    //                 $produk->save();
    //             }
    //             // update amount trans
    //             $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
    //             $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
    //             $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
    //             $gross_amount += $trans->trans_amount_total;
    //             $trans->save();
    //             // send email seller
    //             if($trans->trans_detail->first()->exists()){
    //                 $send_status = FunctionLib::trans_arr(1);
    //                 $config = [
    //                     'to' => $trans->trans_detail->first()->produk->user->email,
    //                     'data' => [
    //                         'trans_code' => $trans->trans_code,
    //                         'trans_amount_total' => $trans->trans_amount_total,
    //                         'status' => $send_status,
    //                     ]
    //                 ];
    //                 $send_notif = FunctionLib::transaction_notif($config);
    //                 if(isset($send_notif['status']) && $send_notif['status'] == 200){
    //                     $message .= ' ,'.$send_notif['message'];
    //                 }
    //             }
    //         }
    //         if(Session::has('voucher')){
    //             $voucher = Session::get('voucher');
    //             $new_voucher = new Trans_voucher;
    //             $new_voucher->trans_voucher_user = Auth::id();
    //             $new_voucher->trans_voucher_trans = $trans_code;
    //             $new_voucher->trans_voucher_code = $voucher['code'];
    //             $new_voucher->trans_voucher_amount = $voucher['amount'];
    //             // $new_voucher->trans_voucher_status = 0;
    //             $new_voucher->save();
    //             $gross_amount = FunctionLib::minus_to_zero($gross_amount - $voucher['amount']);
    //             Session::forget('voucher');
    //         }
    //         Session::forget('chart');
    //         if(isset($trans->pembeli->email)){
    //             // send email
    //             $send_status = FunctionLib::trans_arr(1);
    //             $config = [
    //                 'to' => $trans->pembeli->email,
    //                 'data' => [
    //                     'trans_code' => $trans_code,
    //                     'trans_amount_total' => $gross_amount,
    //                     'status' => $send_status,
    //                 ]
    //             ];
    //             $send_notif = FunctionLib::transaction_notif($config);
    //             if(isset($send_notif['status']) && $send_notif['status'] == 200){
    //                 $message .= ' ,'.$send_notif['message'];
    //             }
    //         }

    //         $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
    //         $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
    //         // Required pembayaran masedi
    //         $transaction_details = array(
    //           'note' => $trans_code,
    //           'price' => $gross_amount, // no decimal allowed for creditcard
    //         );
    //         try{
    //             $masedi = FunctionLib::masedi_payment($transaction_details);
    //             // $masedi = [
    //             //       "status" => true,
    //             //       "va" => "WUN2NLT4HJ"
    //             //     ];
    //             if($masedi['status'] == true){
    //                 $trans->trans_qr = $masedi['va'];
    //                 $trans->save();
    //             }
    //         }catch(\Exception $err){
                
    //         }
    //         $data['trans_detail'] = $trans_detail;
    //         return view('localapi.masedi.index', $data);
    //     }else{
    //         $status = 500;
    //         $message = 'Barang yang anda masukkan ke keranjang kosong.';
    //         return ['status' => $status, 'message' => $message];
    //     }
    // }

    /**
    * pembayaran dengan saldo
    **/
    public function payment_saldo(Request $request){
        $status = 500;
        $param = json_decode($request->getContent(), true);
        $auth = [
            'username' => $param["username"],
            'password' => $param["password"],
        ];
        $check = FunctionLib::check_api_auth($auth);
        if($check == 200){            
            // return response()->json($param);
            if($param["cart"] && FunctionLib::array_sum_key($param["cart"], 'trans_detail_amount_total') > 0){
                $data = $param["cart"];
                $trans = [];
                array_walk($data, function ($item) use (&$trans) {
                    $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                    $trans[$seller_id][] = $item;
                });
                $trans_code = FunctionLib::str_rand(7);
                $gross_amount = 0;
                if(isset($param["voucher"])){
                    $voucher = $param["voucher"];
                    $vcr = Trans_voucher::where('trans_voucher_code', $voucher['code']);
                    $check = $vcr->exists();
                    if($check){
                        $status = 500;
                        $message = 'mohon maaf voucher yang anda gunakan sudah digunakan di transaksi lain, silahkan gunakan voucher lain atau hubungi admin greenplaza';                    
                        return ['status' => $status, 'message' => $message];
                    }
                }
                foreach ($trans as $value) {
                    foreach ($value as $key => $item) {
                        $produk = Produk::findOrFail($item['trans_detail_produk_id']);
                        if($item['trans_detail_qty'] > $produk->produk_stock){
                            $status = 500;
                            $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;
                            return ['status' => $status, 'message' => $message];
                        }
                    }
                    // add to DB sys_trans
                    $bank_id = Auth::user()->user_bank()->where('user_bank_status', 1)->first()['id'];
                    if(!$bank_id || empty($bank_id) || $bank_id == null){
                        $status = 500;
                        $message = 'Silahkan isikan data bank anda.';
                        return ['status' => $status, 'message' => $message];
                    }
                    $trans = new Trans;
                    $trans->trans_code = $trans_code;
                    $trans->trans_user_id = Auth::id();
                    $trans->trans_user_bank_id = $bank_id;
                    $trans->trans_payment_id = 5;
                    $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
                    $trans->save();
                    foreach ($value as $key => $item) {
                        $produk = Produk::findOrFail($item['trans_detail_produk_id']);
                        $price = ($produk['produk_price']*$item['trans_detail_qty']); //harga produk
                        // check grosir dan diskon
                        if($produk->grosir()->exists()){
                            foreach ($produk->grosir()->get() as $grosir) {
                                if($item['trans_detail_qty'] >= $grosir->produk_grosir_start && $item['trans_detail_qty'] <= $grosir->produk_grosir_end){
                                    // update grosir
                                    $price = ($grosir->produk_grosir_price * $item['trans_detail_qty']);
                                    // update diskon
                                    $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
                                        ?$price-($price*$produk['produk_discount']/100)
                                        :$price;
                                    $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
                                }else{
                                    // update diskon
                                    $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
                                        ?$price-($price*$produk['produk_discount']/100)
                                        :$price;
                                    $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
                                }
                            }
                        }else{
                            // check diskon
                            if($produk['produk_discount'] > 0){
                                $item['trans_detail_amount'] = $price-($price*$produk['produk_discount']/100);
                                $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
                            }
                        }
                        $transDetail = new Trans_detail;
                        $transDetail->trans_detail_trans_id = $trans->id;
                        $transDetail->trans_code = $item['trans_code'];
                        $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
                        $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
                        $transDetail->trans_detail_shipment_service = $item['trans_detail_shipment_service'];
                        $transDetail->trans_detail_user_address_id = $item['trans_detail_user_address_id'];
                        $transDetail->trans_detail_qty = $item['trans_detail_qty'];
                        $transDetail->trans_detail_size = $item['trans_detail_size'];//'s,m,l,xl';
                        $transDetail->trans_detail_color = $item['trans_detail_color'];//'blue,orange,red,green,white';
                        $transDetail->trans_detail_amount = $item['trans_detail_amount'];
                        $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
                        $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
                        $transDetail->trans_detail_status = 1;
                        $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
                        $transDetail->save();
                        // update stock
                        $produk->produk_stock = $produk->produk_stock - $item['trans_detail_qty'];
                        $produk->save();
                    }
                    // update amount trans
                    $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
                    $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
                    $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
                    $gross_amount += $trans->trans_amount_total;
                    $trans->save();
                    // send email seller
                    if($trans->trans_detail->first()->exists()){
                        $send_status = FunctionLib::trans_arr(1);
                        $config = [
                            'to' => $trans->trans_detail->first()->produk->user->email,
                            'data' => [
                                'trans_code' => $trans->trans_code,
                                'trans_amount_total' => $trans->trans_amount_total,
                                'status' => $send_status,
                            ]
                        ];
                        $send_notif = FunctionLib::transaction_notif($config);
                        if(isset($send_notif['status']) && $send_notif['status'] == 200){
                            $message .= ' ,'.$send_notif['message'];
                        }
                    }
                }
                if(isset($param["voucher"])){
                    $voucher = $param["voucher"];
                    $new_voucher = new Trans_voucher;
                    $new_voucher->trans_voucher_user = Auth::id();
                    $new_voucher->trans_voucher_trans = $trans_code;
                    $new_voucher->trans_voucher_code = $voucher['code'];
                    $new_voucher->trans_voucher_amount = $voucher['amount'];
                    // $new_voucher->trans_voucher_status = 0;
                    $new_voucher->save();
                    $gross_amount = FunctionLib::minus_to_zero($gross_amount - $voucher['amount']);
                    // Session::forget('voucher');
                }
                // Session::forget('chart');
                if(isset($trans->pembeli->email)){
                    // send email
                    $send_status = FunctionLib::trans_arr(1);
                    $config = [
                        'to' => $trans->pembeli->email,
                        'data' => [
                            'trans_code' => $trans_code,
                            'trans_amount_total' => $gross_amount,
                            'status' => $send_status,
                        ]
                    ];
                    $send_notif = FunctionLib::transaction_notif($config);
                    if(isset($send_notif['status']) && $send_notif['status'] == 200){
                        $message .= ' ,'.$send_notif['message'];
                    }
                }

                $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
                $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                $data['trans_detail'] = $trans_detail;
                return response()->json(['status' => 200, 'message'=>$message, 'data'=>$data]);
            }else{
                $status = 500;
                $message = 'Barang yang anda masukkan ke keranjang kosong.';
                return response()->json(['status' => 200, 'message'=>$message]);
            }
        }else{
            return response()->json(['status' => 200, 'message'=>$message]);
        }
    }

    /**
    * pembayaran dengan gln
    **/
    // public function payment_gln(Request $request){
    //     if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
    //         $data = Session::get('chart');
    //         $trans = [];
    //         array_walk($data, function ($item) use (&$trans) {
    //             $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
    //             $trans[$seller_id][] = $item;
    //         });
    //         if(Session::has('voucher')){
    //             if(count($trans) > 1){
    //                 $status = 500;
    //                 $message = 'Mohon maaf, untuk pembelian menggunakan voucher masedi dan gln hanya bisa digunakan untuk membeli dari satu toko saja.';
    //                 return ['status' => $status, 'message' => $message];
    //             }
    //         }
    //         $trans_code = FunctionLib::str_rand(7);
    //         $gross_amount = 0;
    //         foreach ($trans as $value) {
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 if($item['trans_detail_qty'] > $produk->produk_stock){
    //                     $status = 500;
    //                     $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;
    //                     return ['status' => $status, 'message' => $message];
    //                 }
    //             }
    //             // add to DB sys_trans
    //             $bank_id = Auth::user()->user_bank()->where('user_bank_status', 1)->first()['id'];
    //             if(!$bank_id || empty($bank_id) || $bank_id == null){
    //                 $status = 500;
    //                 $message = 'Silahkan isikan data bank anda.';
    //                 return ['status' => $status, 'message' => $message];
    //             }
    //             $trans = new Trans;
    //             $trans->trans_code = $trans_code;
    //             $trans->trans_user_id = Auth::id();
    //             $trans->trans_user_bank_id = $bank_id;
    //             $trans->trans_payment_id = 4;
    //             $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
    //             $trans->save();
    //             foreach ($value as $key => $item) {
    //                 $produk = Produk::findOrFail($item['trans_detail_produk_id']);
    //                 $price = ($produk['produk_price']*$item['trans_detail_qty']); //harga produk
    //                 // check grosir dan diskon
    //                 if($produk->grosir()->exists()){
    //                     foreach ($produk->grosir()->get() as $grosir) {
    //                         if($item['trans_detail_qty'] >= $grosir->produk_grosir_start && $item['trans_detail_qty'] <= $grosir->produk_grosir_end){
    //                             // update grosir
    //                             $price = ($grosir->produk_grosir_price * $item['trans_detail_qty']);
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }else{
    //                             // update diskon
    //                             $item['trans_detail_amount'] = ($produk['produk_discount'] > 0)
    //                                 ?$price-($price*$produk['produk_discount']/100)
    //                                 :$price;
    //                             $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                         }
    //                     }
    //                 }else{
    //                     // check diskon
    //                     if($produk['produk_discount'] > 0){
    //                         $item['trans_detail_amount'] = $price-($price*$produk['produk_discount']/100);
    //                         $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
    //                     }
    //                 }
    //                 $transDetail = new Trans_detail;
    //                 $transDetail->trans_detail_trans_id = $trans->id;
    //                 $transDetail->trans_code = $item['trans_code'];
    //                 $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
    //                 $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
    //                 $transDetail->trans_detail_shipment_service = $item['trans_detail_shipment_service'];
    //                 $transDetail->trans_detail_user_address_id = $item['trans_detail_user_address_id'];
    //                 $transDetail->trans_detail_qty = $item['trans_detail_qty'];
    //                 $transDetail->trans_detail_size = $item['trans_detail_size'];//'s,m,l,xl';
    //                 $transDetail->trans_detail_color = $item['trans_detail_color'];//'blue,orange,red,green,white';
    //                 $transDetail->trans_detail_amount = $item['trans_detail_amount'];
    //                 $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
    //                 $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
    //                 $transDetail->trans_detail_status = 1;
    //                 $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
    //                 $transDetail->save();
    //                 // update stock
    //                 $produk->produk_stock = $produk->produk_stock - $item['trans_detail_qty'];
    //                 $produk->save();
    //             }
    //             // update amount trans
    //             $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
    //             $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
    //             $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
    //             $gross_amount += $trans->trans_amount_total;
    //             $trans->save();
    //             // send email seller
    //             if($trans->trans_detail->first()->exists()){
    //                 $send_status = FunctionLib::trans_arr(1);
    //                 $config = [
    //                     'to' => $trans->trans_detail->first()->produk->user->email,
    //                     'data' => [
    //                         'trans_code' => $trans->trans_code,
    //                         'trans_amount_total' => $trans->trans_amount_total,
    //                         'status' => $send_status,
    //                     ]
    //                 ];
    //                 $send_notif = FunctionLib::transaction_notif($config);
    //                 if(isset($send_notif['status']) && $send_notif['status'] == 200){
    //                     $message .= ' ,'.$send_notif['message'];
    //                 }
    //             }
    //         }
    //         if(Session::has('voucher')){
    //             $voucher = Session::get('voucher');
    //             $new_voucher = new Trans_voucher;
    //             $new_voucher->trans_voucher_user = Auth::id();
    //             $new_voucher->trans_voucher_trans = $trans_code;
    //             $new_voucher->trans_voucher_code = $voucher['code'];
    //             $new_voucher->trans_voucher_amount = $voucher['amount'];
    //             // $new_voucher->trans_voucher_status = 0;
    //             $new_voucher->save();
    //             Session::forget('voucher');
    //         }
    //         Session::forget('chart');
    //         if(isset($trans->pembeli->email)){
    //             // send email
    //             $send_status = FunctionLib::trans_arr(1);
    //             $config = [
    //                 'to' => $trans->pembeli->email,
    //                 'data' => [
    //                     'trans_code' => $trans_code,
    //                     'trans_amount_total' => $gross_amount,
    //                     'status' => $send_status,
    //                 ]
    //             ];
    //             $send_notif = FunctionLib::transaction_notif($config);
    //             if(isset($send_notif['status']) && $send_notif['status'] == 200){
    //                 $message .= ' ,'.$send_notif['message'];
    //             }
    //         }

    //         $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
    //         $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
    //         $data['trans_detail'] = $trans_detail;
    //         return view('localapi.gln.index', $data);
    //     }else{
    //         $status = 500;
    //         $message = 'Barang yang anda masukkan ke keranjang kosong.';
    //         return ['status' => $status, 'message' => $message];
    //     }
    // }

    /**
    * mendapatkan data toko
    **/
    public function toko(Request $request, $user_id){
        $asset_toko = asset('assets/images/bg_etalase');
        $asset_user = asset('assets/images/profil');
        $status = 200;
        $where = 1;
        $where .= ' AND users.id='.$user_id;
        $data = User::whereRaw($where)
            ->leftJoin('sys_user_detail', 'sys_user_detail.user_detail_user_id', '=', 'users.id')
            ->leftJoin('sys_review', 'sys_review.review_user_id', '=', 'users.id')
            ->leftJoin('sys_produk', 'sys_produk.produk_seller_id', '=', 'users.id')
            ->leftJoin('sys_produk_discuss', 'sys_produk_discuss.produk_discuss_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->select('users.*', 
                DB::raw('FLOOR(SUM(sys_review.review_stars)) as sum_star'), 
                DB::raw('COUNT(sys_produk.id) as count_produk'), 
                DB::raw('COUNT(sys_review.id) as count_review'), 
                DB::raw('COUNT(sys_produk_discuss.id) as count_discuss'), 
                DB::raw('COUNT(sys_trans_detail.id) as count_sale'), 
                DB::raw('CONCAT("'.$asset_toko.'/", users.user_store_image) as pic_toko'), 
                DB::raw('CONCAT("'.$asset_user.'/", sys_user_detail.user_detail_image) as pic_user'))
            ->first();
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    /**
    * mendapatkan data produk
    **/
    public function produk_toko(Request $request, $user_id)
    {
        $status = 1;
        $where = '1';
        $where .= " AND produk_seller_id = ".$user_id;
        $order = "rand()";
        $perPage = (!empty($request->input("perpage")))
            ?(int)$request->perpage
            :9;
        $page = (!empty($request->input("page")))
            ?(int)$request->page
            :1;

        // $id_cat = 0;
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $check = ['populer','ulasan']; 
            $arr = [
                'populer'=>'COUNT(sys_trans_detail.id) ',
                'ulasan'=>'COUNT(sys_review.id)',
            ];
            $order = explode ("-", $request->input("order"));//$request->input("order").' ASC';
            // $order = $order[0].' '.$order[1];
            // $order = (str_contains(strtolower($order_id), 'populer'))
            $order = (in_array($order[0], $check))
                ?$arr[$order[0]].' '.$order[1]
                :$order[0].' '.$order[1];
        }
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->has("user_status") && $request->input("user_status") != ""){
            $where .= " AND produk_user_status = ".$request->input("user_status");
        }

        $asset = asset('assets/images/product/thumb');
        $model = Produk::whereRaw($where)
            ->orderByRaw($order)
            ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->leftJoin('conf_produk_unit', 'conf_produk_unit.id', '=', 'sys_produk.produk_unit')
            ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'), DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as gambar'), 'conf_produk_unit.produk_unit_name')
            ->groupBy('sys_produk.id')
            ->where('produk_status', '=', $status);
        $total = ceil($model->get()->count() / $perPage);
        $data = $model->skip(($page-1) * $perPage)
            ->take($perPage)
            ->get();
            // ->paginate($perPage);
        return response()->json(['status' => 200, 'data'=>$data, 'total'=>$total]);
    }

    /**
    * mendapatkan data alamat user
    **/
    public function get_user_address(Request $request){
        $status = 500;
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        // $data = $par_auth;
        $data = [];
        if(FunctionLib::check_atempt($par_auth) == 200){
            $user = User::whereUsername($request->input("username"))->first();
            if($user){
                $data = $user->user_address()->get();
            }
            $status = 200;
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    /**
    * mendapatkan data kurir
    **/
    public function get_courier(){
        $where = 1;
        $data = Shipment::whereRaw($where)->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data paket kurir
    **/
    public function get_courier_service(Request $request){
        // $param = json_decode($request->getContent(), true);
        // return response()->json(['status' => 500, 'data'=>$param]);
        $status = 200;
        $produk = Produk::find($request->id);
        $berat = $produk['produk_weight'];
        $alamat_from = $produk->user->user_address()->first();
        $originType = ($request->courier == 1)?'city':'subdistrict';
        $origin = ($request->input("courier") == 1)
            ?$alamat_from->user_address_city
            :$alamat_from->user_address_subdist;
        $alamat_to = User_address::find($request->to_id);
        $weight = $berat * intval($request->qty);
        $req = [
            'data' => [
                'origin' => $origin,//$origin,
                'originType' => $originType,
                'destination' => $alamat_to->user_address_subdist,
                'destinationType' => "subdistrict",
                'weight' => $weight,
                'courier' => strtolower(Shipment::find($request->courier)->shipment_name),//$request->courier,
            ]
        ];
        // if(isset($lenght)){
        //     $req['data']['lenght'] = $lenght;
        // }
        // if(isset($width)){
        //     $req['data']['width'] = $width;
        // }
        // if(isset($height)){
        //     $req['data']['height'] = $height;
        // }

        $shipment = RajaOngkir::cost($req);
        $shipment = json_decode($shipment, true);
        if($shipment['rajaongkir']['status']['code'] !== 200){
            $status = 500;
            $message = $shipment['rajaongkir']['status']['code'];
        }
        // return [$req, $shipment];
        try{
            $data = $shipment['rajaongkir']['results'];
            return response()->json(['status' => $status, 'data'=>$data]);
        }catch(\Exception $err){
            $data = null;
            return response()->json(['status' => 500, 'data'=>$data]);
        }
    }

    /**
    * update data user
    **/
    public function update_profil(Request $request){
        $status = 500;
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $user = User::whereUsername($request->input("username"))->first();
            $user->name = $request->input("name");
            $user->user_store = $request->input("user_store");
            $user->user_slogan = $request->input("user_slogan");
            $user->save();
            $status = 200;
        }
        return response()->json(['status' => $status, 'data'=>$user]);
    }

    /**
    * mendapatkan data log transfer
    **/
    public function log_transfer(Request $request){
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }
        $where = '1';
        $order = "rand()";
        if($uid !== 0){
            $where .= ' AND (log_transfer.transfer_user_id ='.$uid.' OR log_transfer.transfer_to_user_id ='.$uid.')';
        }
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $order = explode ("-", $request->input("order"));
            $order = $order[0].' '.$order[1];
        }
        if(!empty($request->input("type")) && $request->input("type") !== ""){
            $where .= ' AND log_transfer.transfer_type LIKE "%'.$request->input("type").'%"';
        }
        $data = log_transfer::whereRaw($where)
                    ->orderByRaw($order)
                    ->with('from')
                    ->with('to')
                    ->get();

        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data log_ wallet
    **/
    public function log_wallet(Request $request){
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }
        $where = '1';
        $order = "rand()";
        if($uid !== 0){
            $where .= ' AND log_wallet.wallet_user_id ='.$uid;
        }
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $order = explode ("-", $request->input("order"));
            $order = $order[0].' '.$order[1];
        }
        if(!empty($request->input("wallet")) && $request->input("wallet") !== 0){
            $where .= ' AND log_wallet.wallet_type ='.$request->input("wallet");
        }
        $data = Log_wallet::whereRaw($where)
                    ->orderByRaw($order)
                    ->with('wallet')
                    ->with('type')
                    ->get();

        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan cek validasi login
    **/
    public function doLogin(Request $request){
        $userdata = array(
            'email'     => $request->username,
            'password'  => $request->password
        );
        // attempt to do the login
        if (Auth::attempt($userdata)) {
            $status = 200;
            $data = User::whereId(Auth::id())->with('user_detail')->first();
        } else {
            $status = 500;
            $data = [];
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    /**
    * mendapatkan detail transaksi
    **/
    public function detail_transaksi(Request $request, $detail_id){
        $where = 'sys_trans_detail.id ='.$detail_id;
        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('conf_payment', 'conf_payment.id', '=', 'sys_trans.trans_payment_id')
                ->select('sys_trans_detail.*', 
                        DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'),
                        'sys_produk.produk_name',
                        'sys_trans.trans_amount', 'sys_trans.trans_amount_ship', 'sys_trans.trans_amount_total', 'sys_trans.created_at', 'sys_trans.trans_code as kode', 
                        'conf_payment.payment_name'
                    )
                ->first();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data penjualan
    **/
    public function penjualan(Request $request, $status)
    {
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }

        $where = '1';
        if($uid !== 0){
            $where .= ' AND sys_produk.produk_seller_id ='.$uid;
        }
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status[$status]; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data pembelian
    **/
    public function pembelian(Request $request, $status)
    {
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }

        $where = '1';
        if($uid !== 0){
            $where .= ' AND sys_trans.trans_user_id ='.$uid;
        }
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status[$status]; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data produk
    **/
    public function produk(Request $request, $status=1)
    {
        $where = '1';
        $order = "rand()";
        $perPage = (!empty($request->input("perpage")))
            ?(int)$request->perpage
            :9;
        $page = (!empty($request->input("page")))
            ?(int)$request->page
            :1;

        // $id_cat = 0;
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $check = ['populer','ulasan']; 
            $arr = [
                'populer'=>'COUNT(sys_trans_detail.id) ',
                'ulasan'=>'COUNT(sys_review.id)',
            ];
            $order = explode ("-", $request->input("order"));//$request->input("order").' ASC';
            // $order = $order[0].' '.$order[1];
            // $order = (str_contains(strtolower($order_id), 'populer'))
            $order = (in_array($order[0], $check))
                ?$arr[$order[0]].' '.$order[1]
                :$order[0].' '.$order[1];
        }
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->has("user_status") && $request->input("user_status") != ""){
            $where .= " AND produk_user_status = ".$request->input("user_status");
        }

        $asset = asset('assets/images/product/thumb');
        $model = Produk::whereRaw($where)
            ->orderByRaw($order)
            ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->leftJoin('conf_produk_unit', 'conf_produk_unit.id', '=', 'sys_produk.produk_unit')
            ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'), DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as gambar'), 'conf_produk_unit.produk_unit_name')
            ->groupBy('sys_produk.id')
            ->where('produk_status', '=', $status);
        $total = ceil($model->get()->count() / $perPage);
        $data = $model->skip(($page-1) * $perPage)
            ->take($perPage)
            ->get();
            // ->paginate($perPage);
        return response()->json(['status' => 200, 'data'=>$data, 'total'=>$total]);
    }

    /**
    * mendapatkan detail produk grosir
    **/
    public function produk_grosir(Request $request, $pid){
        $data = Produk_grosir::where('produk_grosir_produk_id', $pid)->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan detail produk
    **/
    public function detail_produk(Request $request, $pid){
        $asset = asset('assets/images/product/thumb');
        $data = Produk::where('sys_produk.id', $pid)
            ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->leftJoin('conf_produk_unit', 'conf_produk_unit.id', '=', 'sys_produk.produk_unit')
            ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'), DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as gambar'), 'conf_produk_unit.produk_unit_name')->first();
        return response()->json(['status' => 200, 'data'=>$data]);
    }
}
