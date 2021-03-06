<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plugin;
use FunctionLib;
use Session;
use App\Models\Produk;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_hotlist;
use App\Models\Trans_iklan;
use App\Models\Trans_pincode;
use App\User;
use Auth;
use App\Models\Wallet;
use App\Models\Trans_voucher;
use App\Models\Trans_poin;
use Exception;

class MasediController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function cek_voucher(Request $request){
        $data = $request->all();
        $res = FunctionLib::masedi('cek', $data);
        $vcr = Trans_voucher::where('trans_voucher_code', $request->voucher);
        $check = $vcr->exists();
        if($check){
            return ['status' => 500, 'message'=>'Voucher sudah digunakan'];
        }
        return $res;
    }

    public function use_voucher(Request $request){
        $data = $request->all();
        $res = FunctionLib::masedi('use', $data);
        return $res;
    }

    public function payment_poin(){
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            $data = Session::get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            $trans_code = FunctionLib::str_rand(7);
            $gross_amount = 0;
            $poin = 0;
            $price_poin = FunctionLib::masedi('tukar_poin');
            if($price_poin['status'] == 200){
                $harga_poin = $price_poin['data']['rupiah'];
            }else{
                $status = 500;
                $message = 'Gagal mendapatkan harga tukar poin. Mohon maaf server sedang mengalami masalah dengan masedi.';
                return ['status' => $status, 'message' => $message];
            }
            foreach ($trans as $key1 => $value) {
                foreach ($value as $key => $item) {
                    $produk = Produk::findOrFail($item['trans_detail_produk_id']);
                    if($item['trans_detail_qty'] > $produk->produk_stock){
                        $status = 500;
                        $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;//.', item order akan otomatis dihapus dari chart.';

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
                $persen_poin = FunctionLib::UserConfig('user_poin', $key1);
                $total_poin = 0;
                $total_wallet = 0;
                $total_wallet_poin = 0;

                $trans = new Trans;
                $trans->trans_code = $trans_code;
                $trans->trans_user_id = Auth::id();
                $trans->trans_user_bank_id = $bank_id;
                $trans->trans_payment_id = 6;//pw
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
                    // harga persen poin per produk
                    $persen_produk = $produk['produk_poin'];

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
                    $transDetail->trans_detail_persen_poin = $persen_produk;
                    $transDetail->trans_detail_amount_poin = ($item['trans_detail_amount_total'] / 100 * $persen_produk) / $harga_poin;
                    $transDetail->trans_detail_status = 1;
                    $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
                    $transDetail->save();
                    // update stock
                    $produk->produk_stock = $produk->produk_stock - $item['trans_detail_qty'];
                    $produk->save();

                    // memasukkan poin per produk ke total untuk pembayaran masedi
                    $total_poin += $transDetail->trans_detail_amount_poin;
                    // wallet per produk yang harus dibayar menggunakan poin
                    $total_wallet_poin += ($item['trans_detail_amount_total'] / 100 * $persen_produk);
                    // memasukkan wallet per produk ke total untuk pembayaran masedi
                    $total_wallet += ($item['trans_detail_amount_total'] - ($item['trans_detail_amount_total'] / 100 * $persen_produk));
                }
                // update amount trans
                $trans->trans_amount = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount');
                $trans->trans_amount_ship = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_ship');
                $trans->trans_amount_total = FunctionLib::array_sum_key($trans->trans_detail()->get()->toArray(), 'trans_detail_amount_total');
                // $total_poin = ($trans->trans_amount_total / 100 * $persen_poin) / $harga_poin;
                $poin += $total_poin;
                $gross_amount += $total_wallet;
                $trans->save();

                // insert trans_poin
                $new_poin = new Trans_poin;
                $new_poin->trans_poin_trans_id = $trans->id;
                $new_poin->trans_poin_persen = 0;
                $new_poin->trans_poin_compare = $harga_poin;
                $new_poin->trans_poin_poin_total = $total_poin;
                $new_poin->trans_poin_total = $total_wallet_poin;
                $new_poin->trans_poin_note = 'pembayaran poin untuk transaksi '.$trans_code.'.';
                $new_poin->save();
            }
            if(Session::has('voucher')){
                $voucher = Session::get('voucher');
                $new_voucher = new Trans_voucher;
                $new_voucher->trans_voucher_user = Auth::id();
                $new_voucher->trans_voucher_trans = $trans_code;
                $new_voucher->trans_voucher_code = $voucher['code'];
                $new_voucher->trans_voucher_amount = $voucher['amount'];
                // $new_voucher->trans_voucher_status = 0;
                $new_voucher->save();
                Session::forget('voucher');
            }
            Session::forget('chart');
            if(isset($trans->pembeli->email)){
                // send email
                $status = FunctionLib::trans_arr(1);
                $config = [
                    'to' => $trans->pembeli->email,
                    'data' => [
                        'trans_code' => $trans_code,
                        'trans_amount_total' => FunctionLib::number_to_text($poin).' POIN + '. 'Rp.'.FunctionLib::number_to_text($gross_amount).' masedi wallet',
                        'status' => $status,
                    ]
                ];
                $send_notif = FunctionLib::transaction_pw_notif($config);
                if(isset($send_notif['status']) && $send_notif['status'] == 200){
                    $message .= ' ,'.$send_notif['message'];
                }
            }

            $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
            $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
            // Required pembayaran masedi
            $transaction_details = array(
              'note' => $trans_code,
              'price' => $gross_amount, // no decimal allowed for creditcard
              'poin' => $poin, // no decimal allowed for creditcard
            );
            try{
                $masedi = FunctionLib::masedi('pay_poin', $transaction_details);
                // $masedi = FunctionLib::masedi_payment($transaction_details);
                // $masedi = [
                //       "status" => true,
                //       "va" => "WUN2NLT4HJ"
                //     ];
                if($masedi['status'] == true){
                    $trans = Trans::where('trans_code', $trans_code)->update(['trans_qr'=>$masedi['data']['va']]);
                }
            }catch(\Exception $err){
                
            }
            $data['trans_detail'] = $trans_detail;
            return view('localapi.masedi.index', $data);
        }else{
            $status = 500;
            $message = 'Barang yang anda masukkan ke keranjang kosong.';
            return ['status' => $status, 'message' => $message];
        }
    }

    public function payment(){
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            $data = Session::get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            $trans_code = FunctionLib::str_rand(7);
            $gross_amount = 0;
            if(Session::has('voucher')){
                $voucher = Session::get('voucher');
                $vcr = Trans_voucher::where('trans_voucher_code', $voucher['code']);
                $check = $vcr->exists();
                if($check){
                    $status = 500;
                    $message = 'mohon maaf voucher yang anda gunakan sudah digunakan di transaksi lain, silahkan gunakan voucher lain atau hubungi admin greenplaza';                    
                    return ['status' => $status, 'message' => $message];
                }
            }
            foreach ($trans as $value) {
                // dd(Session::get('chart'));
                foreach ($value as $key => $item) {
                    $produk = Produk::findOrFail($item['trans_detail_produk_id']);
                    if($item['trans_detail_qty'] > $produk->produk_stock){
                        $status = 500;
                        $message = 'Mohon maaf, Stok tidak mencukupi untuk pemesanan produk '.$produk->produk_name;//.', item order akan otomatis dihapus dari chart.';

                        // $array = Session::get('chart');
                        // unset($array[$id]);
                        // $data = $array;
                        // Session::forget('chart');
                        // Session::put('chart', $data);
                        // Session::save();

                        return ['status' => $status, 'message' => $message];
                        // return redirect()->back()
                        //     ->with(['status' => $status, 'message' => $message]);
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
                $trans->trans_payment_id = 3;
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
            if(Session::has('voucher')){
                $voucher = Session::get('voucher');
                $new_voucher = new Trans_voucher;
                $new_voucher->trans_voucher_user = Auth::id();
                $new_voucher->trans_voucher_trans = $trans_code;
                $new_voucher->trans_voucher_code = $voucher['code'];
                $new_voucher->trans_voucher_amount = $voucher['amount'];
                // $new_voucher->trans_voucher_status = 0;
                $new_voucher->save();
                $gross_amount = FunctionLib::minus_to_zero($gross_amount - $voucher['amount']);
                Session::forget('voucher');
            }
            Session::forget('chart');
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
            // Required pembayaran masedi
            $transaction_details = array(
              'note' => $trans_code,
              'price' => $gross_amount, // no decimal allowed for creditcard
            );
            try{
                $masedi = FunctionLib::masedi_payment($transaction_details);
                // $masedi = [
                //       "status" => true,
                //       "va" => "WUN2NLT4HJ"
                //     ];
                if($masedi['status'] == true){
                    $trans->trans_qr = $masedi['va'];
                    $trans->save();
                }
            }catch(\Exception $err){
                
            }
            $data['trans_detail'] = $trans_detail;
            return view('localapi.masedi.index', $data);
        }else{
            $status = 500;
            $message = 'Barang yang anda masukkan ke keranjang kosong.';
            return ['status' => $status, 'message' => $message];
        }
    }

    public function qr($code){
        $trans = Trans::whereRaw('trans_code = "'.$code.'"')->get();
        $data['qr'] = $trans->first()->trans_qr;

        return view('localapi.masedi.qr', $data);
    }

    public function qr_hotlist($code){
        $trans = Trans_hotlist::whereRaw('trans_hotlist_code = "'.$code.'"')->first();
        $data['qr'] = $trans->trans_hotlist_qr;

        return view('localapi.masedi.qr', $data);
    }

    public function qr_iklan($code){
        $trans = Trans_iklan::whereRaw('trans_iklan_code = "'.$code.'"')->first();
        $data['qr'] = $trans->trans_iklan_qr;

        return view('localapi.masedi.qr', $data);
    }

    /**
    * @param
    * @return
    */
    public function done(Request $request){
        $data = $request->all();
        extract($data);

        $status = 200;
        $message = 'Transfer confirmed!';
        switch ($transaction_status) {
            case 'settlement':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail){
                    foreach ($trans_detail as $item) {
                        $trans_detail = Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Successfully.';
                        $trans_detail->save();
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 3;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $where = 'wallet_user_id='.$trans_detail->trans_hotlist_user_id;
                                $where .= ' AND wallet_type='.(6);
                                $saldo = Wallet::whereRaw($where)->first();
                                $saldo->wallet_ballance_before = $saldo->wallet_ballance;
                                $saldo->wallet_ballance = $saldo->wallet_ballance + $trans_detail->paket->paket_hotlist_amount + $trans_detail->paket->paket_hotlist_bonus;
                                $saldo->wallet_note = 'Update wallet hotlist dengan pembelian paket '.$trans_detail->paket->paket_hotlist_name.'.';
                                $saldo->save();
                        break;
                        case 'pincode':
                            $trans_detail = Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 3;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Successfully. approved by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $where = 'wallet_user_id='.$trans_detail->trans_hotlist_user_id;
                                $where .= ' AND wallet_type='.(5);
                                $saldo = Wallet::whereRaw($where)->first();
                                $saldo->wallet_ballance_before = $saldo->wallet_ballance;
                                $saldo->wallet_ballance = $saldo->wallet_ballance + $trans_detail->paket->paket_pincode_amount + $trans_detail->paket->paket_pincode_bonus;
                                $saldo->wallet_note = 'Update wallet pincode dengan pembelian paket '.$trans_detail->paket->paket_pincode_name.'.';
                                $saldo->save();
                        break;
                        case 'iklan':
                            $trans_detail = Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 3;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer Successfully. approved by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Successfully. approved by system.';
                            $trans_detail->save();
                                // update saldo hotlist
                                $where = 'wallet_user_id='.$trans_detail->trans_hotlist_user_id;
                                $where .= ' AND wallet_type='.(4);
                                $saldo = Wallet::whereRaw($where)->first();
                                $saldo->wallet_ballance_before = $saldo->wallet_ballance;
                                $saldo->wallet_ballance = $saldo->wallet_ballance + $trans_detail->paket->paket_iklan_amount + $trans_detail->paket->paket_iklan_bonus;
                                $saldo->wallet_note = 'Update wallet iklan dengan pembelian paket '.$trans_detail->paket->paket_iklan_name.'.';
                                $saldo->save();
                        break;
                        default:
                            $status = 500;
                            $message = 'Transfer Failed!';
                        break;
                    }
                }
                return response()->json(['message'=>$message, 'status'=>$status]);
            break;
            case 'pending':
            break;
            case 'expire':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail){
                    foreach ($trans_detail as $item) {
                        $trans_detail = Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 3;
                        $trans_detail->trans_detail_transfer = 2;
                        $trans_detail->trans_detail_transfer_is_cancel = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer Expired, Transaction cancelled.';
                        $trans_detail->save();
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 4;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'pincode':
                            $trans_detail = Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 4;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'iklan':
                            $trans_detail = Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 4;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = 'Transfer Expired. updated by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer Expired. updated by system.';
                            $trans_detail->save();
                        break;
                        default:
                            $status = 500;
                            $message = 'Transfer Expired!';
                        break;
                    }
                }
                return response()->json(['message'=>$message, 'status'=>$status]);
            break;
            case 'deny':
                $in = 'select id from sys_trans where trans_code = "'.$order_id.'"';
                $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
                if($trans_detail){
                    foreach ($trans_detail as $item) {
                        $trans_detail = Trans_detail::findOrFail($item->id);
                        // to transfer
                        $trans_detail->trans_detail_status = 4;
                        $trans_detail->trans_detail_transfer = 2;
                        $trans_detail->trans_detail_transfer_is_cancel = 1;
                        $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                        $trans_detail->trans_detail_note = $trans_detail->trans_detail_note.' Transfer denied, Transaction cancelled.';
                        $trans_detail->save();
                    }
                }else{
                    $type = ((str_contains(strtolower($order_id), 'hl-'))?'hotlist'
                        :((str_contains(strtolower($order_id), 'ikl-'))?'iklan'
                        :((str_contains(strtolower($order_id), 'pc-'))?'pincode':'')));
                    switch ($type) {
                        case 'hotlist':
                            $trans_detail = Trans_hotlist::whereRaw('trans_hotlist_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_hotlist_status = 4;
                            $trans_detail->trans_hotlist_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_hotlist_response_note = 'Transfer deny. updated by system.';
                            $trans_detail->trans_hotlist_note = $trans_detail->trans_hotlist_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'pincode':
                            $trans_detail = Trans_pincode::whereRaw('trans_pincode_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_pincode_status = 4;
                            $trans_detail->trans_pincode_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_pincode_response_note = 'Transfer deny. updated by system.';
                            $trans_detail->trans_pincode_note = $trans_detail->trans_detail_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        case 'iklan':
                            $trans_detail = Trans_iklan::whereRaw('trans_iklan_code = "'.$order_id.'"')->first();
                            $trans_detail->trans_iklan_status = 4;
                            $trans_detail->trans_iklan_paid_date = date('y-m-d h:i:s');
                            $trans_detail->trans_iklan_response_note = ' Transfer deny. updated by system.';
                            $trans_detail->trans_iklan_note = $trans_detail->trans_iklan_note.' Transfer deny. updated by system.';
                            $trans_detail->save();
                        break;
                        default:
                            $status = 500;
                            $message = 'Transfer Denied!';
                        break;
                    }
                }
                return response()->json(['message'=>$message, 'status'=>$status]);
            break;
            default:
                return response()->json(['message'=>'failed', 'status'=>500]);
            break;
        }
    }
}