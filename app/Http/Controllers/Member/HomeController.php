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
use Ixudra\Curl\CurlService;


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
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $myr = $kurs['Data']['MYR']['Jual'];
        $perPage = 8;
        $data['produk_newest'] = Produk::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();

        //homefriska
        $data['users'] = User::with('roles')->where('name','=','admin')->pluck('id')->first();
        // dd($users);
        $data['category'] = Produk::where('produk_seller_id', '!=', $data['users'])->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->where('produk_category_id', '!=', null)->get();
        $data['review'] = Review::orderBy('created_at', 'DESC')->limit(3)->get();
        // $data['relatedproduk'] = Produk::where('produk_seller_id', $data['users'])->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(4)->get();
        // $data['relatedprodukk'] = Produk::where('produk_seller_id', $data['users'])->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(4)->skip(4)->get();
        // $data['product_asdf'] = Produk::where('produk_seller_id', $data['users'])->where('produk_status', '!=', 2)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(12)->get();
        // $data['newproduk'] = Produk::where('produk_seller_id', '!=', $data['users'])->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->limit(12)->get();
        // $data['discountprice'] = Produk::where('produk_discount', '!=', 0)->where('produk_status', '!=', 2)->orderBy('created_at', 'DESC')->inRandomOrder()->get();
        // $data['popularproduk'] = Produk::orderBy('produk_viewer', 'DESC')->where('produk_status', '!=', 2)->limit(4)->get();
        // $data['popularprodukk'] = Produk::orderBy('produk_viewer', 'DESC')->where('produk_status', '!=', 2)->limit(4)->skip(4)->get();
        // $data['toprate'] = Produk::orderBy('produk_hotlist', 'DESC')->where('produk_status', '!=', 2)->limit(4)->get();
        // $data['topratee'] = Produk::orderBy('produk_hotlist', 'DESC')->where('produk_status', '!=', 2)->limit(4)->skip(4)->get();
        // $data['discountproduk'] = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->where('produk_discount', '>', 0)->limit(4)->get();
        // $data['discountprodukk'] = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->where('produk_discount', '>', 0)->limit(4)->skip(4)->get();
        // $data['latestnews'] = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->limit(6)->get();
        // $data['latestnewss'] = Produk::orderBy('created_at', 'DESC')->where('produk_status', '!=', 2)->limit(6)->skip(6)->get();
        // $data['featured'] = Produk::where('produk_seller_id', '!=', $data['users'])->where('produk_status', '!=', 2)->orderBy('created_at', 'ASC')->limit(12)->get();
        // $data['banner1'] = Iklan::where('iklan_iklan_id', 1)->first();
        // $data['banner2'] = Iklan::where('iklan_iklan_id', 2)->first();
        // $data['banner3'] = Iklan::where('iklan_iklan_id', 3)->first();
        // $data['banner4'] = Iklan::where('iklan_iklan_id', 4)->first();
        // $data['banner5'] = Iklan::where('iklan_iklan_id', 5)->first();
        // $data['slider1'] = Iklan::where('iklan_iklan_id', 6)->first();
        // $data['slider2'] = Iklan::where('iklan_iklan_id', 7)->first();
        // $data['slider3'] = Iklan::where('iklan_iklan_id', 8)->first();
        // $data['slider4'] = Iklan::where('iklan_iklan_id', 9)->first();
        // $data['slider5'] = Iklan::where('iklan_iklan_id', 10)->first();
        // $data['slider6'] = Iklan::where('iklan_iklan_id', 11)->first();
        // $data['slider7'] = Iklan::where('iklan_iklan_id', 12)->first();
        // $data['brandall'] = Brand::orderBy('created_at', 'ASC')->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        $data['categoryheader'] = Category::orderBy('created_at', 'DESC')->where('category_status', '=', 1)->limit(7)->get();
        return view('frontend.page.home', $data);
    }


    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function footer_script($method=''){
        ob_start();
        ?>
            <script type="text/javascript"></script>
        <?php
        switch ($method) {
            case 'index':
                ?>
                    <script type="text/javascript">
                        //this function will work cross-browser for loading scripts asynchronously
                        async function loadComponent(src, id, callback)
                        {
                            var s, r, t;
                            r = false;
                            s = $('#'+id).load(src);
                            s.onload = s.onreadystatechange = function() {
                                console.log( this.readyState ); //uncomment this line to see which ready states are called.
                                if ( !r && (!this.readyState || this.readyState == 'complete') )
                                {
                                    r = true;
                                    callback();
                                }
                            };
                            // t = document.getElementsByTagName('script')[0];
                            // t.parentNode.insertBefore(s, t);
                        }
                        // var tes = loadComponent("<?php route('localapi.masedi.payment');?>", 'a');
                        // console.log(tes);
                    </script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
