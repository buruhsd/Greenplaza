<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;
use App\Models\User_bank;
use App\Models\Bank;
use App\Models\Trans;
use App\Models\Conf_komplain;
use App\Models\Conf_solusi;
use App\Models\Trans_detail;
use App\Models\Komplain;
use App\Models\Produk;
use App\Models\Shipment;
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
        // $this->middleware('auth');
    }

    /**
     * komplain tambah resi buyer
     * @param
     * @return 
     */
    public function komplain_resi_buyer($id)
    {
        $data['item'] = Komplain::whereId($id)->first();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.komplain.add_shipment_buyer', $data);
    }

    /**
     * komplain tambah resi seller
     * @param
     * @return 
     */
    public function komplain_resi_seller($id)
    {
        $data['item'] = Komplain::whereId($id)->first();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.komplain.add_shipment_seller', $data);
    }

    /**
     * tambah bank user
     * @param
     * @return 
     */
    public function addBank()
    {
        $data['cfg_bank'] = Bank::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.bank-form', $data);
    }

    /**
     * edit bank user
     * @param
     * @return 
     */
    public function editBank($id=0)
    {
        $data['cfg_bank'] = Bank::all();
        $data['user_bank'] = User_bank::where('user_bank_user_id', Auth::id())->first();
        if(!empty($id) && $id !== 0){
            $where = '1';
            $where .= ' AND user_bank_user_id='.Auth::id();
            $where .= ' AND id='.$id;
            $data['user_bank'] = User_bank::whereRaw($where)->first();
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.bank-form-edit', $data);
    }

    /**
     * add to chart form
     * @param
     * @return 
     */
    public function add_to_chart(Request $request, $id)
    {
        $data['shipment_type'] = Shipment::where('shipment_is_usable', 1)
            ->where('shipment_parent_id', 0)
            ->get();
        $data['detail'] = Produk::whereId($id)->first();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.add-to-chart', $data);
    }

    /**
     * pemanggil admin transaksi
     * @param
     * @return 
     */
    public function trans_pickProdukShip(Request $request, $id)
    {
        $data['trans_status'] = $request->status;
        $where = "trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")";
        $where .= " AND trans_detail_is_cancel != 1";
        $data['trans_detail'] = Trans_detail::where('trans_detail_trans_id', $id)
            ->whereRaw($where)
            ->get();
        $data['status'] = 'seller';
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.pick-produk-ship', $data);
    }

    /**
     * member membuat komplain ketika barang sampai
     * @param id sys_komplain
     * @return 
     */
    public function update_komplain(Request $request, $id)
    {
        $type = 'seller';
        $data['type'] = ($request->has('type'))?$request->type:$type;
        $data['komplain'] = Komplain::whereId($id)->first();
        $data['solusi_type'] = Conf_solusi::where('solusi_status', 1)
            ->whereRaw('solusi_komplain_id LIKE "'.$id.',%"')
            ->orWhereRaw('solusi_komplain_id LIKE "%,'.$id.'"')
            ->orWhereRaw('solusi_komplain_id = "'.$id.'"')->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.update-komplain', $data);
    }

    /**
     * member membuat komplain ketika barang sampai
     * @param id sys_trans
     * @return 
     */
    public function add_komplain($id)
    {
        $data['trans'] = Trans::whereId($id)->first();
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
        if(Auth::guest()){
            return view('localapi.login');
        }
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
     * 
     * @param
     * @return 
     */
    public function editAddress($id=0)
    {
        $data['user_address'] = User_address::where('user_address_user_id', Auth::id())->first();
        if(!empty($id) && $id !== 0){
            $where = '1';
            $where .= ' AND user_address_user_id='.Auth::id();
            $where .= ' AND id='.$id;
            $data['user_address'] = User_address::whereRaw($where)->first();
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.address-form-edit', $data);
    }

    /**
     * pemanggil admin transaksi
     * @param
     * @return 
     */
    public function transDetail(Request $request, $id)
    {
        if($request->has('type') && $request->type == 'seller' && $request->has('trans_status')){
            $where = "trans_detail_produk_id IN (SELECT id FROM sys_produk where produk_seller_id=".Auth::id().")";
            if($request->trans_status == 'cancel' || $request->trans_status == 'komplain'){
                $where .= " AND trans_detail_is_cancel = 1";
            }else{
                $where .= " AND trans_detail_is_cancel != 1";
            }
            $data['trans_detail'] = Trans_detail::where('trans_detail_trans_id', $id)
                ->whereRaw($where)
                ->get();
            $data['type'] = 'seller';
        }elseif($request->has('type') && $request->type == 'buyer' && $request->has('trans_status')){
            $where = "1";
            if($request->trans_status == 'cancel' || $request->trans_status == 'komplain'){
                $where .= " AND trans_detail_is_cancel = 1";
            }else{
                $where .= " AND trans_detail_is_cancel != 1";
            }
            $trans = Trans::whereId($id)->first();
            $data['trans_detail'] = $trans->trans_detail()->whereRaw($where)->get();
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
    public function res_kom_transDetail(Request $request, $id)
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
