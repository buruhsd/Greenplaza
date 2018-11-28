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
use App\Models\User_address;
use App\User;

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
            foreach (Session::get('chart') as $key => $item) {
                $item_details[] = [
                    'id' => $key,
                    'price' => $item['trans_detail_amount_total'],
                    'quantity' => $item['trans_detail_qty'],
                    'name' => Produk::where('id', $item['trans_detail_produk_id'])->pluck('produk_name')[0]
                ];
            }
            // Optional
            $billing_address = array(
              'first_name'    => "Andri",
              'last_name'     => "Litani",
              'address'       => "Mangga 20",
              'city'          => "Jakarta",
              'postal_code'   => "16602",
              'phone'         => "081122334455",
              'country_code'  => 'IDN'
            );
            // Optional
            $shipping_address = array(
              'first_name'    => "Obet",
              'last_name'     => "Supriadi",
              'address'       => "Manggis 90",
              'city'          => "Jakarta",
              'postal_code'   => "16601",
              'phone'         => "08113366345",
              'country_code'  => 'IDN'
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
            // Optional, remove this to display all available payment methods
            $enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');
            // Fill transaction details
            $transaction = array(
              'enabled_payments' => $enable_payments,
              'transaction_details' => $transaction_details,
              'customer_details' => $customer_details,
              'item_details' => $item_details,
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
