<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_address;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addWishlist($id)
    {
        $data['id'] = $id;
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.wishlist-note', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pickAddress()
    {
        $data['user_address'] = User_address::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.pick-address', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAddress()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('localapi.address-form', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
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
