<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\User_detail;
use App\Models\Sponsor;
use App\Role;
use App\Models\Produk;
use App\Models\Wallet;
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
use App\Models\Category;
use Session;
use Ixudra\Curl\Facades\Curl;

class ApiController extends Controller
{
    /**/
    public function category(Request $request){
        if($request->type == 1){
            $cat = Category::where('category_parent_id', 0)->take(6)->get();
            return response()->json(['status' => 200, 'data'=>$cat]);
        }else{
            $cat = Category::get();
            return response()->json(['status' => 200, 'data'=>$cat]);
        }
    }

    /**
    * mendapatkan data tambah nomor resi
    **/
    public function simpan_resi(Request $request, $id)
    {
        $where = 'trans_detail_trans_id ='.$id;
        // status transaksi
        $w_status = ' AND trans_detail_status = 5 AND trans_detail_is_cancel != 1'; 
        $where .= $w_status;

        $data = Trans_detail::whereRaw($where)
            ->update(['trans_detail_no_resi' => $request->resi]);
        return response()->json(['status' => 200, 'message'=>'No resi berhasil disimpan.']);
    }

    /**
    * mendapatkan data tambah nomor resi
    **/
    public function trans_done(Request $request, $id)
    {
        $where = 'trans_detail_trans_id ='.$id;
        // status transaksi
        $w_status = ' AND trans_detail_status = 5 AND trans_detail_is_cancel != 1'; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'), 'sys_produk.produk_name')
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
     * #seller status 4
     * process di cancell oleh seller
     * @param
     * @return
     */
    public function cancel(Request $request){
        $requestData = $request->all();
        $status = 200;
        $message = 'barang telah di cancel!';
        $date = date('y-m-d h:i:s');
        if(!empty($request->detail_id)){            
            foreach ($requestData['detail_id'] as $item) {
                $trans_detail = Trans_detail::findOrFail($item);
                // cancel awal
                $trans_detail->trans_detail_is_cancel = 1;
                $trans_detail->trans_detail_status = 3;
                $trans_detail->trans_detail_able = 2;
                $trans_detail->trans_detail_able_date = $date;
                $trans_detail->trans_detail_able_note = 'Transaksi dibatalkan oleh seller.';
                $trans_detail->trans_detail_note = 'Transaksi Dibatalkan oleh seller.';
                // update saldo transaksi
                if($trans_detail->trans->trans_payment_id !== 4){
                    $update_wallet = [
                        'user_id'=>$trans_detail->trans->trans_user_id,
                        'wallet_type'=>3,
                        'amount'=>$trans_detail->trans_detail_amount_total,
                        'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                    ];
                    $saldo = FunctionLib::update_wallet($update_wallet);
                    $update_wallet = [
                        'user_id'=>2,
                        'wallet_type'=>1,
                        'amount'=>($trans_detail->trans_detail_amount_total * -1),
                        'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                    ];
                    $saldo = FunctionLib::update_wallet($update_wallet);
                }
                $trans_detail->save();
                $trans_detail->produk->produk_stock = $trans_detail->produk->produk_stock + $trans_detail->trans_detail_qty;
                $trans_detail->produk->save();

                // to shipping true
                // if($trans_detail->trans_detail_status == 4){
                //     $trans_detail->trans_detail_packing_date = $date;
                //     $trans_detail->trans_detail_is_cancel = 1;
                //     $trans_detail->trans_detail_status = 4;
                //     $trans_detail->trans_detail_packing = 2;
                //     $trans_detail->trans_detail_packing_note = "Transaction be Cancel by seller";
                //     $trans_detail->trans_detail_note = $request->note;
                //     $message = 'Shipment cancelled!';

                //     // update saldo transaksi
                //     if($trans_detail->trans->trans_payment_id !== 4){
                //         $update_wallet = [
                //             'user_id'=>$trans_detail->trans->trans_user_id,
                //             'wallet_type'=>3,
                //             'amount'=>$trans_detail->trans_detail_amount_total,
                //             'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                //         ];
                //         $saldo = FunctionLib::update_wallet($update_wallet);
                //         $update_wallet = [
                //             'user_id'=>2,
                //             'wallet_type'=>1,
                //             'amount'=>($trans_detail->trans_detail_amount_total * -1),
                //             'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                //         ];
                //         $saldo = FunctionLib::update_wallet($update_wallet);
                //     }
                // }elseif($trans_detail->trans_detail_status == 5){
                //     $trans_detail->trans_detail_status = 5;
                //     $trans_detail->trans_detail_send_date = $date;
                //     $trans_detail->trans_detail_is_cancel = 1;
                //     $trans_detail->trans_detail_send = 2;
                //     $trans_detail->trans_detail_send_note = "Transaction be Cancel by seller";
                //     $trans_detail->trans_detail_note = $request->note;
                //     $message = 'Shipment cancelled!';

                //     // update saldo transaksi
                //     if($trans_detail->trans->trans_payment_id !== 4){
                //         $update_wallet = [
                //             'user_id'=>$trans_detail->trans->trans_user_id,
                //             'wallet_type'=>3,
                //             'amount'=>$trans_detail->trans_detail_amount_total,
                //             'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                //         ];
                //         $saldo = FunctionLib::update_wallet($update_wallet);
                //         $update_wallet = [
                //             'user_id'=>2,
                //             'wallet_type'=>1,
                //             'amount'=>($trans_detail->trans_detail_amount_total * -1),
                //             'note'=>'Transaksi cancel by seller '.Auth::id().'. Update wallet transaksi dengan transaksi detail kode '.$trans_detail->trans_code.' dan transaksi kode '.$trans_detail->trans->trans_code.'.',
                //         ];
                //         $saldo = FunctionLib::update_wallet($update_wallet);
                //     }
                // }
                // $trans_detail->save();
            }
        }
        if(!isset($trans_detail) || !$trans_detail){
            $status = 500;
            $message = 'Shipment unapproved!';
        }
        if(empty($request->detail_id)){
            $status = 500;
            $message = 'Shipment unapproved!';
            return response()->json(['status' => $status,'message' => $message]);
        }
        if(!$request->has('note')){
            return response()->json(['status' => $status,'message' => $message]);
        }
        return response()->json(['status' => $status,'message' => $message]);
    }

    /**
     * #seller status 4
     * process sudah dikirim oleh seller wait dropping
     * @param
     * @return
     */
    public function sending(Request $request){
        $requestData = $request->all();
        $status = 200;
        $message = 'barang siap dikirim!';
        $date = date('y-m-d h:i:s');
        if(!empty($request->detail_id)){            
            foreach ($requestData['detail_id'] as $item) {
                $trans_detail = Trans_detail::findOrFail($item);
                // to shipping true
                $trans_detail->trans_detail_status = 5;
                // kirim
                $trans_detail->trans_detail_send = 0;//menunggu nomor resi
                $trans_detail->trans_detail_send_date = $date;
                $trans_detail->trans_detail_send_note = "Transaction be sending by seller";
                // packing
                $trans_detail->trans_detail_packing_date = $date;
                $trans_detail->trans_detail_packing = 1;
                $trans_detail->trans_detail_packing_note = "Transaction be packing by seller";
                // kesanggupan seller
                $trans_detail->trans_detail_able = 1;
                $trans_detail->trans_detail_able_date = date('y-m-d h:i:s');
                $trans_detail->trans_detail_able_note = "Transaction be able by seller";
                $trans_detail->trans_detail_packing_date = date('y-m-d h:i:s');
                $trans_detail->save();
            }
        }
        if(!isset($trans_detail) || !$trans_detail){
            $status = 500;
            $message = 'Shipment unapproved!';
        }
        if(empty($request->detail_id)){
            $status = 500;
            $message = 'Shipment unapproved!';
            return response()->json(['status' => $status,'message' => $message]);
        }
        if(!$request->has('note')){
            return response()->json(['status' => $status,'message' => $message]);
        }
        return response()->json(['status' => $status,'message' => $message]);
    }

    /********/
    public function able_cancel($id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = 'transaksi telah di cancel!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            // to packing
            $item->trans_detail_is_cancel = 1;
            $item->trans_detail_status = 3;
            $item->trans_detail_able = 2;
            $item->trans_detail_able_date = $date;
            $item->trans_detail_able_note = 'Transaksi dibatalkan oleh seller.';
            $item->trans_detail_note = 'Transaksi Dibatalkan oleh seller.';
            $item->save();
            
            $item->produk->produk_stock = $item->produk->produk_stock + $item->trans_detail_qty;
            // dd($item->produk->produk_stock);
            $item->produk->save();

        }
        if(!$item){
            $status = 500;
            $message = 'Gagal merubah data!';
        }else{
            if($trans->trans_payment_id !== 4){
                $update_wallet = [
                    'user_id'=>$trans->pembeli->id,
                    'wallet_type'=>3,
                    'amount'=>$trans->trans_amount_total,
                    'note'=>'pengembalian wallet transaksi dengan transaksi kode '.$trans->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
                $update_wallet = [
                    'user_id'=>2,
                    'wallet_type'=>1,
                    'amount'=>($trans->trans_amount_total * -1),
                    'note'=>'pengembalian wallet transaksi dengan transaksi kode '.$trans->trans_code.'.',
                ];
                $saldo = FunctionLib::update_wallet($update_wallet);
            }else{
                // transfer gln admin to buyen
            }
        }
        return response()->json(['status' => $status,'message' => $message]);
    }

    /**
     * #seller status 3 approve admin
     * process seller menyanggupi pengiriman
     * @param
     * @return
     */
    public function able($id){
        $status = 200;
        $message = 'anda telah menyanggupi transaksi!';
        $trans = Trans::findOrFail($id);
        foreach ($trans->trans_detail as $item) {
            $trans_detail = Trans_detail::findOrFail($item->id);
            // to packing
            $trans_detail->trans_detail_status = 4;
            $trans_detail->trans_detail_able = 1;
            $trans_detail->trans_detail_able_date = date('y-m-d h:i:s');
            $trans_detail->trans_detail_able_note = "Transaction be able by seller";
            $trans_detail->trans_detail_packing_date = date('y-m-d h:i:s');
            $trans_detail->save();
        }
        if(!$trans_detail){
            $status = 500;
            $message = 'Gagal merubah data!';
        }else{
            // send email
            $send_status = FunctionLib::trans_arr($trans_detail->trans_detail_status);
            $config = [
                'to' => $trans->pembeli->email,
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
            $config = [
                'to' => $trans->trans_detail->first()->produk->user->email,
                'data' => [
                    'trans_code' => $trans->trans_code,
                    'trans_amount_total' => $trans->trans_amount_total,
                    'status' => $send_status,
                ]
            ];
            // $send_notif = FunctionLib::transaction_notif($config);
            // if(isset($send_notif['status']) && $send_notif['status'] == 200){
            //     $message .= ' ,'.$send_notif['message'];
            // }
        }
        return response()->json(['status' => $status,'message' => $message]);
    }

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
            return response()->json(['status' => $status,'message' => $message]);
        }
        $to_address = FunctionLib::get_config('profil_gln_address');
        $seller_address = ($trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists())
            ?$trans->first()->trans_detail->first()->produk->user->wallet()->where('wallet_type', 7)->exists()
            :false;

        if(!$seller_address || $seller_address == null || $seller_address == ""){
            $status = 500;
            $message = 'Seller tidak melayani pembayaran menggunakan GLN.';
            return response()->json(['status' => $status,'message' => $message]);
        }
        
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

    public function gln_ballance(Request $request){
        $address = $request->address;
        return response()->json(FunctionLib::gln('ballance', ['address'=> $address]));
    }


    // public function gln_create(){
    //     return response()->json(FunctionLib::gln('create', []));
    // }

     public function gln_list(){
        return response()->json(FunctionLib::gln('list', []));
    }

    public function gln_list_user(Request $request){
        $user_id = $request->user_id;
        return response()->json(FunctionLib::gln('user', []));
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
                    $item['trans_detail_amount'] = $price;
                    $item['trans_detail_amount_total'] = $price + $item['paket']['cost'][0]['value'];
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
            'email'=>$request->input("email"),
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
        // var_dump(Auth::attempt($userdata)); die();
        if (Auth::attempt($userdata)) {
            $status = 200;
            $data = User::whereId(Auth::id())->with('user_detail')->first();
        } else {
            $status = 500;
            $data = [];
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    public function webLogin(Request $request){
        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        // attempt to do the login
        // var_dump(Auth::attempt($userdata)); die();
        if (Auth::attempt($userdata)) {
            $status = 200;
            $data = User::whereId(Auth::id())->with('user_detail')->first();
        } else {
            $status = 500;
            $data = [];
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    public function webLogin_sosial(Request $request){
        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        $user = User::where('email', $request->email)->first();
        if(!$user){
            $status = 500;
            $data = [];
        }else{
            $status = 200;
            return response()->json(['status' => $status, 'data'=>$user]);
            $data = [];
        }

        
        // if (Auth::attempt($userdata)) {
        //     $status = 200;
        //     $data = User::whereId(Auth::id())->with('user_detail')->first();
        // } else {
        //     $status = 500;
        //     $data = [];
        // }
        // return response()->json(['status' => $status, 'data'=>$data]);
    }

    public function webRegister(Request $data){
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'reff_code' => FunctionLib::str_rand(3).'-'.rand(0, 999999),
            'token_register'=>str_random(190)
        ]);

        $sponsor = 2;
        if($data['code_reveral'] !== null && $data['code_reveral'] !== ''){
            $code = User::whereRaw('reff_code LIKE "%'.$data['code_reveral'].'%"');
            $sponsor = ($code->exists())?$code->first()->id:$sponsor;
        }

        // update detail user
        if($user){
            $user_detail = User_detail::create([
                'user_detail_user_id' => $user->id,
                'user_detail_pass_trx' => $user->password,
                'user_detail_jk' => $data['user_detail_jk'],
                // 'user_detail_address' => $data['user_detail_address'],
                'user_detail_phone' => $data['user_detail_phone'],
                'user_detail_province' => $data['user_detail_province'],
                'user_detail_city' => $data['user_detail_city'],
                'user_detail_subdist' => $data['user_detail_subdist'],
                'user_detail_pos' => $data['user_detail_pos'],
                'user_detail_token' => "",//$data['user_detail_status'],
                'user_detail_status' => 0//$data['user_detail_status'],
            ]);
            $user_sponsor = Sponsor::create([
                'user_tree_user_id' => $user->id,
                'user_tree_sponsor_id' => $sponsor,
            ]);
            $user_address = User_address::create([
                'user_address_user_id' => $user->id,
                'user_address_label' => 'Saya',
                'user_address_owner' => $data['name'],
                'user_address_address' => " ",
                'user_address_phone' => $data['user_detail_phone'],
                'user_address_province' => $data['user_detail_province'],
                'user_address_city' => $data['user_detail_city'],
                'user_address_subdist' => $data['user_detail_subdist'],
                'user_address_pos' => $data['user_detail_pos'],
            ]);
            // insert config user
            $arr = FunctionLib::UserConfigArr();
            foreach ($arr as $item) {
                $param = [
                    'id' => $user->id,
                    'name' => $item['name'],
                    'value' => $item['value'],
                    'note' => $item['note'],
                ];
                $create = FunctionLib::CreateUserConfig($param);
                $status = ($create['status'] == 200)?'berhasil':'gagal';
            }
        }

        // get role member
        $memberRole = Role::where('name', 'member')->pluck('name');
        $insert_role = $user->assignRole($memberRole);
        return response()->json(['status' => '200', 'data'=>$user]);

        
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

    public function user_wallet(Request $request){
        $_id = $request->user_id;
        if($_id){

            $user = Wallet::where('wallet_type', 7)->where('wallet_user_id', $_id)->with(['user', 'type'])->get();
            return response()->json(['status' => 200, 'data' =>$user]);
        }
        // $wallet = $user['wallet_note'];
    }

    public function list_user_wallet(Request $request){
       
            $user = Wallet::where('wallet_type', 7)->with(['user', 'type'])->get();
            return response()->json(['status' => 200, 'data' =>$user]);
    }

    public function addChart(Request $request){
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $gln = json_decode(FunctionLib::priceGln(), true);
        $gln2 = $gln['price'];

        

        $id = $request->id_produk;
        $produk = Produk::where('id', $id)->first();
        // var_dump($produk); die();
        // if($request->qty > $produk['produk_stock'] || $request->qty <= 0 || $request->qty == null || $request->qty == ""){
        //     return response()->json(['status' => 500, 'message' => "Jumlah barang tidak mencukupi"]);
        // }
    
        if($request->ship_cost == null || $request->ship_cost == "" || $request->ship_cost == 0){
            return response()->json(['status' => 500, 'message' => "Silahkan ambil harga pengiriman", "data" => $request->all()]);
            
        }
            if($request->address_id == null || $request->address_id == ""){
            return response()->json(['status' => 500, 'message' => "Silahkan isi alamat anda"]);
        }
        // random string
        $trans_code = FunctionLib::str_rand(8);

        $courier = 0;
        // print_r($request->courier);
        if(!empty($request->courier)){
            $courier = Shipment::where('shipment_name', '=', strtoupper($request->courier))->pluck('id')[0];
        }
        if($courier == null || $courier == "" || $courier == 0){
            return response()->json(['status' => 500,'flash_message' => 'Silahkan isi jasa pengiriman']);
        }

        $price = $produk['produk_price'] * $request->qty;
        $price_myr = $produk['price_myr'] * $request->qty;
        $price_gln = $produk['gln_coin'] * $request->qty;
        // var_dump($produk['id']); die();
        $idUser = $request->userId;
        $bank_id = User::find($idUser)->user_bank()->where('user_bank_status', 1)->first()['id'];
        // var_dump($bank_id); die();
                if(!$bank_id || empty($bank_id) || $bank_id == null){
                    $status = 500;
                    $message = 'Silahkan isikan data bank anda.';
                    return response()->json(['status' => $status, 'message' => $message]);
                }
        $kode_trans = FunctionLib::str_rand(7);
        // $user_id = User::find($idUser);
        $trans = new Trans;
        $trans->trans_code = $kode_trans;
        $trans->trans_user_id = $idUser;
        $trans->trans_user_bank_id = $bank_id;
        $trans->trans_payment_id = 4;
        $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
        // var_dump($trans); die();
        $trans->save();

        $transaction = new Trans_detail;
        $transaction->trans_code = $trans_code;
        $transaction->trans_detail_produk_id = $produk['id'];
        $transaction->trans_detail_trans_id = $trans->id;
        $transaction->trans_detail_shipment_id = $courier;
        $transaction->trans_detail_shipment_service = $request->ship_service;
        $transaction->trans_detail_user_address_id = intval($request->address_id);
        $transaction->trans_detail_no_resi = "";
        $transaction->trans_detail_qty = $request->qty;
        $transaction->trans_detail_size = $request->size;
        $transaction->trans_detail_color = $request->color;
        $transaction->trans_detail_amount = $price;
        $transaction->trans_detail_amount_myr = $price_myr;
        $transaction->trans_detail_amount_gln = $price_gln;
        $transaction->trans_detail_amount_ship = $request->ship_cost;
        $transaction->trans_detail_amount_total = ($price + $request->ship_cost);
        $transaction->trans_detail_amount_total_myr = ($price_myr + $request->ship_cost);
        $transaction->trans_detail_amount_total_gln = ($price_gln + $request->ship_cost);
        $transaction->trans_detail_status = 0;
        $transaction->trans_detail_note = $request->note;
        $transaction->status_chart = 1;
        // var_dump($transaction); die();
        $transaction->save();

        // $transaction = [
        //     'trans_code' => $trans_code,
        //     'trans_detail_produk_id' => $produk['id'],
        //     'trans_detail_shipment_id' => $courier,
        //     'trans_detail_shipment_service' => $request->ship_service,
        //     'trans_detail_user_address_id' => intval($request->address_id),
        //     'trans_detail_no_resi' => "",
        //     'trans_detail_qty' => $request->qty,
        //     'trans_detail_size' => $request->size,
        //     'trans_detail_color' => $request->color,
        //     'trans_detail_amount' => $price,
        //     'trans_detail_amount_myr' => $price_myr,
        //     'trans_detail_amount_gln' => $price_gln,
        //     'trans_detail_amount_ship' => $request->ship_cost,
        //     'trans_detail_amount_total' => ($price + $request->ship_cost),
        //     'trans_detail_amount_total_myr' => ($price_myr + $request->ship_cost),
        //     'trans_detail_amount_total_gln' => $price_gln + ($request->ship_cost/$gln2),
        //     'trans_detail_status' => 0,
        //     'trans_detail_note' => $request->note,
        //     'myr' => $kurs['Data']['MYR']['Beli']
        // ];
        // if(!Session::has('chart')){
        //     Session::put('chart', []);
        // }
        // Session::push('chart', $transaction);
        // Session::save();
        $status = 200;
        $message = 'Item pembelian berhasil masuk ke chart.';
        return response()->json(['status' => 200, 'message'=> $message, 'data' => $transaction]);
        // var_dump($transaction); die();
        // dd($transaction);

        // $status = 200;
        // $message = 'Item pembelian berhasil masuk ke chart.';
        // return response()->json(['status' => 200, 'message' =>$message]);
    }

    public function get_chart(Request $request){
        $user_id = $request->id_user;
        $status = $request->status;
        $trans_detail = Trans::where('trans_user_id', $user_id)->with('trans_detail')->whereHas('trans_detail', function($query) use($status){
            $query->where('sys_trans_detail.status_chart', $status);
        })->count();
        $keranjang = Trans::where('trans_user_id', $user_id)->with('trans_detail')->whereHas('trans_detail', function($query) use($status){
            $query->where('sys_trans_detail.status_chart', $status);
        })->get();
         $total = DB::table('sys_trans_detail')->join('sys_trans','sys_trans_detail.trans_detail_trans_id','=','sys_trans.id')
                    ->where('sys_trans_detail.status_chart', $status)
                    ->where('sys_trans.trans_user_id', $user_id)
                    ->sum('sys_trans_detail.trans_detail_amount_total');
        return response()->json(['status' => 200, 'Jumlah' => $trans_detail, 'Total' => $total, 'data' => $keranjang]);



    }

    public function hapus_chart(Request $request){
        $trans_id = $request->trans_id;
        $hapus = Trans_detail::where('trans_detail_trans_id', $trans_id)->delete();
        $hapus_trans = Trans::where('id', $trans_id)->delete();
        return response()->json(['status' => 200, 'message' => "Barang keranjang telah terhapus"]);
    }


    public function getSaldoGln(Request $request, $param=[]){
        $gln = json_decode(FunctionLib::priceGln(), true);
        $gln2 = $gln['price'];
        $user_id = $request->user_id;
        $address = Wallet::where('wallet_user_id', $user_id)->where('wallet_type', 7)->first();
        $wallet = $address['wallet_address'];
        if(!$wallet){
            return response()->json(['status' => 500, 'message' => "Maaf anda belum mempunyai alamat wallet"]);
        }
        extract($param);
        $url = 'https://wallet.greenline.ai/api/balance/Ee0JTNU64g2aXTfV9Mxb/'.$wallet;
        // $url = "http://gatotkaca.harmonyb12.com/edisedis/index.php/sadisbgt/controller_api/cek_voucher";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                ),
            ));
        $response = curl_exec($curl);
        $obResponse = json_decode($response, true);
        $saldo = $obResponse['data']['balance'];
        $idr = floor($saldo * $gln2);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $status = 500;
            $message = 'curl error.';
            $response = ['status'=>$status, 'message'=>$message];
            return $idr;
            // return json_decode($response, true);
        } else {
            return $idr;
            // return json_decode($response, true);
        }
        
    }

    public function potong_saldo(Request $request, $param = []){

        $gln = json_decode(FunctionLib::priceGln(), true);
        $gln2 = $gln['price'];
        $user_id = $request->user_id;
        $address = Wallet::where('wallet_user_id', $user_id)->where('wallet_type', 7)->first();
        $wallet = $address['wallet_address'];

        // var_dump($wallet); die();
        if(!$wallet){
            return response()->json(['status' => 500, 'message' => "Maaf anda belum mempunyai alamat wallet"]);
        }else{
            extract($param);
            $url = 'https://wallet.greenline.ai/api/balance/Ee0JTNU64g2aXTfV9Mxb/'.$wallet;
            // $url = "http://gatotkaca.harmonyb12.com/edisedis/index.php/sadisbgt/controller_api/cek_voucher";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/x-www-form-urlencoded",
                    ),
                ));
            $response = curl_exec($curl);
            $obResponse = json_decode($response, true);
            $saldo = $obResponse['data']['balance'];
            $idr = floor($saldo * $gln2);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                $status = 500;
                $message = 'curl error.';
                $response = ['status'=>$status, 'message'=> "Alamat wallet kosong"];
                return response;
                // return json_decode($response, true);
            } else {
                // return $idr;
                // return json_decode($response, true);
                $response = FunctionLib::gln('ballance', ['address'=>$wallet]);
                if($response['status'] == 500){
                    $status = 500;
                    $message = 'Transaksi gagal dibayar atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
                    return response()->json(['status' => 500, 'data' => $message]);
                    
                }
                
                $saldo_gln = FunctionLib::gln('ballance', ['address'=>$wallet]);
                $saldo_gln = (float)$saldo_gln['data']['balance'];
                // var_dump($saldo_gln); die();
                $to_address = FunctionLib::get_config('profil_gln_address');
                $amount_beli = $request->amount_beli / FunctionLib::gln('compare',[])['data'];
                $fee_admin_idr = ($amount_beli*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                $detail_fee = $fee_admin_idr / FunctionLib::gln('compare',[])['data'];
                $detail_fee = round($detail_fee,8, PHP_ROUND_HALF_UP);
                // $detail_amount_total = $detail_amount+$detail_fee+$detail_amount_ship;
                $detail_amount_total = $amount_beli+$detail_fee;
                $detail_amount_total_idr = $request->amount_beli + $fee_admin_idr;

                if($detail_amount_total>$saldo_gln){
                    return response()->json(['status' => 500, 'message' => 'Saldo Anda tidak Cukup']);
                }else {

                    $transfer = FunctionLib::gln('transfer', ['to_address' =>$to_address,'amount'=>$detail_amount_total,'address'=>$wallet]);

                    $gln = new Trans_gln;
                    $gln->trans_gln_form=$wallet;
                    $gln->trans_gln_admin=$to_address;
                    $gln->trans_gln_to=$to_address;
                    $gln->trans_gln_trans_id="-";
                    $gln->trans_gln_trans_code="-";
                    $gln->trans_gln_detail_id="-";
                    $gln->trans_gln_detail_code="-";
                            // $gln->trans_gln_amount=$detail_amount+$detail_amount_ship;
                    $gln->trans_gln_amount=$amount_beli;
                    $gln->trans_gln_amount_fee=$detail_fee;
                    $gln->trans_gln_amount_total=$detail_amount_total;
                    $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                    $gln->trans_gln_note='Pembayaran PPOB sebesar'.$detail_amount_total.'.';
                    $gln->save();

                    $log_wallet = New Log_wallet;
                    $log_wallet->wallet_type_log = "Updated";
                    $log_wallet->wallet_type = 7;
                    $log_wallet->wallet_user_id = $user_id;
                    $log_wallet->wallet_ballance_before = $idr;
                    $log_wallet->wallet_ballance_after = $idr - $detail_amount_total_idr;
                    $log_wallet->wallet_ballance = $log_wallet->wallet_ballance_after;
                    $log_wallet->wallet_note = "Pembayaran PPOB";
                    $log_wallet->save();

                    return response()->json(['status' => 200, 'data' => $log_wallet]);
                }
            }

        }

    }


