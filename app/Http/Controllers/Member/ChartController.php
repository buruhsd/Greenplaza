<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
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
    	// dd($produk);
    	// random string
    	$trans_code = FunctionLib::str_rand(5);

    	$transaction = [
			'trans_code' => $trans_code,
			'trans_detail_produk_id' => $produk['id'],
			// 'trans_detail_shipment_id' => $produk->shipment_id,
			// 'trans_detail_user_address_id' => $produk->user_address_id,
			'trans_detail_no_resi' => "",
			// 'trans_detail_qty' => $request->qty,
			// 'trans_detail_size' => $request->size,
			// 'trans_detail_color' => $request->color,
			'trans_detail_amount' => $produk['produk_price'],
			// 'trans_detail_amount_ship' => $request->amount_ship,
			// 'trans_detail_amount_total' => $produk->amount + $request->amount_ship,
			'trans_detail_status' => 0,
			// 'trans_detail_note' => $request->note
		];
		if(!Session::has('chart')){
        	Session::put('chart', []);
		}
        Session::push('chart', $transaction);
        Session::save();
        dd(Session::get('chart'));

    	return true;
    }

    /**
    *
    *
    **/
    public function destroy(){
        Session::put('key', 'tes');
        Session::save();
        Session::forget('key');
        Session::save();

    	return true;
    }
    
}
