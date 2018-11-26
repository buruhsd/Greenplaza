<?php
class FunctionLib
{
    /**
    * @param
    * @return
    **/
    public static function config_arr($type="profil") {
        switch ($type) {
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
        $province = RajaOngkir::city($data);
        $province = json_decode($province, true);
        $province = $province['rajaongkir']['results'];
        return $province;
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
        $province = RajaOngkir::subdistrict($data);
        $province = json_decode($province, true);
        $province = $province['rajaongkir']['results'];
        return $province;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk($status = ""){
        $where = 1;
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where)->count();
        return $total;
    }

    /**
    * @param
    * @return
    **/
    public static function count_produk_hot($status = ""){
        $where = 1;
        $where .= " AND produk_is_hot = 1";
        if($status !== ""){
            $where .= " AND produk_status = ".$status;
        }
        $total = App\Models\Produk::whereRaw($where)->count();
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
    * @param
    * @return
    **/
    public static function count_trans($status = ""){
        $where = 1;
        if($status !== ""){
            $where .= " AND trans_detail_status = ".$status;
        }
        $total = App\Models\Trans_detail::whereRaw($where)->count();
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