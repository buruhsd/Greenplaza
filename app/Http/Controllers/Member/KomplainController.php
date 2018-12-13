<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Komplain;
use App\Models\Komplain_pic;
use App\Models\Komplain_discuss;
use App\Models\Solusi;
use App\Models\Trans_detail;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;


class KomplainController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_komplain';

    /**
    *
    *
    **/
    public function store_komplain(Request $request){
        $status = 200;
        $message = "Komplain has been added.";
        $trans_detail = Trans_detail::where('trans_detail_trans_id', $request->id)
            ->where('trans_detail_status', 5)
            ->where('trans_detail_is_cancel', 0)
            ->get();
        if($trans_detail){
            foreach ($trans_detail as $item) {
                $komplain = new Komplain;
                $komplain->komplain_trans_id = $item->id;;
                $komplain->komplain_komplain_id = $request->komplain_komplain_id;
                $komplain->save();
                if($komplain){
                    // pic bukti komplain
                    $komplain_pic = new Komplain_pic;
                    $komplain_pic->komplain_pic_komplain_id = $komplain->id;
                    // upload
                    if ($request->hasFile('komplain_pic_image')){
                        $file = $request->file('komplain_pic_image');
                        $path = public_path('assets/images/komplain_pic');
                        $field = "";
                        $imagename = FunctionLib::doUpload($file, $path, $field);
                        $komplain_pic->komplain_pic_image = $imagename;
                    }
                    $komplain_pic->save();
                    // solusi
                    $solusi = new Solusi;
                    $solusi->solusi_komplain_id = $komplain->id;
                    $solusi->solusi_solusi_id = $request->solusi_solusi_id;
                    $solusi->solusi_user_id = Auth::id();
                    $solusi->solusi_value = $request->solusi_value;
                    $solusi->save();
                }
            }
            if(!isset($komplain) || empty($komplain) || $komplain == null || $komplain == ""){
                $status = 500;
                $message = "Komplain cannot added.";
            }
        }else{
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
