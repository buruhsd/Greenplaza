<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Category;
use FunctionLib;

class FrontController extends Controller
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
    public function home()
    {
        $perPage = 8;
        $data['bestseller'] = Produk::where('produk_is_best', 1)
            ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        $data['hotlist'] = Produk::where('produk_is_hot', 1)
            ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        $data['recomend'] = Produk::skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
        return "Member Bos";exit;
        // return view('home');
    }

    /**
    *
    *
    */
    public function category(Request $request)
    {
        $perPage = 8;
        if($request->input("cat") != ""){
            $id_cat = Category::whereCategory_slug($request->input("cat"))->pluck('id')->first();
            $data['produk'] = FunctionLib::produk_by_category($id_cat)->paginate($perPage);
        }else{
            $data['produk'] = Produk::orderByRaw("rand()")->paginate($perPage);
        }
        return view('frontend.category', $data);
    }

    public function detail(Request $request, $id)
    {
        $detail = Produk::find($id);
        return view('frontend.detail', compact('detail'));
    }

    public function etalase(Request $request, $id)
    {
        $produk = Produk::find($id);
        return view('frontend.etalase', compact('produk'));
    }

    public function reg_seller()
    {

        return view('auth.register_green');
    }

    public function log_seller()
    {

        return view('auth.login_green');
    }

}
 