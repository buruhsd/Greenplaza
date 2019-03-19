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
use App\Models\Review;


class KomplainController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_komplain';

    public function review_komplain(Request $request, $id){
        $status = 200;
        $message = 'Review produk berhasil disimpan';
        $komplain = Komplain::findOrFail($id);
        foreach ($komplain->trans_detail->trans->trans_detail as $item) {
            $res = new Review;
            $res->review_produk_id = $item->trans_detail_produk_id;
            $res->review_user_id = $request->review_user_id;
            $res->review_stars = $request->review_stars;
            $res->review_text = $request->review_text;
            $res->save();
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #buyer
    * @param $request, $id solusi
    * @return
    **/
    public function done_komplain(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        $arr = [
            'member' => [1,4],
            'seller' => [2,3]
        ];
        $date = date("Y-m-d H:i:s");
        try{
            $komplain = Komplain::findOrFail($id);
            // wallet ke member (pengermbalian dana) approved admin
            if(in_array($komplain->solusi->solusi_solusi_id,$arr['member'])){
                $komplain->komplain_status = 2;
                $komplain->save();
                if($komplain){
                    $solusi = $komplain->solusi;
                    $solusi->solusi_status = 3;
                    $solusi->save();
                }
            }
            // wallet ke seller (lanjutkan)
            elseif(in_array($komplain->solusi->solusi_solusi_id,$arr['seller'])){
                $komplain->komplain_status = 3;
                $komplain->komplain_clear_date = $date;
                $komplain->save();
                if($komplain){
                    $solusi = $komplain->solusi;
                    $solusi->solusi_status = 3;
                    $solusi->save();
                }
                // kembalikan wallet ke member
                if($komplain->trans_detail->trans->trans_payment_id !== 4){
                    $update_wallet = [
                        'user_id'=>$komplain->trans_detail->produk->produk_seller_id,
                        'wallet_type'=>1,
                        'amount'=>$komplain->trans_detail->trans->trans_amount_total,
                        'note'=>'Transaksi Success by admin. Update wallet transaksi dikembalikan ke member dengan transaksi kode '.$komplain->trans_detail->trans->trans_code.' dari toko '.$komplain->trans_detail->produk->user->user_store.'.',
                    ];
                    $saldo = FunctionLib::update_wallet($update_wallet);
                }
                // update transaksi menjadi dropping
                foreach ($komplain->trans_detail->trans->trans_detail as $item) {
                    $item->trans_detail_status = 6;
                    $item->trans_detail_is_cancel = 0;
                    $item->trans_detail_drop = 1;
                    $item->trans_detail_drop_date = $date;
                    $item->trans_detail_drop_note = $item->trans_detail_drop_note.", Komplain sudah selesai dan dana di kembalikan ke member";
                    $item->save();
                }
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
                ->orderBy('sys_komplain.updated_at', 'DESC')
                ->whereHas('trans_detail', function ($query) {
                    $query->whereHas('trans', function ($query2) {
                        $query2->where('trans_user_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
                })
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::whereHas('trans_detail', function ($query) {
                    $query->whereHas('trans', function ($query2) {
                        $query2->where('trans_user_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
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
                ->orderBy('sys_komplain.updated_at', 'DESC')
                ->whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
                })
                ->paginate($this->perPage);
        } else {
            $data['komplain'] = Komplain::whereHas('trans_detail', function ($query) {
                    $query->whereHas('produk', function ($query2) {
                        $query2->where('produk_seller_id', '=', Auth::id());
                        return $query2;
                    });
                    return $query;
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
                $solusi_note = $solusi->solusi_note.Auth::user()->username." : ".$request->solusi_note."<br/>";
                $solusi->solusi_note = $solusi_note;
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
            if($request->exists('komplain_komplain_id') && $request->exists('solusi_solusi_id')){                
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
