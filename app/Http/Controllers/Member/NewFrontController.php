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


class NewFrontController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_bank';

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
        return view('frontend.new.detail2', $data);
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
                    <!-- <link href="<?php //echo asset('xtreme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet"> -->
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'create':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
