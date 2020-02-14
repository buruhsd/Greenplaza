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
    * @return produk by viewer terbanyak
    */
    public static function p_populer($param = []){
        extract($param);
        $data['p_populer'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(16)
            ->get();
        return view('frontend.plugin.home.p_populer', $data)->render();
    }

    /**
    * @param
    * @return produk by viewer terbanyak
    */
    public static function p_populer_saat_ini($param = []){
        extract($param);
        $data['p_populer_saat_ini'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(7)
            ->get();
        $data['p_populer_saat_ini2'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(7)
            ->skip(7)
            ->get();
        return view('frontend.plugin.home.p_populer_saat_ini', $data)->render();
    }

    /**
    * @param
    * @return produk by viewer terbanyak
    */
    public static function p_populer_saat_ini2($param = []){
        extract($param);
        $data['p_populer_saat_ini2'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(4)
            ->get();
        $data['p_populer_saat_ini22'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_populer_saat_ini2', $data)->render();
    }

    /**
    * @param
    * @return produk by viewer terbanyak
    */
    public static function p_populer_saat_ini3($param = []){
        extract($param);
        $data['p_populer_saat_ini3'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(4)
            ->get();
        $data['p_populer_saat_ini32'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_viewer', 'DESC')
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_populer_saat_ini3', $data)->render();
    }

    /**
    * @param
    * @return produk green
    */
    public static function p_green($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_green'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_seller_id', 2)
            ->orderBy('updated_at', 'DESC')
            ->limit(8)
            ->get();
        return view('frontend.plugin.home.p_green', $data);
    }

    /**
    * @param
    * @return produk by updated_at
    */
    public static function p_baru_saat_ini($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_baru_saat_ini'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('updated_at', 'DESC')
            ->limit(8)
            ->get();
        return view('frontend.plugin.home.p_baru_saat_ini', $data)->render();
    }

    /**
    * @param
    * @return produk dengan harga diskon
    */
    public static function p_harga_diskon($param = []){
        extract($param);
        // $kurs = json_decode(FunctionLib::cekKurs(), true);
        // $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_harga_diskon'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_discount', '>', 0)
            ->orderBy('updated_at', 'DESC')
            ->limit(8)
            ->get();
        return view('frontend.plugin.home.p_harga_diskon', $data)->render();
    }

    /**
    * @param
    * @return produk by created_at
    */
    public static function p_baru($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        // $data['users'] = User::with('roles')->where('name','=','member')->pluck('id')->get();
        $data['p_baru'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_discount', '=', 0)
            ->limit(8)
            ->orderBy('created_at', 'DESC')->get();
        $data['p_baru_diskon'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_discount', '>', 0)
            ->limit(8)
            ->orderBy('created_at', 'DESC')->get();
        return view('frontend.plugin.home.p_baru', $data)->render();
    }

    /**
    * @param
    * @return produk by total transaksi detail
    */
    public static function p_pilihan_saat_ini($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_pilihan_saat_ini'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->orderBy('trans_detail_count', 'desc')
            ->limit(8)
            ->get();
        return view('frontend.plugin.home.p_pilihan_saat_ini', $data)->render();
    }

    /**
    * @param
    * @return  produk by total transaksi detail
    */
    public static function p_trending($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_trending'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->orderBy('trans_detail_count', 'desc')
            ->limit(4)
            ->get();
        $data['p_trending2'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->orderBy('trans_detail_count', 'desc')
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_trending', $data)->render();
    }

    /**
    * @param
    * @return produk by bintang terbanyak
    */
    public static function p_top_rate($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $order = 'DESC';
        $data['p_top_rate'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->whereHas('review')
            ->with('review')
            ->with(['avg_star_field' => function ($q) use ($order) {
                    $q->orderBy('average_rating', $order);
                }])
            ->limit(4)
            ->get();
        $data['p_top_rate2'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->whereHas('review')
            ->with('review')
            ->with(['avg_star_field' => function ($q) use ($order) {
                    $q->orderBy('average_rating', $order);
                }])
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_top_rate', $data)->render();
    }

    /**
    * @param
    * @return
    */
    public static function p_hot($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $data['p_hot'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_is_hot', 'DESC')
            ->orderBy('produk_hotlist', 'DESC')
            ->limit(4)
            ->get();
        $data['p_hot2'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->orderBy('produk_is_hot', 'DESC')
            ->orderBy('produk_hotlist', 'DESC')
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_hot', $data)->render();
    }

    /**
    * @param
    * @return
    */
    public static function p_diskon($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        // $data['users'] = User::with('roles')->where('name','=','member')->pluck('id')->get();
        $data['p_diskon'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_discount', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();
        $data['p_diskon2'] = App\Models\Produk::where('produk_status', '!=', 2)
            ->where('produk_discount', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->skip(4)
            ->get();
        return view('frontend.plugin.home.p_diskon', $data)->render();
    }

    /**
    * @param
    * @return
    */
    public static function p_populer_konsumen($param = []){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $order = 'DESC';
        $data['p_populer_konsumen'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
            ->whereHas('review')
            ->with('review')
            ->with(['avg_star_field' => function ($q) use ($order) {
                    $q->orderBy('average_rating', $order);
                }])
            ->limit(12)
            ->get();
        // $data['p_populer_konsumen2'] = App\Models\Produk::where('produk_status', '!=', 2)->withCount('trans_detail')
        //     ->whereHas('review')
        //     ->with('review')
        //     ->with(['avg_star_field' => function ($q) use ($order) {
        //             $q->orderBy('average_rating', $order);
        //         }])
        //     ->limit(6)
        //     ->skip(6)
        //     ->get();
        return view('frontend.plugin.home.p_populer_konsumen', $data)->render();
    }

    /**
    * untuk category terkait dan produk terkait (ada di kiri seperti di detail produk front)
    * @param 
    * optional category_id
    * @return view
    */
    public static function side_left($param=[]){
        extract($param);
        $kurs = json_decode(FunctionLib::cekKurs(), true);
        $data['myr'] = $kurs['Data']['MYR']['Beli'];
        $id = (isset($id))?$id:0;
        $data['side_cat'] = FunctionLib::category_by_parent($id)->limit(6)->get();
        $data['side_related'] = FunctionLib::produk_by('category', $id)->orderBy('created_at', 'DESC')->limit(5)->get();
        return view('frontend.plugin.side-left', $data);
    }


    /**
    * untuk menampilkan iklan front
    * @param conf_iklan id, conf_iklan iklan_type, conf_iklan iklan_name
    * optional 
    * @return view
    */
        /*
        * iklan type
        * 1 = banner, 2 = slider, 3 = baris
        */
    public static function iklan($param=[]){
        // slider punya 1 - (>1) slider
        // banner punya fixed 11
        // baris belum ada
        $date = date('Y-m-d H-i-s');
        $arr_view=[
            'baris'=>'frontend.plugin.iklan-baris',
            'slider'=>'frontend.plugin.iklan-slider',
            'banner1'=>'frontend.plugin.iklan-banner-1',
            'banner2'=>'frontend.plugin.iklan-banner-2',
            'banner3'=>'frontend.plugin.iklan-banner-3',
            'banner4'=>'frontend.plugin.iklan-banner-4',
            'banner5'=>'frontend.plugin.iklan-banner-5',
            'banner6'=>'frontend.plugin.iklan-banner-6',
            'banner7'=>'frontend.plugin.iklan-banner-7',
            'banner8'=>'frontend.plugin.iklan-banner-8',
            'banner9'=>'frontend.plugin.iklan-banner-9',
            'banner10'=>'frontend.plugin.iklan-banner-10',
            'banner11'=>'frontend.plugin.iklan-banner-11',
        ];
        extract($param);
        $view = $arr_view[$name];
        $where = 'id = '.$id;
        $where = 'iklan_type = '.$type;
        $where = 'iklan_name = '.$name;
        $config = App\Models\Conf_iklan::where('id', $id)->first();
        if($type != 1){
            $where = 'iklan_status = 1';
            $where .= ' AND '.$date.' >= iklan_use AND '.$date.' <= iklan_done';
            $data['iklan'] = $config->iklan()->where('iklan_iklan_id', $config->id)->get();
        }else{
            $where = 'iklan_status = 1';
            $where .= ' AND '.$date.' >= iklan_use AND '.$date.' <= iklan_done';
            $data['iklan'] = $config->iklan()->where('iklan_iklan_id', $config->id)->first();
        }
        return view($view, $data);
    }

    // /**
    // * @param
    // * @return
    // */
    // public static function banner1($param=[]){
    //     extract($param);
    //     return view('frontend.plugin.banner-1');
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function banner2($param=[]){
    //     extract($param);
    //     return view('frontend.plugin.banner-2');
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function banner3($param=[]){
    //     extract($param);
    //     return view('frontend.plugin.banner-3');
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function banner4($param=[]){
    //     extract($param);
    //     return view('frontend.plugin.banner-4');
    // }

    /**
    * halaman footer frontend
    * @param
    * @return
    */
    public static function footer($param=[]){
        extract($param);
        return view('frontend.plugin.footer');
    }

    // /**
    // * @param
    // * @return
    // */
    // public static function slider($param=[]){
    //     extract($param);
    //     return view('frontend.plugin.slider');
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function top_header($param=[]){
    //     $pid = 0;
    //     extract($param);
    //     // $where[] = ['category_parent_id', $pid];
    //     $data['p_category'] = App\Models\Category::all();
    //     return view('frontend.plugin.top-header', $data);
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function hot_promo($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['hot_promo'] = App\Models\Produk::where('produk_is_hot', !1)//1)
    //         ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
    //     return view('frontend.plugin.hot-promo', $data);
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function populer($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['populer'] = App\Models\Produk::where('produk_is_hot', !1)//1)
    //         ->skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
    //     return view('frontend.plugin.popular', $data);
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function recommended($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['recomend'] = App\Models\Produk::skip(0)->take($perPage)->orderBy('id', 'DESC')->get();
    //     return view('frontend.plugin.recommended-items', $data);
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function produk_newest($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['produk_newest'] = App\Models\Produk::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();
    //     return view('frontend.content.content-1', $data);
    // }
    
    // /**
    // * @param
    // * @return
    // */
    // public static function content_brand($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['brand'] = App\Models\Brand::skip(0)->take($perPage)->orderBy('created_at', 'DESC')->get();
    //     return view('frontend.content.content-brand', $data);
    // }

    // /**
    // * @param
    // * @return
    // */
    // public static function category($param=[]){
    //     $pid = 0;
    //     $perPage = 8;
    //     extract($param);
    //     $data['category'] = App\Models\Category::where('category_parent_id', 0)->get();
    //     return view('frontend.plugin.category', $data);
    // }

    /**
    * @param $id $type=buyer/seller, $status=trans/detail
    * @return
    */
    public static function trans_purchase_btn($param=[]){
        // default
        $type = 'buyer';
        $status = 'trans';
        // extraxt variabel @param
        extract($param);
        $data['type'] = $type;
        $data['status'] = $status;
        $where = '1';
        if(isset($trans_status)){
            $where .= ($trans_status == 'cancel' || $trans_status == 'komplain')?" AND trans_detail_is_cancel = 1":" AND trans_detail_is_cancel != 1";
        }
        if($status !== 'detail'){
            $data['detail'] = App\Models\Trans_detail::where('trans_detail_trans_id', $id)->whereRaw($where)->orderBy('trans_detail_status')->first();
        }else{
            // $data['detail'] = App\Models\Trans_detail::whereId($id)->first();
            $data['detail'] = App\Models\Trans_detail::where('trans_detail_trans_id', $id)->whereRaw($where)->first();
        }
        $data['status_shipment'] = FunctionLib::get_waybill($data['detail']->id);
        return view('member.plugin.trans_purchase_btn', $data);
    }

    public static function trans_purchase_btn_admin($param=[]){
        // default
        $type = 'buyer';
        $status = 'trans';
        // extraxt variabel @param
        extract($param);
        $data['type'] = $type;
        $data['status'] = $status;
        $where = '1';
        if(isset($trans_status)){
            $where .= ($trans_status == 'cancel' || $trans_status == 'komplain')?" AND trans_detail_is_cancel = 1":" AND trans_detail_is_cancel != 1";
        }
        if($status !== 'detail'){
            $data['detail'] = App\Models\Trans_detail::where('trans_detail_trans_id', $id)->whereRaw($where)->orderBy('trans_detail_status')->first();
        }else{
            // $data['detail'] = App\Models\Trans_detail::whereId($id)->first();
            $data['detail'] = App\Models\Trans_detail::where('trans_detail_trans_id', $id)->whereRaw($where)->first();
        }
        $data['status_shipment'] = FunctionLib::get_waybill($data['detail']->id);
        return view('admin.plugin.trans_purchase_btn', $data);
    }

    public static function category2($param=[]){
        $pid = 0;
        $perPage = 8;
        extract($param);
        $data['category'] = App\Models\Category::where('category_parent_id', 0)->get();
        return view('frontend.plugin.category-home', $data);
    }

}