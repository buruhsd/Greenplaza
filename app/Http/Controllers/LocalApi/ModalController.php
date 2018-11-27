<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;
use App\Models\Trans;
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
    public function transDetail($id)
    {
        $trans = Trans::whereId($id)->first();
        $data['trans_detail'] = $trans->trans_detail;
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
