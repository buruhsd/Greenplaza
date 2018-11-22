<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;
use App\Models\Trans;
use FunctionLib;

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
    public function pickAddress()
    {
        $data['user_address'] = User_address::all();
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
        $data['trans'] = Trans::whereId($id)->first();
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
