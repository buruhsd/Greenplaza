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

}