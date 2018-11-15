<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Category;
use App\Models\Shipment;
use App\User;
use Auth;
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
    * @param
    * @return
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

    /**
    * @param
    * @return
    */
    public function detail(Request $request, $id)
    {
        $data['shipment_type'] = Shipment::where('shipment_is_usable', 1)
            ->where('shipment_parent_id', 0)
            ->get();
        $data['detail'] = Produk::where('produk_seller_id', Auth::id())->first();
        return view('frontend.detail', $data);
    }

    /**
    * @param
    * @return
    */
    public function etalase(Request $request, $id)
    {
        $produk = Produk::find($id);
        return view('frontend.etalase', compact('produk'));
    }

    /**
    * @param
    * @return
    */
    public function reg_seller()
    {

        return view('auth.register_green');
    }

    /**
    * @param
    * @return
    */
    public function log_seller()
    {

        return view('auth.login_green');
    }

    /**
    * @param
    * @return
    */
    public function brand($slug)
    {
        $detail = Produk::where('produk_seller_id', Auth::id())->first();
        return view('frontend.detail', compact('detail'));
    }

    public function admin(){
        return view('admin.dashboard.dashboard');

    }

}
 