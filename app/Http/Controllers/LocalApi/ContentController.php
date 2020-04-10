<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conf_solusi;
use App\Models\Produk;
use Plugin;
use RajaOngkir;
use FunctionLib;
use App\Models\Subdistrict;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
    * @param id komplain type
    * @return
    */
    public static function ballance_gln($address = ""){
        $address = ($address !== "")?$address:Auth::user()->wallet()->where('wallet_type', 7)->first()->wallet_address;
        $response = FunctionLib::gln('ballance', ['address'=>$address]);
        if($response['status'] == 200){
            $return = $response['data']['balance'];
        }else{
            $return = 0;
        }
        return $return;
    }

    /**
    * @param id komplain type
    * @return
    */
    public static function get_hotlist($id = 0){
        $data = FunctionLib::get_hotlist($id);
        return $data;
    }

    /**
    * @param id komplain type
    * @return
    */

    public static function get_p_green($param = []){
        extract($param);
        $gln_price = json_decode(FunctionLib::priceGln(), true);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['price_gln'] = $gln_price['price'];
        // dd($gln_price);
        $data['p_green'] = Produk::where('produk_status', '!=', 2)
            ->where('produk_seller_id', 2)
            ->orderBy('updated_at', 'DESC')
            ->limit(8)
            ->get();
        return $data;
    }

    public static function get_solusi($id = 0){
        $data = Conf_solusi::first(null, new Conf_solusi)->get();
        if($id != 0){
            $data = Conf_solusi::whereRaw('solusi_komplain_id LIKE "'.$id.',%"')
                ->orWhereRaw('solusi_komplain_id LIKE "%,'.$id.'"')
                ->orWhereRaw('solusi_komplain_id = "'.$id.'"')
                ->get();
        }
        return $data;
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
        $originType = ($courier == 'jne')?'city':$originType;
        $origin = ($courier == 'jne')
            ?Subdistrict::find($origin)->subdistrict_city_id
            :$origin;
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
    * @param
    * @return
    */
    public static function get_db_province($id = 0){
        $data['province'] = FunctionLib::get_province($id, 'db');
        return $data;
    }

    /**
    * @param
    * @return
    */
    public static function get_db_city($id = 0){
        $data['city'] = FunctionLib::get_city($id, 'db');
        return $data;
    }

    /**
    * @param
    * @return
    */
    public static function get_db_subdistrict($id = 0){
        $data = FunctionLib::get_subdistrict($id, 'db');
        return $data;
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
}
