<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plugin;
use RajaOngkir;
use FunctionLib;

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
        $weight = $weight * $qty;
        $req = [
            'data' => [
                'origin' => $origin,
                'originType' => $originType,
                'destination' => $destination,
                'destinationType' => $destinationType,
                'weight' => $weight,
                'courier' => $courier,
            ]
        ];
        if(isset($lenght)){
            $req['data']['lenght'] = $lenght;
        }
        if(isset($width)){
            $req['data']['width'] = $width;
        }
        if(isset($height)){
            $req['data']['height'] = $height;
        }

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
    * @param
    * @return
    */
    public static function get_address(Request $request, $produk_id){
        $status = 200;
        $message = "Choose shipment success.";
        $requestData = $request->all();
        extract($requestData);
        $req = [
            'user_address_user_id' => Auth::id(),
            'user_address_label' => $request->label,
            'user_address_owner' => $request->owner,
            'user_address_address' => $request->address,
            'user_address_phone' => $request->phone,
            'user_address_tlp' => $request->tlp,
            'user_address_province' => $request->province,
            'user_address_city' => $request->city,
            'user_address_subdist' => $request->subdist,
            'user_address_pos' => $request->pos,
            'user_address_status' => $request->status,
            'user_address_note' => $request->note,
            'created_at' => $request->created_at,
            'updated_at' => $request->updated_at
        ];
    }

    /**
    * @param
    * @return
    */
    public static function get_province($id = 0){
        $data['province'] = FunctionLib::get_province($id);
        return $data;
    }

    /**
    * @param
    * @return
    */
    public static function get_city($id = 0){
        $data['city'] = FunctionLib::get_city($id);
        return $data;
    }

    /**
    * @param
    * @return
    */
    public static function get_subdistrict($id = 0){
        $data = FunctionLib::get_subdistrict($id);
        return $data;
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
}
