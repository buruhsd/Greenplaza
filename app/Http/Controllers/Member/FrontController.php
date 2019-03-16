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
use App\Models\Iklan;
use App\User;
use App\Role;
use Auth;
use FunctionLib;
use Illuminate\Support\Facades\DB;

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
    * @param
    * @return
    */
    public function about()
    {
        $where = '1';
        // $where .= '1';
        $data['page'] = Page::whereRaw($where)->get();
        return view('frontend.about', $data);
    }

    /**
    * @param
    * @return
    */
    public function faq ()
    {
        
        return view('frontend.faq');
    }
    public function detail_image_image()
    {
        $id = Auth::user()->id;
        $image = Produk_image::where('produk_image_produk_id', $id)->get();
        echo json_encode($image);
    }
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
        $category = Produk::orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $data['page'] = Page::wherePage_slug($page)->first();
        return view('frontend.page', $data, compact('category'));
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
        $perPage = 12;
        $order = "rand()";
        $id_cat = 0;
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $check = ['populer','ulasan']; 
            $arr = [
                'populer'=>'COUNT(sys_trans_detail.id) ',
                'ulasan'=>'COUNT(sys_review.id)',
            ];
            $order = explode ("-", $request->input("order"));//$request->input("order").' ASC';
            // $order = $order[0].' '.$order[1];
            // $order = (str_contains(strtolower($order_id), 'populer'))
            $order = (in_array($order[0], $check))
                ?$arr[$order[0]].' '.$order[1]
                :$order[0].' '.$order[1];
        }
        $where = "1";
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->input("cat") != ""){
            $id_cat = Category::whereCategory_slug($request->input("cat"))->pluck('id')->first();
            $data['produk'] = Produk::whereRaw('FALSE')->orderByRaw($order)
                    ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                    ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                    // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                    ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))
                    ->groupBy('sys_produk.id')
                ->paginate($perPage);
            if($id_cat !== null){
                $data['produk'] = FunctionLib::produk_by('category', $id_cat, "all", $where, $order)
                        ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                        ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                        // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                        ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))
                        ->groupBy('sys_produk.id')
                    ->paginate($perPage);
            }
        }else{
            $data['produk'] = Produk::whereRaw($where)->orderByRaw($order)
                    ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                    ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                    // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                    ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))
                    ->groupBy('sys_produk.id')
                ->paginate($perPage);
        }
        $category = Produk::orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $data['sub_cat'] = FunctionLib::category_by_parent($id_cat)->orderByRaw('CASE WHEN id='.$id_cat.' THEN category_parent_id END')->limit(25)->get();
        return view('frontend.category', $data, compact('category'));
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
        $data['discuss'] = Produk_discuss::where('produk_discuss_produk_id', $data['detail']['id'])->orderBy('updated_at', 'DESC')->get();
        $data['review'] = Review::where('review_produk_id', $data['detail']['id'])
            ->orderBy('updated_at', 'DESC')
            ->get();
        return view('frontend.new.detail2', $data);
    }
     public function detail_asdf(Request $request, $slug){
        $data['shipment_type'] = Shipment::where('shipment_is_usable', 1)
            ->where('shipment_parent_id', 0)
            ->get();
        $data['detail'] = Produk::where('produk_slug', $slug)->first();
        $data['discuss'] = Produk_discuss::where('produk_discuss_produk_id', $data['detail']['id'])->get();
        $data['review'] = Review::where('review_produk_id', $data['detail']['id'])->get();
        return view('frontend.new.detail2', $data);
    }
     public function product_admin_asdf(Request $request)
    {
        $users = User::with('roles')->where('name','=','admin')->pluck('id')->first();
        $perPage = 12;
        $order = "rand()";
        $id_cat = 0;
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $check = ['populer','ulasan']; 
            $arr = [
                'populer'=>'COUNT(sys_trans_detail.id) ',
                'ulasan'=>'COUNT(sys_review.id)',
            ];
            $order = explode ("-", $request->input("order"));//$request->input("order").' ASC';
            // $order = $order[0].' '.$order[1];
            // $order = (str_contains(strtolower($order_id), 'populer'))
            $order = (in_array($order[0], $check))
                ?$arr[$order[0]].' '.$order[1]
                :$order[0].' '.$order[1];
        }
        $where = "1";
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->input("cat") != ""){
            $id_cat = Category::whereCategory_slug($request->input("cat"))->pluck('id')->first();
            $data['produk'] = Produk::whereRaw('FALSE')->orderByRaw($order)
                    ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                    ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                    // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                    ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))->where('produk_seller_id', $users)
                    ->groupBy('sys_produk.id')
                ->paginate($perPage);
            if($id_cat !== null){
                $data['produk'] = FunctionLib::produk_by('category', $id_cat, "all", $where, $order)
                        ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                        ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                        // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                        ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))->where('produk_seller_id', $users)
                        ->groupBy('sys_produk.id')
                    ->paginate($perPage);
            }
        }else{
            $data['produk'] = Produk::whereRaw($where)->orderByRaw($order)
                    ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
                    ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
                    // ->having(DB::raw('COUNT(sys_trans_detail.id)'), '>', 0)
                    ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'))->where('produk_seller_id', $users)
                    ->groupBy('sys_produk.id')
                ->paginate($perPage);
        }
        $category = Produk::orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $data['sub_cat'] = FunctionLib::category_by_parent($id_cat)->orderByRaw('CASE WHEN id='.$id_cat.' THEN category_parent_id END')->limit(25)->get();
        return view('frontend.asdf_adminProduct', $data, compact('asdf_adminProduct'));
    }

    /**
    * @param
    * @return
    */
    // public function detail(Request $request, $slug)
    // {
    //     $data['shipment_type'] = Shipment::where('shipment_is_usable', 1)
    //         ->where('shipment_parent_id', 0)
    //         ->get();
    //     $data['detail'] = Produk::where('produk_slug', $slug)->first();
    //     $data['discuss'] = Produk_discuss::where('produk_discuss_produk_id', $data['detail']['id'])->get();
    //     $data['review'] = Review::where('review_produk_id', $data['detail']['id'])->get();
    //     $data['side_cat'] = FunctionLib::category_by_parent(0)->limit(6)->get();
    //     $data['side_related'] = FunctionLib::produk_by('category', $data['detail']->category->id)->orderBy('created_at', 'DESC')->limit(5)->get();
    //     return view('frontend.detail', $data);
    // }

    /**
    * @param
    * @return
    */
    public function etalase(Request $request, $user_store)
    {
        $order = "rand()";
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $order = $request->input("order").' ASC';
        }
        $perPage = 8;
        $data['category'] = Produk::orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $user = User::where('user_slug', $user_store)->first();
        // dd($user);
        $data['produk'] = Produk::where('produk_seller_id', $user['id'])->orderByRaw($order)->paginate($perPage);
        $data['user'] = $user;
        // dd($produk);
        return view('frontend.etalase', $data);
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

        return view('member.dashboard.index');
    }


