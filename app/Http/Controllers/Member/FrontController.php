<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Category;

class FrontController extends Controller
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
    public function home()
    {
        return "Member Bos";exit;
        // return view('home');
    }

    /**
    *
    *
    */
    public function category()
    {
        $data['category'] = Category::skip(0)->take(10)->get();
        $data['produk'] = Produk::skip(0)->take(10)->get();
        $data['bestseller'] = Produk::where('produk_is_best', 1)
            ->skip(0)->take(10)->orderBy('id', 'DESC')->get();
        $data['hotlist'] = Produk::where('produk_is_hot', 1)
            ->skip(0)->take(10)->orderBy('id', 'DESC')->get();
        $data['recomend'] = Produk::skip(0)->take(10)->orderBy('id', 'DESC')->get();
        return view('frontend.category', $data);
    }

    public function detail()
    {

        return view('frontend.detail');
    }

    public function etalase()
    {

        return view('frontend.shop');
    }

    public function reg_seller()
    {

        return view('auth.register_green');
    }
}
