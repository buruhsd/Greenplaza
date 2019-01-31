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
    * #buyer
    * @param $request, $id solusi
    * @return
    **/
    public function done_komplain(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $komplain = Komplain::findOrFail($id);
            $komplain->komplain_status = 3;
            $komplain->save();
            if($komplain){
                $solusi = $komplain->solusi;
                $solusi->solusi_status = 3;
                $solusi->save();
            }
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #buyer
    * @param
    * @return
    **/
    public function buyer(Request $request)
    {
        $arr = [
            "1" =>'new',
            "2" =>'help',
            "3" =>'done',
            "1,2,3" =>'',
        ];
        $where = "1";
        if(!empty($request->get('komplain'))){
            $komplain = $request->get('komplain');
            $where .= ' AND conf_komplain.komplain_name LIKE "%'.$komplain.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND sys_komplain.komplain_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['komplain'] = Komplain::whereRaw($where)
                ->leftJoin('conf_komplain', 'sys_komplain.komplain_komplain_id', '=', 'conf_komplain.id')
                ->select('sys_komplain.*', 'conf_komplain.komplain_name')
                ->groupBy('sys_komplain.id')
                ->whereHas('trans_detail', function ($query) {
                    $query->whereHas('trans', function ($query2) {
                        $query2->where('trans_user_id', '=', Auth::id());
                    });
                })
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::whereHas('trans_detail', function ($query) {
                    $query->whereHas('trans', function ($query2) {
                        $query2->where('trans_user_id', '=', Auth::id());
                    });
                })
                ->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.resolusi_komplain.buyer', $data);
    }

    /**
    * #seller
    * @param 
    * @return
    **/
    public function index(Request $request)
    {
        $arr = [
            "1" =>'new',
            "2" =>'help',
            "3" =>'done',
            "1,2,3" =>'',
        ];
        $where = "1";
        if(!empty($request->get('komplain'))){
            $komplain = $request->get('komplain');
            $where .= ' AND conf_komplain.komplain_name LIKE "%'.$komplain.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND sys_komplain.komplain_status IN ('.$status.')';
        }

        if (!empty($where)) {
            $data['komplain'] = Komplain::whereRaw($where)
                ->leftJoin('conf_komplain', 'sys_komplain.komplain_komplain_id', '=', 'conf_komplain.id')
                ->select('sys_komplain.*', 'conf_komplain.komplain_name')
                ->groupBy('sys_komplain.id')
                ->whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                    });
                })
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                    });
                })
                ->paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.resolusi_komplain.index', $data);
    }

    /**
    * #buyer
    * @param id sys_komplain
    * @return
    **/
    public function update_komplain(Request $request, $id){
        $status = 200;
        $message = "Komplain has been updated.";
        // $komplain = Komplain::whereId($id)
        //     ->get();
            // ->where('trans_detail_status', 5)
            // ->where('trans_detail_is_cancel', 0)
        try{            
            $komplain = Komplain::findOrFail($id);
            if($komplain){
                // pic bukti komplain
                $komplain_pic = Komplain_pic::where('komplain_pic_komplain_id', $id)->first();
                $komplain_pic->komplain_pic_komplain_id = $komplain->id;
                // upload
                if ($request->hasFile('komplain_pic_image')){
                    $file = $request->file('komplain_pic_image');
                    $path = public_path('assets/images/komplain_pic');
                    $field = $komplain_pic->komplain_pic_image;
                    $imagename = FunctionLib::doUpload($file, $path, $field);
                    $komplain_pic->komplain_pic_image = $imagename;
                }
                $komplain_pic->save();
                // solusi
                $solusi = Solusi::where('solusi_komplain_id', $id)->first();
                $solusi->solusi_komplain_id = $komplain->id;
                $solusi->solusi_solusi_id = $request->solusi_solusi_id;
                $solusi->solusi_user_id = Auth::id();
                $solusi->solusi_value = $request->solusi_value;
                $solusi->solusi_note = $request->solusi_note;
                $solusi->save();
            }
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #buyer
    * @param id sys_komplain
    * @return
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
                $trans_detail_to_cancel = Trans_detail::whereId($item->id)->first();
                $trans_detail_to_cancel->trans_detail_drop = 1;
                $trans_detail_to_cancel->trans_detail_drop_date = date("Y-m-d H:i:s");
                $trans_detail_to_cancel->trans_detail_drop_note = "Barang sudah diterima member dan member mengajukan komplain";
                $trans_detail_to_cancel->trans_detail_is_cancel = 1;
                $trans_detail_to_cancel->save();
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
