<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Produk_image;
use App\Models\Review;
use App\Models\Produk_discuss;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Shipment;
use App\Models\Page;
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
    * @param
    * @return
    */
    public function page(Request $request, $page)
    {
        // if(Auth::guest())
        // {
        //     $data['page'] = Page::where('page_role_id', 0)->where('page_status', 1)
        //         ->wherePage_slug($page)
        //         ->get();
        // }else{
        //     $data['page'] = Page::whereIn('page_role_id', [0, Auth::user()->role])->where('page_status', 1)
        //     // $data['page'] = Auth::user()->role->page()->where('page_status', 1)
        //         ->wherePage_slug($page)
        //         ->get();
        // }
        // $data['side_related'] = FunctionLib::produk_by('category', 'all')->orderBy('created_at', 'DESC')->limit(5)->get();
        $data['page'] = Page::wherePage_slug($page)->first();
        $data['side_cat'] = Category::limit(6)->get();
        $data['side_related'] = Produk::orderByRaw("RAND(), created_at DESC")->limit(5)->get();
        return view('frontend.page', $data);
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
    public function brand(Request $request)
    {
        $perPage = 8;
        if($request->input("brand") !== ""){
            $id_brand = Brand::whereBrand_slug($request->input("brand"))->pluck('id')->first();
            $data['produk'] = Produk::whereRaw('FALSE')->paginate($perPage);
            if($id_brand != null){
                $data['produk'] = FunctionLib::produk_by('brand', $id_brand)->paginate($perPage);
            }
        }else{
            $data['produk'] = Produk::orderByRaw("rand()")->paginate($perPage);
        }
        return view('frontend.brand', $data);
    }

    /**
    * @param
    * @return
    */
    public function category(Request $request)
    {
        $perPage = 8;
        $order = 1;
        $id_cat = 0;
        if($request->input("order") !== ""){
            $order .= $request->input("order").' ASC';
        }
        $where = "1";
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->input("cat") != ""){
            $id_cat = Category::whereCategory_slug($request->input("cat"))->orderByRaw($order)->pluck('id')->first();
            $data['produk'] = Produk::whereRaw('FALSE')->paginate($perPage);
            if($id_cat !== null){
                $data['produk'] = FunctionLib::produk_by('category', $id_cat, "all", $where)->paginate($perPage);
            }
        }else{
            $data['produk'] = Produk::whereRaw($where)->orderByRaw("rand()")->paginate($perPage);
        }
        $data['sub_cat'] = FunctionLib::category_by_parent($id_cat)->get();
        return view('frontend.category', $data);
    }

    /**
    * @param
    * @return
    */
    public function detail(Request $request, $slug)
    {
        $data['shipment_type'] = Shipment::where('shipment_is_usable', 1)
            ->where('shipment_parent_id', 0)
            ->get();
        $data['detail'] = Produk::where('produk_slug', $slug)->first();
        $data['discuss'] = Produk_discuss::where('produk_discuss_produk_id', $data['detail']['id'])->get();
        $data['review'] = Review::where('review_produk_id', $data['detail']['id'])->get();
        $data['side_cat'] = FunctionLib::category_by_parent(0)->limit(6)->get();
        $data['side_related'] = FunctionLib::produk_by('category', $data['detail']->category->id)->orderBy('created_at', 'DESC')->limit(5)->get();
        return view('frontend.detail', $data);
    }

    /**
    * @param
    * @return
    */
    public function etalase(Request $request, $id)
    {
        $user = User::find($id);
        $produk = Produk::where('produk_seller_id', $user->id)->get();
        // dd($produk);
        return view('frontend.etalase', compact('produk', 'user', 'user_produk'));
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

     public function dashboard()
    {

        return view('member.log.log_saldo_iklan');
    }

    //  public function about()
    // {

    //     return view('frontend.about');
    // }

    //  public function ketentuan()
    // {

    //     return view('frontend.ketentuan');
    // }

    //  public function carabayar()
    // {

    //     return view('frontend.pembayaran');
    // }

    //  public function aturan()
    // {

    //     return view('frontend.aturan');
    // }

    //  public function syarat()
    // {

    //     return view('frontend.syarat');
    // }

    //  public function alurtransaksi()
    // {

    //     return view('frontend.alur-transaksi');
    // }

    //  public function carabelanja()
    // {

    //     return view('frontend.cara-belanja');
    // }

    // /**
    // * @param
    // * @return
    // */
    // public function brand($slug)
    // {
    //     $detail = Produk::where('produk_seller_id', Auth::id())->first();
    //     return view('frontend.detail', compact('detail'));
    // }
}
 