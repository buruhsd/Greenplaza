<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Plugin;

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
    * @param method $method
    * @return add main footer script / in spesific method
    */
}
