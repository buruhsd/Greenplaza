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
        $this->middleware('auth');
        //Set Your server key
        Veritrans_Config::$serverKey = "SB-Mid-server-85pt78QsnOMMTenD-TwvkL1J";
        // Uncomment for production environment
        // Veritrans_Config::$isProduction = true;
        // Enable sanitization
        Veritrans_Config::$isSanitized = true;
        // Enable 3D-Secure
        Veritrans_Config::$is3ds = true;
    }

    /**
    * @param
    * @return
    */
    public function payment($param=[]){
        return view('localapi.midtrans.index');//, $data);
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
    public function process(){
        $data = Session::get('chart');
        $trans = [];
        array_walk($data, function ($item) use (&$trans) {
            $seller_id = Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_seller_id')[0];
            $trans[$seller_id][] = $item;
        });
        $trans_code = FunctionLib::str_rand(7);
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
                $transDetail->trans_detail_size = 's,m,l,xl';//$item['trans_detail_size'];
                $transDetail->trans_detail_color = 'blue,orange,red,green,white';//$item['trans_detail_color'];
                $transDetail->trans_detail_amount = $item['trans_detail_amount'];
                $transDetail->trans_detail_amount_ship = $item['trans_detail_amount_ship'];
                $transDetail->trans_detail_amount_total = $item['trans_detail_amount_total'];
                $transDetail->trans_detail_status = 1;
                $transDetail->trans_detail_note = "Transaction ".$item['trans_code']." at ".date("d-M-Y_H-i-s")."";
                $transDetail->save();
            }
        }


        // get produk seller $item['trans_detail_produk_id']
        // get Buyer Auth::id()
        // get Buyer address trans_detail_user_address_id
        $item_details = [];
        if(Session::has('chart') && FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total') > 0){
            // Required
            $transaction_details = array(
              'order_id' => rand(),
              'gross_amount' => FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'), // no decimal allowed for creditcard
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
}
