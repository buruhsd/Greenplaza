<?php

namespace App\Http\Controllers\LocalApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function modal($id)
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('partial.modal', $data);
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
