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
use Exception;

class GlnController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function payment(){
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            $data = Session::get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            if(Session::has('voucher')){
                if(count($trans) > 1){
                    $status = 500;
                    $message = 'Mohon maaf, untuk pembelian menggunakan voucher masedi dan gln hanya bisa digunakan untuk membeli dari satu toko saja.';
                    return ['status' => $status, 'message' => $message];
                }
            }
            $trans_code = FunctionLib::str_rand(7);
            $gross_amount = 0;
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
                $trans->trans_payment_id = 4;
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
            }
            Session::forget('voucher');
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
            $data['trans_detail'] = $trans_detail;
            return view('localapi.gln.index', $data);
        }else{
            $status = 500;
            $message = 'Barang yang anda masukkan ke keranjang kosong.';
            return ['status' => $status, 'message' => $message];
        }
    }

    /**
    * @param
    * @return
    */
    public function re_payment($code){
        $in = 'select id from sys_trans where trans_code = "'.$code.'"';
        $where = 'trans_detail_trans_id IN ('.$in.')';
        $where .= ' AND trans_detail_status = 1';
        $trans_detail = Trans_detail::whereRaw($where)->get();

        $data['trans_detail'] = $trans_detail;
        // dd($data['trans_detail']);
        return view('localapi.gln.re_index', $data);//, $data);
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