    public function create_gln(Request $request)
    {
        $status = 500;
        $message = 'Gagal membuat wallet gln.';
        $user_id = $request->user_id;
        $password_transaksi = $request->password_transaksi;


        $pass = User::findOrFail($user_id);

        if($pass->password_transaksi == Null){
            $pass->password_transaksi = bcrypt($password_transaksi);
            $pass->save();
            

        }


            $username = $pass->username;
            // var_dump(bcrypt($password_transaksi) == $pass->password_transaksi); die();
            if(Hash::check($password_transaksi , $pass->password_transaksi)){
                $have_address = Wallet::where('wallet_user_id', $user_id)->where('wallet_type', 7)->first();
                $alamat_wallet = $have_address->wallet_address;
                // var_dump($alamat_wallet); die();
                if($alamat_wallet){
                    return response()->json(['status' => 500, 'data' => $alamat_wallet, 'message' => 'Anda sudah punya akun wallet']);
                }else{

                    $response = FunctionLib::gln('create', ['label'=> $username]);
                    if($response['status'] == 200){
                        $wallet = new Wallet;
                        $wallet->wallet_user_id = $user_id;
                        $wallet->wallet_type = 7;
                        $wallet->wallet_ballance_before = 0;
                        $wallet->wallet_ballance = 0;
                        $wallet->wallet_address = $response['data']['address'];
                        $wallet->wallet_public = $response['data']['public'];
                        $wallet->wallet_private = $response['data']['private'];
                        $wallet->wallet_note = json_encode($response['data']);
                        $wallet->save();
                            $status = 200;
                            $message = 'Wallet berhasil dibuat.';
                    }
                    
                    return response()->json(['status' => 200,'data' => $wallet->wallet_address, 'message' => $message]); 
                }

            }else{
                return response()->json(['status' => 500, 'message' => 'Maaf password yang anda masukkan tidak sesuai !!']);
            }
    }

