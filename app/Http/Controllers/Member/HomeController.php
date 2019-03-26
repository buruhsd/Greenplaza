<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use FunctionLib;
use App\Models\Produk;
use App\Models\Review;
use App\Models\Iklan;
use App\Models\Brand;
use App\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 8;
        $data['produk_newest'] = Produk::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();

        //homefriska
        $users = User::with('roles')->where('name','=','admin')->pluck('id')->first();
        // dd($users);
        $relatedproduk = Produk::where('produk_seller_id', $users)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(4)->get();
        $relatedprodukk = Produk::where('produk_seller_id', $users)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(4)->skip(4)->get();
        $product_asdf = Produk::where('produk_seller_id', $users)->where('produk_status', '!=', 2)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(12)->get();
        $category = Produk::where('produk_seller_id', '!=', $users)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $newproduk = Produk::where('produk_seller_id', '!=', $users)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(12)->get();
        $discountprice = Produk::where('produk_discount', '!=', 0)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->inRandomOrder()->get();
        $popularproduk = Produk::orderBy('produk_viewer', 'DESC')->where('produk_status', '!=', 2)->limit(4)->get();
        $popularprodukk = Produk::orderBy('produk_viewer', 'DESC')->where('produk_status', '!=', 2)->limit(4)->skip(4)->get();
        $review = Review::orderBy('created_at', 'DESC')->limit(3)->get();
        $toprate = Produk::orderBy('produk_hotlist', 'DESC')->where('produk_status', '!=', 2)->limit(4)->get();
        $topratee = Produk::orderBy('produk_hotlist', 'DESC')->where('produk_status', '!=', 2)->limit(4)->skip(4)->get();
        $discountproduk = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->where('produk_discount', '>', 0)->limit(4)->get();
        $discountprodukk = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->where('produk_discount', '>', 0)->limit(4)->skip(4)->get();
        $latestnews = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->limit(6)->get();
        $latestnewss = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->limit(6)->skip(6)->get();
        $featured = Produk::where('produk_seller_id', '!=', $users)->where('produk_status', '!=', 2)->orderBy('created_at', 'ASC')->limit(12)->get();
        $banner1 = Iklan::where('iklan_iklan_id', 1)->first();
        $banner2 = Iklan::where('iklan_iklan_id', 2)->first();
        $banner3 = Iklan::where('iklan_iklan_id', 3)->first();
        $banner4 = Iklan::where('iklan_iklan_id', 4)->first();
        $banner5 = Iklan::where('iklan_iklan_id', 5)->first();
        $slider1 = Iklan::where('iklan_iklan_id', 6)->first();
        $slider2 = Iklan::where('iklan_iklan_id', 7)->first();
        $slider3 = Iklan::where('iklan_iklan_id', 8)->first();
        $slider4 = Iklan::where('iklan_iklan_id', 9)->first();
        $slider5 = Iklan::where('iklan_iklan_id', 10)->first();
        $slider6 = Iklan::where('iklan_iklan_id', 11)->first();
        $slider7 = Iklan::where('iklan_iklan_id', 12)->first();
        $brandall = Brand::orderBy('created_at', 'ASC')->get();
        return view('frontend.page.home', 
            compact(
                'data',
                'category', 
                'newproduk', 
                'discountprice', 
                'popularproduk', 
                'review',
                'popularprodukk',
                'toprate',
                'topratee',
                'discountproduk',
                'discountprodukk',
                'latestnews',
                'latestnewss',
                'featured',
                'banner1',
                'banner2',
                'banner3',
                'banner4',
                'banner5',
                'slider1',
                'slider2',
                'slider3',
                'slider4',
                'slider5',
                'slider6',
                'slider7',
                'brandall',
                'users',
                'relatedproduk',
                'relatedprodukk',
                'product_asdf'
            ));
    }
}
