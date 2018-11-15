<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plugin;
use RajaOngkir;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function produk_newest($id)
    {
        $produk_newest = Plugin::produk_newest();
        return $produk_newest;
    }
    /**
    * @param
    * @return
    */
    public static function hot_promo($param=[]){
        $hot_promo = Plugin::hot_promo();
        return $hot_promo;
    }

    /**
    * @param
    * @return
    */
    public static function populer($param=[]){
        $populer = Plugin::populer();
        return $populer;
    }

    /**
    * @param
    * @return
    */
    public static function recommended($param=[]){
        $recommended = Plugin::recommended();
        return $recommended;
    }

    /**
    * @param
    * @return
    */
    public static function choose_shipment(Request $request, $produk_id){
        $status = 200;
        $message = "Choose shipment success.";
        $requestData = $request->all();
        extract($requestData);
        $req = [
            'data' => [
                'origin' => $origin,
                'originType' => $originType,
                'destination' => $destination,
                'destinationType' => $destinationType,
                'weight' => $weight,
                'courier' => $courier,
                'lenght' => $lenght,
                'width' => $width,
                'height' => $height
            ]
        ];
        $shipment = RajaOngkir::cost($req);
        $shipment = json_decode($shipment, true);
        if($shipment['rajaongkir']['status']['code'] !== 200){
            $status = 500;
            $message = $shipment['rajaongkir']['status']['code'];
        }
        $data['shipment'] = $shipment['rajaongkir']['results'];
        // code/name/costs
        // ->service/description/cost
        return view('localapi.choose-shipment', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
}