    public function trans_antar_member(Request $request, $param = []){

        $wallet = $request->my_address;
            extract($param);
            $url = 'https://wallet.greenline.ai/api/balance/Ee0JTNU64g2aXTfV9Mxb/'.$wallet;
            // $url = "http://gatotkaca.harmonyb12.com/edisedis/index.php/sadisbgt/controller_api/cek_voucher";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/x-www-form-urlencoded",
                    ),
                ));
            $response = curl_exec($curl);
            $obResponse = json_decode($response, true);
            $saldo = $obResponse['data']['balance'];
            $idr = floor($saldo * $gln2);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                $status = 500;
                $message = 'curl error.';
                $response = ['status'=>$status, 'message'=> "Alamat wallet kosong"];
                return response;
                // return json_decode($response, true);
            } else {
                // return $idr;
                // return json_decode($response, true);
                $response = FunctionLib::gln('ballance', ['address'=>$wallet]);
                if($response['status'] == 500){
                    $status = 500;
                    $message = 'Transaksi gagal dibayar atau saldo gln anda tidak mencukupi, silahkan cek saldo.';
                    return response()->json(['status' => 500, 'data' => $message]);
                    
                }
                
                $saldo_gln = FunctionLib::gln('ballance', ['address'=>$wallet]);
                $saldo_gln = (float)$saldo_gln['data']['balance'];
                // var_dump($saldo_gln); die();
                $admin_address = FunctionLib::get_config('profil_gln_address');
                $to_address = $request->wallet_address;
                $jml_transfer = $request->jml_transfer;
                $fee_admin = ($jml_transfer*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                // $detail_fee = $fee_admin_idr / FunctionLib::gln('compare',[])['data'];
                $detail_fee = round($fee_admin,8, PHP_ROUND_HALF_UP);
                // $detail_amount_total = $detail_amount+$detail_fee+$detail_amount_ship;
                $detail_amount_total = $jml_transfer+$detail_fee;

                if($detail_amount_total>$saldo_gln){
                    return response()->json(['status' => 500, 'message' => 'Saldo Anda tidak Cukup']);
                }else {

                    $transfer = FunctionLib::gln('transfer', ['to_address' =>$wallet,'amount'=>$detail_amount_total,'address'=>$to_address]);

                    $transfer_fee_admin = FunctionLib::gln('transfer', ['to_address' =>$admin_address,'amount'=>$fee_admin,'address'=>$to_address]);

                    $gln = new Trans_gln;
                    $gln->trans_gln_form=$wallet;
                    $gln->trans_gln_admin=$to_address;
                    $gln->trans_gln_to=$to_address;
                    $gln->trans_gln_trans_id="-";
                    $gln->trans_gln_trans_code="-";
                    $gln->trans_gln_detail_id="-";
                    $gln->trans_gln_detail_code="-";
                            // $gln->trans_gln_amount=$detail_amount+$detail_amount_ship;
                    $gln->trans_gln_amount=$amount_beli;
                    $gln->trans_gln_amount_fee=$detail_fee;
                    $gln->trans_gln_amount_total=$detail_amount_total;
                    $gln->trans_gln_compare=FunctionLib::gln('compare',[])['data'];
                    $gln->trans_gln_note='Pembayaran PPOB sebesar'.$detail_amount_total.'.';
                    $gln->save();

                    $log_wallet = New Log_wallet;
                    $log_wallet->wallet_type_log = "Updated";
                    $log_wallet->wallet_type = 7;
                    $log_wallet->wallet_user_id = $user_id;
                    $log_wallet->wallet_ballance_before = $idr;
                    $log_wallet->wallet_ballance_after = $idr - $detail_amount_total_idr;
                    $log_wallet->wallet_ballance = $log_wallet->wallet_ballance_after;
                    $log_wallet->wallet_note = "Pembayaran PPOB";
                    $log_wallet->save();

                    return response()->json(['status' => 200, 'data' => $log_wallet]);
                }
            }

        
    }
}
