<?php
class Plugin
{

    /**
    * @param
    * @return
    */
    public static function view($function = 'banner1', $param = []){
        return Plugin::$function($param);
    }

    /**
    * @param
    * @return
    */
    public static function banner1($param=[]){
        return view('frontend.plugin.banner-1', $data);
    }

    /**
    * @param
    * @return
    */
    public static function banner2(){
        return view('frontend.plugin.banner-2');
    }

    /**
    * @param
    * @return
    */
    public static function banner3(){
        return view('frontend.plugin.banner-3');
    }

    /**
    * @param
    * @return
    */
    public static function banner4(){
        return view('frontend.plugin.banner-4');
    }

    /**
    * @param
    * @return
    */
    public static function footer(){
        return view('frontend.plugin.footer');
    }

    /**
    * @param
    * @return
    */
    public static function slider(){
        return view('frontend.plugin.slider');
    }

    /**
    * @param
    * @return
    */
    public static function top_header(){
        return view('frontend.plugin.top-header');
    }

}