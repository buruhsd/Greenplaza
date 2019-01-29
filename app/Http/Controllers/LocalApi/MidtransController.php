<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plugin;
use FunctionLib;
use Veritrans_Config;
use Veritrans_Snap;
use Session;
use App\Models\Produk;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_hotlist;
use App\Models\Trans_iklan;
use App\Models\Trans_pincode;
use App\Models\User_address;
use App\User;
use Auth;

class MidtransController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        //Set Your server key
        Veritrans_Config::$serverKey = env('VERYTRANS_KEY');
        // Veritrans_Config::$serverKey = "SB-Mid-server-85pt78QsnOMMTenD-TwvkL1J";
        // Uncomment for production environment
        Veritrans_Config::$isProduction = true;
        // Enable sanitization
        Veritrans_Config::$isSanitized = env('VERYTRANS_SANITIZED');
        // Veritrans_Config::$isSanitized = true;
        // Enable 3D-Secure
        Veritrans_Config::$is3ds = env('VERYTRANS_3DS');
        // Veritrans_Config::$is3ds = true;
    }

    /**
    * @param
    * @return
    */
    public function pincode_payment($code){
        $trans_pincode = Trans_pincode::whereRaw('trans_pincode_code = "'.$code.'"')->first();

        $trans_code = $code;
        $gross_amount = $trans_pincode->trans_pincode_amount;
        // Required
        $transaction_details = array(
          'order_id' => $trans_code,
          'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );
        $transaction = array(
          'transaction_details' => $transaction_details,
        );
        $data['trans_pincode'] = $trans_pincode;
        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        // dd($data['trans_detail']);
        return view('localapi.midtrans.pincode_index', $data);//, $data);
    }

    /**
    * @param
    * @return
    */
    public function iklan_payment($code){
        $trans_iklan = Trans_iklan::whereRaw('trans_iklan_code = "'.$code.'"')->first();

        $trans_code = $code;
        $gross_amount = $trans_iklan->trans_iklan_amount;
        // Required
        $transaction_details = array(
          'order_id' => $trans_code,
          'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );
        $transaction = array(
          'transaction_details' => $transaction_details,
        );
        $data['trans_iklan'] = $trans_iklan;
        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        // dd($data['trans_detail']);
        return view('localapi.midtrans.iklan_index', $data);//, $data);
    }

    /**
    * @param
    * @return
    */
    public function hotlist_payment($code){
        $trans_hotlist = Trans_hotlist::whereRaw('trans_hotlist_code = "'.$code.'"')->first();

        $trans_code = $code;
        $gross_amount = $trans_hotlist->trans_hotlist_amount;
        // Required
        $transaction_details = array(
          'order_id' => $trans_code,
          'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );
        $transaction = array(
          'transaction_details' => $transaction_details,
        );
        $data['trans_hotlist'] = $trans_hotlist;
        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        // dd($data['trans_detail']);
        return view('localapi.midtrans.hotlist_index', $data);//, $data);
    }

    /**
    * @param
    * @return
    */
    public function payment($param=[]){
        dd(env('VERYTRANS_KEY'));
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            $data = Session::get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            $trans_code = FunctionLib::str_rand(7);
            $gross_amount = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');
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
                $trans->trans_payment_id = 2;
                $trans->trans_amount = FunctionLib::array_sum_key($value, 'trans_detail_amount');
                $trans->trans_amount_ship = FunctionLib::array_sum_key($value, 'trans_detail_amount_ship');
                $trans->trans_amount_total = FunctionLib::array_sum_key($value, 'trans_detail_amount_total');
                $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
                $trans->save();
                foreach ($value as $key => $item) {
                    $produk = Produk::findOrFail($item['trans_detail_produk_id']);
                    if($produk->grosir()->exists()){
                        foreach ($produk->grosir()->get() as $grosir) {
                            if($item['trans_detail_qty'] >= $grosir->produk_grosir_start && $item['trans_detail_qty'] <= $grosir->produk_grosir_end){
                                $item['trans_detail_amount'] = ($grosir->produk_grosir_price * $item['trans_detail_qty']);
                                $item['trans_detail_amount_total'] = $item['trans_detail_amount'] + $item['trans_detail_amount_ship'];
                            }
                        }
                    }
                    $transDetail = new Trans_detail;
                    $transDetail->trans_detail_trans_id = $trans->id;
                    $transDetail->trans_code = $item['trans_code'];
                    $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
                    $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
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
            }
            Session::forget('chart');

            $item_details = [];
            $in = 'select id from sys_trans where trans_code = "'.$trans_code.'"';
            $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
            // Required
            $transaction_details = array(
              'order_id' => $trans_code,
              'gross_amount' => $gross_amount, // no decimal allowed for creditcard
            );
            $transaction = array(
              'transaction_details' => $transaction_details,
            );
            $data['trans_detail'] = $trans_detail;
            $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
            // return view('localapi.midtrans.checkout-process', $data);
            return view('localapi.midtrans.index', $data);
        }else{
            $status = 500;
            $message = 'Total Amount must more then 0.01';
            return ['status' => $status, 'message' => $message];
        }
    }

    /**
    * @param
    * @return
    */
    public function re_payment_code($code){
        $in = 'select id from sys_trans where trans_code = "'.$code.'"';
        $where = 'trans_detail_trans_id IN ('.$in.')';
        $where .= ' AND trans_detail_status = 1';
        $trans_detail = Trans_detail::whereRaw($where)->get();

        $trans_code = $code;
        $gross_amount = FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total');
        // Required
        $transaction_details = array(
          'order_id' => $trans_code,
          'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );
        $transaction = array(
          'transaction_details' => $transaction_details,
        );
        $data['trans_detail'] = $trans_detail;
        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        // dd($data['trans_detail']);
        return view('localapi.midtrans.re_index', $data);//, $data);
    }

    /**
    * @param
    * @return
    */
    public function re_payment($code){
        // $trans = Trans::whereId($code)->first();

        $in = 'select id from sys_trans where trans_code = "'.$code.'"';
        $where = 'trans_detail_trans_id IN ('.$in.')';
        $where .= ' AND trans_detail_status = 1';
        $trans_detail = Trans_detail::whereRaw($where)->get();
        // $in = 'select id from sys_trans where trans_code = "'.$code.'"';
        // $trans_detail = Trans_detail::whereRaw('trans_detail_trans_id IN ('.$in.')')->get();
        // $trans_detail = $trans->trans_detail()->get();

        $trans_code = $code;
        $gross_amount = FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total');
        // Required
        $transaction_details = array(
          'order_id' => $trans_code,
          'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );
        $transaction = array(
          'transaction_details' => $transaction_details,
        );
        $data['trans_detail'] = $trans_detail;
        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        // dd($data['trans_detail']);
        return view('localapi.midtrans.re_index', $data);//, $data);
    }

    /**
    * @param
    * @return
    */
    public function simple_process($param=[]){
        // Required
        $transaction_details = array(
          'order_id' => rand(),
          'gross_amount' => 94000, // no decimal allowed for creditcard
        );
        // Optional
        $item_details = array (
            array(
              'id' => 'a1',
              'price' => 94000,
              'quantity' => 1,
              'name' => "Apple"
            ),
          );
        // Optional
        $customer_details = array(
          'first_name'    => "Andri",
          'last_name'     => "Litani",
          'email'         => "andri@litani.com",
          'phone'         => "081122334455",
          'billing_address'  => $billing_address,
          'shipping_address' => $shipping_address
        );
        // Fill transaction details
        $transaction = array(
          'transaction_details' => $transaction_details,
          'customer_details' => $customer_details,
          'item_details' => $item_details,
        );

        $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
        return view('localapi.midtrans.checkout-process-simple-version', $data);
    }

    /**
    * @param
    * @return
    */
    public function process(Request $request){
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            $data = Session::get('chart');
            $trans = [];
            array_walk($data, function ($item) use (&$trans) {
                $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
                $trans[$seller_id][] = $item;
            });
            $trans_code = FunctionLib::str_rand(7);
            $gross_amount = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');

            foreach ($trans as $value) {
                // add to DB sys_trans
                $trans = new Trans;
                $trans->trans_code = $trans_code;
                $trans->trans_user_id = Auth::id();
                $trans->trans_user_bank_id = Auth::user()->first()->user_bank()->where('user_bank_status', 1)->first()->id;
                // $trans->trans_is_paid = $request->trans_is_paid;
                $trans->trans_payment_id = 2;
                // $trans->trans_paid_image = $request->trans_paid_image;
                // $trans->trans_paid_date = $request->trans_paid_date;
                // $trans->trans_paid_note = $request->trans_paid_note;
                $trans->trans_amount = FunctionLib::array_sum_key($value, 'trans_detail_amount');
                $trans->trans_amount_ship = FunctionLib::array_sum_key($value, 'trans_detail_amount_ship');
                $trans->trans_amount_total = FunctionLib::array_sum_key($value, 'trans_detail_amount_total');
                $trans->trans_note = "Transaction ".$trans->trans_code." at ".date("d-M-Y_H-i-s")."";
                $trans->save();
                foreach ($value as $key => $item) {
                    $transDetail = new Trans_detail;
                    $transDetail->trans_detail_trans_id = $trans->id;
                    $transDetail->trans_code = $item['trans_code'];
                    $transDetail->trans_detail_produk_id = $item['trans_detail_produk_id'];
                    $transDetail->trans_detail_shipment_id = $item['trans_detail_shipment_id'];
                    $transDetail->trans_detail_user_address_id = $item['trans_detail_user_address_id'];
                    // $transDetail->trans_detail_no_resi = $item['trans_detail_no_resi'];
                    $transDetail->trans_detail_qty = $item['trans_detail_qty'];
                    $transDetail->trans_detail_size = $item['trans_detail_size'];//'s,m,l,xl';
                    $transDetail->trans_detail_color = $item['trans_detail_color'];//'blue,orange,red,green,white';
                    $transDetail->trans_detail_amount = $item['trans_detail_amount'];
                    $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
                    $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
                    $transDetail->trans_detail_status = 1;
                    $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
                    $transDetail->save();
                }
            }
            Session::forget('chart');

            // get produk seller $item['trans_detail_produk_id']
            // get Buyer Auth::id()
            // get Buyer address trans_detail_user_address_id
            $item_details = [];
            // Required
            $transaction_details = array(
              'order_id' => $trans_code,
              'gross_amount' => $gross_amount, // no decimal allowed for creditcard
            );
            // foreach (Session::get('chart') as $key => $item) {
            //     $item_details[] = [
            //         'id' => $key,
            //         'price' => $item['trans_detail_amount_total'],
            //         'quantity' => $item['trans_detail_qty'],
            //         'name' => Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_name')[0]
            //     ];
            // }
            // // Optional
            // $billing_address = array(
            //   'first_name'    => "Andri",
            //   'last_name'     => "Litani",
            //   'address'       => "Mangga 20",
            //   'city'          => "Jakarta",
            //   'postal_code'   => "16602",
            //   'phone'         => "081122334455",
            //   'country_code'  => 'IDN'
            // );
            // // Optional
            // $shipping_address = array(
            //   'first_name'    => "Obet",
            //   'last_name'     => "Supriadi",
            //   'address'       => "Manggis 90",
            //   'city'          => "Jakarta",
            //   'postal_code'   => "16601",
            //   'phone'         => "08113366345",
            //   'country_code'  => 'IDN'
            // );
            // // Optional
            // $customer_details = array(
            //   'first_name'    => "Andri",
            //   'last_name'     => "Litani",
            //   'email'         => "andri@litani.com",
            //   'phone'         => "081122334455",
            //   'billing_address'  => $billing_address,
            //   'shipping_address' => $shipping_address
            // );
            // // Optional, remove this to display all available payment methods
            // $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');
            // // Fill transaction details
            // $transaction = array(
            //   'enabled_payments' => $enable_payments,
            //   'transaction_details' => $transaction_details,
            //   'customer_details' => $customer_details,
            //   'item_details' => $item_details,
            // );
            $transaction = array(
              'transaction_details' => $transaction_details,
            );
            $data['snapToken'] = Veritrans_Snap::getSnapToken($transaction);
            return view('localapi.midtrans.checkout-process', $data);
        }else{
            $status = 500;
            $message = 'Total Amount must more then 0.01';
            return ['status' => $status, 'message' => $message];
        }
    }

    /**
    * @param
    * @return
    */
    public function done(Request $request){
        // dd($request);
        // return response()->json('tes');
        // return response()->json(['message'=>'failed', 'status'=>500]);
        // $order_id = $data['order_id'];
        // $transaction_time = $data['transaction_time'];
        // $gross_amount = $data['gross_amount'];
        // $order_id = $data['order_id'];
        // $payment_type = $data['payment_type'];
        // $signature_key = $data['signature_key'];
        // $status_code = $data['status_code'];
        // $transaction_id = $data['transaction_id'];
        // $transaction_status = $data['transaction_status'];
        // $fraud_status = $data['fraud_status'];
        // $status_message = $data['status_message'];
        $data = $request->all();
        extract($data);
        // dd($status_message);

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
                                $saldo = App\Models\Wallet::whereRaw($where)->first();
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
                                $saldo = App\Models\Wallet::whereRaw($where)->first();
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
                                $saldo = App\Models\Wallet::whereRaw($where)->first();
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
