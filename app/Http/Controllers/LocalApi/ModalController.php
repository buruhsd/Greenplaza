<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;
use App\Models\Trans;
use App\Models\Conf_komplain;
use App\Models\Conf_solusi;
use App\Models\Trans_detail;
use FunctionLib;
use Auth;

class ModalController extends Controller
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
     * pemanggil admin transaksi
     * @param
     * @return 
     */
    public function trans_pickProdukShip(Request $request, $id)
    {
        $data['trans_status'] = $request->status;
        $data['trans_detail'] = Trans_detail::where('trans_detail_trans_id', $id)
            ->whereRaw("trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")")
            ->get();
        $data['status'] = 'seller';
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.pick-produk-ship', $data);
    }

    /**
     * member membuat komplain ketika barang sampai
     * @param
     * @return 
     */
    public function add_komplain($id)
    {
        $data['id'] = $id;
        $data['komplain'] = Conf_komplain::where('komplain_status', 1)->get();
        $data['solusi'] = Conf_solusi::where('solusi_status', 1)->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.komplain-form', $data);
    }

    /**
     * pemanggil admin transaksi
     * @param
     * @return 
     */
    public function formConfig()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.form-config', $data);
    }

    /**
     * 
     * @param
     * @return 
     */
    public function addWishlist($id)
    {
        $data['id'] = $id;
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.wishlist-note', $data);
    }

    /**
     * 
     * @param
     * @return 
     */
    public function pickAddress(Request $request)
    {
        $data['user_address'] = User_address::all();
        if(!empty($request->id) && $request->id !== 0){
            $data['user_address'] = User_address::where('user_address_user_id', Auth::id())->get();
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.pick-address', $data);
    }

    /**
     * 
     * @param
     * @return 
     */
    public function addAddress()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.address-form', $data);
    }

    /**
     * pemanggil admin transaksi
     * @param
     * @return 
     */
    public function transDetail(Request $request, $id)
    {
        if($request->has('type') && $request->type == 'seller'){
            $data['trans_detail'] = Trans_detail::where('trans_detail_trans_id', $id)
                ->whereRaw("trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")")
                ->get();
            $data['type'] = 'seller';
        }elseif($request->has('type') && $request->type == 'buyer'){
            $trans = Trans::whereId($id)->first();
            $data['trans_detail'] = $trans->trans_detail;
            $data['type'] = 'buyer';
        }else{
            $trans = Trans::whereId($id)->first();
            $data['trans_detail'] = $trans->trans_detail;
            $data['type'] = 'all';
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.trans-detail', $data);
    }

    /**
     * pemanggil admin res kom
     * @param
     * @return 
     */
    public function res_kom_transDetail($id)
    {
        $data['trans_detail'] = Trans_detail::whereId($id)->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.trans-detail', $data);
    }

    /**
     * 
     * @param
     * @return 
     */
    public function modal($id)
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.modal', $data);
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
            case 'modal':
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
