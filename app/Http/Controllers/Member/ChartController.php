<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
use App\Models\Shipment;
use Session;
use Auth;
use FunctionLib;

class ChartController extends Controller
{
    public function chart()
    {
        return view('frontend.chart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    /**
    *
    *
    **/
    public function addChart(Request $request, $id){
    	$produk = Produk::where('id', $id)->first();
        if($request->qty > $produk['produk_stock']){
            return redirect()->back()->with(['flash_status' => 500,'flash_message' => 'Stock is influence']);
        }
    	// dd($request);
    	// random string
    	$trans_code = FunctionLib::str_rand(5);

        $courier = 0;
        print_r($request->courier);
        if(!empty($request->courier)){
            $courier = Shipment::where('shipment_name', '=', strtoupper($request->courier))->pluck('id')[0];
        }
    	$transaction = [
			'trans_code' => $trans_code,
			'trans_detail_produk_id' => $produk['id'],
			'trans_detail_shipment_id' => $courier,
			'trans_detail_user_address_id' => intval($request->address_id),
			'trans_detail_no_resi' => "",
			'trans_detail_qty' => $request->qty,
			'trans_detail_size' => $request->size,
			'trans_detail_color' => $request->color,
			'trans_detail_amount' => $produk['produk_price'],
			'trans_detail_amount_ship' => $request->ship_cost,
			'trans_detail_amount_total' => ($produk['produk_price'] + $request->ship_cost),
			'trans_detail_status' => 0,
			'trans_detail_note' => $request->note
		];
		if(!Session::has('chart')){
        	Session::put('chart', []);
		}
        Session::push('chart', $transaction);
        Session::save();

        $status = 200;
        $message = 'Add Chart Successfully';
    	return redirect()->back()->with(['flash_status' => $status,'flash_message' => $message]);;
    }

    /**
    *
    *
    **/
    public function destroy($id="all"){
        if($id != "all"){
            $array = Session::get('chart');
            unset($array[$id]);
            $data = $array;
            Session::forget('chart');
            Session::put('chart', $data);
            Session::save();
        }else{
            Session::forget('chart');
            Session::save();
        }

    	return redirect()->back();
    }
    
}
