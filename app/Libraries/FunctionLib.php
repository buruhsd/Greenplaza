<?php
class FunctionLib
{

    /**
    * check user have conf shipment
    *
    **/
    public static function class_arr(){
        $arr = ['primary', 'success', 'default', 'warning', 'danger'];
        return $arr;
    }

    /**
    * check user have conf shipment
    *
    **/
    public static function have_shipment($id, $user_id){
        $user = App\Models\User_shipment::where('user_shipment_user_id', $user_id)->pluck('user_shipment_shipment_id')->toArray();
        // $shipment = App\Models\Shipment::pluck('id')->toArray();
        return (bool)in_array($id, $user);
    }

    /**
    * Upload image
    *
    **/
    public static function doUpload($file, $path, $field){
        $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(5).'.'.$file->getClientOriginalExtension();
        $imagesize = $file->getClientSize();
        $imagetmp = $file->getPathName();
        if($field !== '' && $field !== null){
            File::delete($path . '/' . $user->user_store_image);   
        }
        if(file_exists($path . '/' . $imagename)){// || file_exists($path . '/thumb' . $imagename)){
            $imagename = date("d-M-Y_H-i-s").'_'.FunctionLib::str_rand(6).'.'.$file->getClientOriginalExtension();
        }
        $file->move($path, $imagename);
        return $imagename;
    }
    /**
    * date indo
    * @param $date date, $day boolean
    **/
    public static function date_indo($tanggal, $cetak_hari = false, $type="date")
    {
        if($type == 'full'){
            $tanggal = date('Y-m-d', strtotime($tanggal));
        }
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    /**
    * date indo
    * @param $date date, $day boolean
    **/
    public static function date_en($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
    /**
    * @param
    * @return
    **/
    public static function address_info($id=0) {
        $address = "";
        if($id != 0){
            $item = App\Models\User_address::whereId($id)->first();
            $subdistrict = App\Models\Subdistrict::whereId($item->user_address_subdist)->pluck('subdistrict_name')[0];
            $city = App\Models\City::whereId($item->user_address_city)->pluck('city_name')[0];
            $province = App\Models\Province::whereId($item->user_address_province)->pluck('province_name')[0];
            $address = $item->user_address_address.', '.$subdistrict.', '.$city.', '.$province;
        }
        return $address;
    }

    /**
    * @param
    * @return
    **/
    public static function page($type="member") {
        switch ($type) {
            case 'member':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'member');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'member');
                }
            break;
            case 'seller':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'seller');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'seller');
                }
            break;
            case 'greenplaza':
                if(Auth::guest())
                {
                    $return = App\Models\Page::where('page_role_id', 0)
                        ->where('page_status', 1)
                        ->where('page_kategori', 'greenplaza');
                }else{
                    $return = App\Models\Page::whereIn('page_role_id', [0, Auth::user()->role])
                        ->where('page_status', 1)
                        ->where('page_kategori', 'greenplaza');
                }
            break;
            default:
                $page = [];
                break;
        }
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function config_arr($type="profil") {
        switch ($type) {
            case 'bank':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'bank_%')->pluck('configs_name');
                break;
            case 'profil':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'profil_%')->pluck('configs_name');
                break;
            case 'transaksi':
                $arr = App\Models\Conf_config::where('configs_name', 'LIKE', 'transaksi_%')->pluck('configs_name');
                break;
            default:
                $arr = [];
                break;
        }
        return $arr;
    }

	/**
	* @param
	* @return
	**/
    public static function str_rand($length = 5) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

    /**
    * @param
    * @return
    **/
    public static function get_config($type, $status = 1){
        $value = App\Models\Conf_config::where('configs_status', '=', $status)
            ->where('configs_name', $type)
            ->pluck('configs_value')[0];
        return $value;
    } 

    /**
    * @param
    * @return
    **/
    public static function number_to_text($numb, $decimal=2){
        return number_format($numb,$decimal,",",".");
    }

    /**
    * @param
    * @return
    **/
    public static function category_by_parent($parent_cat= 0, $limit= 8, $where= 1){
        $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
            SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
            FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
            JOIN (SELECT @pv:=$parent_cat)tmp
            WHERE category_parent_id IN (@pv)) a")[0];
        $cat = $cat->lv.",".$parent_cat;
        $return = App\Models\Category::whereIn("id", explode(",",$cat))
            ->whereRaw($where);
        return $return;

    }

    /**
    * @param
    * @return
    **/
    public static function produk_by_category($parent_cat= 0, $limit= 8, $where= 1, $order= "RAND()"){
        $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
            SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
            FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
            JOIN (SELECT @pv:=$parent_cat)tmp
            WHERE category_parent_id IN (@pv)) a")[0];
        $cat = $cat->lv.",".$parent_cat;
        $return = App\Models\Produk::whereIn("produk_category_id", explode(",",$cat))
            ->whereRaw($where)
            ->orderByRaw($order)
            ->skip(0)
            ->take($limit);
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function produk_by($status, $val= 0, $limit= 8, $where= 1, $order= "RAND()"){
        switch ($status) {
            case 'category':
                    $cat = Illuminate\Support\Facades\DB::select("SELECT GROUP_CONCAT(lv SEPARATOR ',') as lv FROM (
                        SELECT @pv:=(SELECT GROUP_CONCAT(id SEPARATOR ',') FROM sys_category WHERE
                        FIND_IN_SET(category_parent_id, @pv)) AS lv FROM sys_category
                        JOIN (SELECT @pv:=$val)tmp
                        WHERE category_parent_id IN (@pv)) a")[0];
                    $cat = $cat->lv.",".$val;
                    $return = App\Models\Produk::whereIn("produk_category_id", explode(",",$cat))
                        ->whereRaw($where)
                        ->orderByRaw($order)
                        ->skip(0)
                        ->take($limit);
                break;
            case 'brand':
                    $return = App\Models\Produk::where("produk_brand_id", $val)
                        ->whereRaw($where)
                        ->orderByRaw($order)
                        ->skip(0)
                        ->take($limit);
                break;
            
            default:
                    $return = [];
                break;
        }
        return $return;
    }

    /**
    * @param
    * @return
    **/
    public static function add_chart($produk_id){
        $produk = App\Models\Produk::where("id", $produk_id)->first();
        return true;

    }

    /**
    * @param
    * @return
    **/
    public static function insert_province(){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        $province = RajaOngkir::province($data);
        $province = json_decode($province, true);
        $province = $province['rajaongkir']['results'];
        foreach ($province as $item) {
            $province = new App\Models\Province;
            $province->id = $item['province_id'];
            $province->province_name = $item['province'];
            $province->save();
        }
        if(!$province){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function insert_city($id = 0){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        $city = RajaOngkir::city($data);
        $city = json_decode($city, true);
        $city = $city['rajaongkir']['results'];
        foreach ($city as $item) {
            $city = new App\Models\City;
            $city->id = $item['city_id'];
            $city->city_province_id = $item['province_id'];
            $city->city_province_name = $item['province'];
            $city->city_name = $item['city_name'];
            $city->city_type = $item['type'];
            $city->city_postal_code = $item['postal_code'];
            $city->save();
        }
        if(!$city){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function insert_subdistrict($offset = 0, $limit = 100){
        $data = [];
        $status = 200;
        $message = 'Province added!';

        // $city = FunctionLib::get_city();
        $city = App\Models\City::offset($offset)
                ->limit($limit)->pluck('id');
        foreach ($city as $item) {
            $data = ['id' => $item];
            $subdistrict = RajaOngkir::subdistrict($data);
            $subdistrict = json_decode($subdistrict, true);
            $subdistrict = $subdistrict['rajaongkir']['results'];
            foreach ($subdistrict as $item) {
                // dd($item);
                $subdistrict = new App\Models\Subdistrict;
                $subdistrict->id = $item['subdistrict_id'];
                $subdistrict->subdistrict_province_id = $item['province_id'];
                $subdistrict->subdistrict_province_name = $item['province'];
                $subdistrict->subdistrict_city_id = $item['city_id'];
                $subdistrict->subdistrict_city_name = $item['city'];
                $subdistrict->subdistrict_city_type = $item['type'];
                $subdistrict->subdistrict_name = $item['subdistrict_name'];
                $subdistrict->save();
            }
        }
        if(!$subdistrict){
            $status = 500;
            $message = 'Province Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param
    * @return
    **/
    public static function get_province($id = 0){
        $data = [];
        if($id != 0){
            $data = ['id' => $id];
        }
        $province = RajaOngkir::province($data);
        $province = json_decode($province, true);
        $province = $province['rajaongkir']['results'];
        return $province;
    }

    /**
    * @param
    * @return
    **/
    public static function get_city($id = 0){
        $data = [];
        if($id != 0){
            $data = ['id' => $id];
        }
        $city = RajaOngkir::city($data);
        $city = json_decode($city, true);
        $city = $city['rajaongkir']['results'];
        return $city;
    }

    /**
    * @param
    * @return
    **/
    public static function get_subdistrict($id = 0){
        $data = [];
        if($id != 0){
            $data = ['id' => $id];
        }
        $subdistrict = RajaOngkir::subdistrict($data);
        $subdistrict = json_decode($subdistrict, true);
        $subdistrict = $subdistrict['rajaongkir']['results'];
        return $subdistrict;
    }

    /**
    * @param
    * @return
    **/
    public static function get_waybill($id = 0){
        $data = [];
        $status = 'Receipt Number is not valid';
        if($id != 0){
            $item = App\Models\Trans_detail::whereId($id)->first();
            if($item){
                $req = [
                    'data' => [
                        'waybill' => $item->trans_detail_no_resi,
                        'courier' => strtolower($item->shipment->shipment_name),
                    ]
                ];

                $shipment = RajaOngkir::waybill($req);
                $shipment = json_decode($shipment, true);
                if($shipment['rajaongkir']['status']['code'] && $shipment['rajaongkir']['status']['code'] == 200){
                    if(delivered){
                        $status = 'Sent';
                    }else{
                        $status = 'On Process';
                    }
                }else{
                    $status = 'Receipt Number is not valid';
                }
            }
        }
        return $status;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk($status = "", $id = 0){
        $where = 1;
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where);
        if($id != 0){
            $total = $total->where("produk_seller_id", $id);
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk_hot($status = "", $id = 0){
        $where = 1;
        $where .= " AND produk_is_hot = 1";
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where);
        if($id != 0){
            $total = $total->where("produk_seller_id", $id);
        }
        $total = $total->count();
        return $total;
    }


    /**
    * @param
    * @return
    **/
    public static function data_user_by_id($id= 0){
        $where = "id = ".$id;
        $data = App\User::whereRaw($where)->first();
        return $data;
    }

    public static function array_sum_key( $arr, $index = null ){
        if(!is_array( $arr ) || sizeof( $arr ) < 1){
            return 0;
        }
        $ret = 0;
        foreach( $arr as $id => $data ){
            if( isset( $index )  ){
                $ret += (isset( $data[$index] )) ? $data[$index] : 0;
            }else{
                $ret += $data;
            }
        }
        return $ret;
    }

    /**
    * @param $status = status transaksi
    * @param $id = id user
    * @param $type = status user
    * @return
    **/
    public static function count_trans($status = "", $id = 0, $type = 'buyer'){
        $where = 1;
        if($status !== ""){
            $where .= " AND trans_detail_status IN (".$status.")";
        }
        $total = App\Models\Trans_detail::whereRaw($where);
        if($id != 0){
            if($type == 'seller'){
                $total = $total->whereRaw("trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".$id.")");
            }else{
                $total = $total->leftjoin('sys_trans', 'sys_trans.id', 'sys_trans_detail.trans_detail_trans_id')
                    ->where("trans_user_id", $id);
            }
        }
        $total = $total->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_user($status = ""){
        $where = 1;
        $arr = [
            0 => ' AND (email_verified_at IS NULL OR email_verified_at = "")',
            1 => ' AND (email_verified_at IS NOT NULL OR email_verified_at != "")',
        ];
        if($status == 2){
        }else{
            if($status !== ""){
                $status_qry = $arr[$status];
                $where .= $status_qry;
            }
        }
        $total = App\User::whereRaw($where)->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_res_kom($status = ""){
        $where = 1;
        if($status !== ""){
            $where .= " AND komplain_status = ".$status;
        }
        $total = App\Models\Komplain::whereRaw($where)->count();
        return $total;
    }

}