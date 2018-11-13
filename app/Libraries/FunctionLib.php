<?php
class FunctionLib
{
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
        $value = App\Conf_config::where('configs_status', '=', $status)
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
    public static function add_chart($produk_id){
        $produk = App\Models\Produk::where("id", $produk_id)->first();
        return $return;

    }

}