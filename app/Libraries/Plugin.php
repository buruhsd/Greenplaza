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

    /**
    * @param
    * @return
    */
    public static function hot_promo($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['hot_promo'] = App\Models\Produk::where('produk_is_hot', !1)//1)
            ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        return view('frontend.plugin.hot-promo', $data);
    }

    /**
    * @param
    * @return
    */
    public static function populer($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['populer'] = App\Models\Produk::where('produk_is_hot', !1)//1)
            ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        return view('frontend.plugin.popular', $data);
    }

    /**
    * @param
    * @return
    */
    public static function recommended($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['recomend'] = App\Models\Produk::skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        return view('frontend.plugin.recommended-items', $data);
    }

    /**
    * @param
    * @return
    */
    public static function produk_newest($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['produk_newest'] = App\Models\Produk::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();
        return view('frontend.content.content-1', $data);
    }
    
    /**
    * @param
    * @return
    */
    public static function content_brand($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['brand'] = App\Models\Brand::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();
        return view('frontend.content.content-brand', $data);
    }

    /**
    * @param
    * @return
    */
    public static function category($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['category'] = App\Models\Category::where('category_parent_id', 0)->get();
        return view('frontend.plugin.category', $data);
    }

}