//HOME 
    public function index ()
    {

        $users = User::with('roles')->where('name','=','admin')->pluck('id')->first();
        // dd($users);

        $relatedproduk = Produk::where('produk_seller_id', $users)->orderBy('created_at', 'DESC')->limit(5)->get();
        $relatedprodukk = Produk::where('produk_seller_id', $users)->orderBy('created_at', 'DESC')->limit(4)->skip(4)->get();
        $product_asdf = Produk::where('produk_seller_id', $users)->orderBy('created_at', 'DESC')->limit(12)->get();
        $category = Produk::orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->where('produk_seller_id', '!=', $users)->get();
        $newproduk = Produk::orderBy('created_at', 'DESC')->where('produk_seller_id', '!=', $users)->limit(12)->get();
        $discountprice = Produk::where('produk_discount', '!=', 0)->orderBy('created_at', 'DESC')->inRandomOrder()->get();
        $popularproduk = Produk::orderBy('produk_viewer', 'DESC')->limit(4)->get();
        $popularprodukk = Produk::orderBy('produk_viewer', 'DESC')->limit(4)->skip(4)->get();
        $review = Review::orderBy('created_at', 'DESC')->limit(3)->get();
        $toprate = Produk::orderBy('produk_hotlist', 'DESC')->limit(4)->get();
        $topratee = Produk::orderBy('produk_hotlist', 'DESC')->limit(4)->skip(4)->get();
        $discountproduk = Produk::orderBy('created_at', 'DESC')->where('produk_discount', '>', 0)->limit(4)->get();
        $discountprodukk = Produk::orderBy('created_at', 'DESC')->where('produk_discount', '>', 0)->limit(4)->skip(4)->get();
        $latestnews = Produk::orderBy('created_at', 'DESC')->limit(6)->get();
        $latestnewss = Produk::orderBy('created_at', 'DESC')->limit(6)->skip(6)->get();
        $featured = Produk::orderBy('created_at', 'ASC')->where('produk_seller_id', '!=', $users)->limit(12)->get();
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
        
        // dd($sliderall);
        return view('frontend.page.home', 
            compact(
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


     public function comming()
    {

        return view('comming-soon');
    }

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
 