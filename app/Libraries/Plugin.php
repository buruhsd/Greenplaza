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
        extract($param);
        return view('frontend.plugin.banner-1');
    }

    /**
    * @param
    * @return
    */
    public static function banner2($param=[]){
        extract($param);
        return view('frontend.plugin.banner-2');
    }

    /**
    * @param
    * @return
    */
    public static function banner3($param=[]){
        extract($param);
        return view('frontend.plugin.banner-3');
    }

    /**
    * @param
    * @return
    */
    public static function banner4($param=[]){
        extract($param);
        return view('frontend.plugin.banner-4');
    }

    /**
    * @param
    * @return
    */
    public static function footer($param=[]){
        extract($param);
        FunctionLib::get_config("address1");
        return view('frontend.plugin.footer');
    }

    /**
    * @param
    * @return
    */
    public static function slider($param=[]){
        extract($param);
        return view('frontend.plugin.slider');
    }

    /**
    * @param
    * @return
    */
    public static function top_header($param=[]){
        $pid = 0;
        extract($param);
        // $where[] = ['category_parent_id', $pid];
        $data['p_category'] = App\Models\Category::all();
        return view('frontend.plugin.top-header', $data);
    }

}