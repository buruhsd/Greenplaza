<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
use App\Models\Category;
use App\Models\Shipment;
use App\Models\Payment;
use Session;
use Auth;
use FunctionLib;
use App\Models\Trans_voucher;

class ChartController extends Controller
{
    public function chart(Request $request)
    {
        $type = $request->type;
        $gln_price = json_decode(FunctionLib::priceGln(), true);
        $categoryheader = Category::orderBy('created_at', 'DESC')->where('category_status', '=', 1)->limit(7)->get();
        return view('frontend.chart', compact('type', 'gln_price', 'categoryheader'));
    }

    public function delVoucher()
    {
        $status = 200;
        Session::forget('voucher');
        return ['status'=>$status];
    }

    public function addVoucher(Request $request)
    {
        $status = 200;
        $data = $request->all();
        $vcr = Trans_voucher::where('trans_voucher_code', $data['voucher']);
        $check = $vcr->exists();
        if($check){
            $status = 500;
            return ['status' => $status];
        }
        // if(!Session::has('voucher')){
        //     Session::put('voucher', []);
        // }
        // if(Session::has('voucher')){
            $voucher = [
                'code' => $data['voucher'],
                'amount' => $data['amount'],
            ];
        Session::forget('voucher');
        if(!Session::has('voucher')){
            Session::put('voucher', []);
        }
        Session::put('voucher', $voucher);
        Session::save();
        // }
        return ['status' => $status];
        // return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $data['type'] = $request->type;
        $data['payment'] = Payment::where('payment_status', 1)->whereIn('id', [2,4])->get();
        $data['gln'] = FunctionLib::gln('compare',[])['data'];
        $data['categoryheader'] = Category::orderBy('created_at', 'DESC')->where('category_status', '=', 1)->limit(7)->get();
        return view('frontend.checkout', $data);
    }

    /**
    *
    *
    **/
    public function addChart(Request $request, $id){
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $gln = json_decode(FunctionLib::priceGln(), true);
        $gln2 = $gln['price'];

        $produk = Produk::where('id', $id)->first();
        if($request->qty > $produk['produk_stock'] || $request->qty <= 0 || $request->qty == null || $request->qty == ""){
            return redirect()->back()->with(['flash_status' => 500,'flash_message' => 'Stock barang tidak mencukupi.']);
        }
        if($request->address_id == null || $request->address_id == ""){
            return redirect()->back()->with(['flash_status' => 500,'flash_message' => 'Silahkan isi alamat anda']);
        }
        if($request->ship_cost == null || $request->ship_cost == "" || $request->ship_cost == 0){
            return redirect()->back()->with(['flash_status' => 500,'flash_message' => 'Silahkan isi jasa pengiriman']);
        }
    	// random string
    	$trans_code = FunctionLib::str_rand(8);

        $courier = 0;
        // print_r($request->courier);
        if(!empty($request->courier)){
            $courier = Shipment::where('shipment_name', '=', strtoupper($request->courier))->pluck('id')[0];
        }
        if($courier == null || $courier == "" || $courier == 0){
            return redirect()->back()->with(['flash_status' => 500,'flash_message' => 'Silahkan isi jasa pengiriman']);
        }
        $price = $produk['produk_price'] * $request->qty;
        $price_myr = $produk['price_myr'] * $request->qty;
        $price_gln = $produk['gln_coin'] * $request->qty;
    	$transaction = [
			'trans_code' => $trans_code,
			'trans_detail_produk_id' => $produk['id'],
			'trans_detail_shipment_id' => $courier,
            'trans_detail_shipment_service' => $request->ship_service,
			'trans_detail_user_address_id' => intval($request->address_id),
			'trans_detail_no_resi' => "",
			'trans_detail_qty' => $request->qty,
			'trans_detail_size' => $request->size,
			'trans_detail_color' => $request->color,
            'trans_detail_amount' => $price,
            'trans_detail_amount_myr' => $price_myr,
			'trans_detail_amount_gln' => $price_gln,
			'trans_detail_amount_ship' => $request->ship_cost,
            'trans_detail_amount_total' => ($price + $request->ship_cost),
            'trans_detail_amount_total_myr' => ($price_myr + $request->ship_cost),
			'trans_detail_amount_total_gln' => $price_gln + ($request->ship_cost/$gln2),
			'trans_detail_status' => 0,
			'trans_detail_note' => $request->note,
            'myr' => $kurs['Data']['MYR']['Beli']
		];
        // dd($transaction);
		if(!Session::has('chart')){
        	Session::put('chart', []);
		}
        Session::push('chart', $transaction);
        Session::save();

        $status = 200;
        $message = 'Item pembelian berhasil masuk ke chart.';
    	return redirect()->back()->with(['flash_status' => $status,'flash_message' => $message]);
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
