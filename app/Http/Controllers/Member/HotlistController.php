<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;
use App\Models\Paket_hotlist;
use App\Models\Trans_hotlist;
use App\Models\Produk;
use App\User;
use Illuminate\Support\Facades\Hash;

class HotlistController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_produk';


    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Transfer confirmed!';
        $trans = Trans_hotlist::findOrFail($id);
        $status = FunctionLib::midtrans_status($trans->trans_hotlist_code);
        if($status){
            $trans->trans_hotlist_status = 1;
            $trans->save();
            $status = 200;
            $message = 'You has been Transfered!';
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $data['trans'] = $trans;
            return view('member.hot-list.konfirmasi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
    * @param $request
    * @return view
    */
    public function history(Request $request){
        $where = 1;
        $where .= ' AND produk_seller_id ='.Auth::id();
        $where .= ' AND produk_is_hot = 1';
        $where .= ' AND produk_hotlist > 0';
        if(!empty($request->search)){
            $where .= ' AND produk_name LIKE "%'.$request->search.'%"';
        }
        $data['hotlist'] = Produk::whereRaw($where)->paginate($this->perPage);
        return view('member.hot-list.history', $data);
    }

    /**
    * @param 
    * @return view
    */
    public function buy_poin(){
        $data['paket'] = Paket_hotlist::all();
        return view('member.hot-list.buy_poin', $data);
    }

    /**
    * @param $request, $id
    * @return view
    */
    public function to_confirm(Request $request, $id){
        $res = Trans_hotlist::findOrFail($id);
        $res->trans_hotlist_status = 1;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param $request, $id
    * @return view
    */
    public function to_cancel(Request $request, $id){
        $res = Trans_hotlist::findOrFail($id);
        $res->trans_hotlist_status = 2;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param $request
    * @return redirect
    */
    public function buy_poin_store(Request $request){
        $status = 200;
        $message = 'Buy Poin Successfully!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_hotlist_paket_id' => 'required|numeric',
            'user_detail_pass_trx' => 'required',
        ]);
        // validasi password
        $user = User::findOrFail(Auth::id());
        if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
            $status = 500;
            $message = 'Password does Not Match!';
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        // input transaksi
        $paket_hotlist = Paket_hotlist::whereId($request->trans_hotlist_paket_id)->first();
        $code = FunctionLib::str_rand(4).FunctionLib::str_rand(6);
        $date = date('Y-m-d H:i:s');
        $res = new Trans_hotlist;
        $res->trans_hotlist_code = 'HL-'.$code;
        $res->trans_hotlist_user_id = Auth::id();
        // $res->trans_hotlist_status = 0;
        $res->trans_hotlist_paket_id = $request->trans_hotlist_paket_id;
        $res->trans_hotlist_amount = $paket_hotlist->paket_hotlist_price;
        $res->trans_hotlist_jml = $paket_hotlist->paket_hotlist_amount + $paket_hotlist->paket_hotlist_bonus;
        $res->trans_hotlist_note = 'Pembelian Paket Hotlist '.$paket_hotlist->paket_hotlist_name.' by '.Auth::user()->username.' at '
            .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Brand Not added!';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $request
    * @return View
    */
    public function tagihan(Request $request){
        $arr = [
            "0" =>'new',
            "1" =>'wait',
            "3" =>'lunas',
            "2" =>'batal',
            "4" =>'ditolak',
            "0,1,2,3,4" =>'',
        ];
        $where = "1 AND trans_hotlist_user_id =".Auth::id();
        if(!empty($request->get('code'))){
            $code = $request->get('code');
            $where .= ' AND trans_hotlist_code LIKE "%'.$code.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_hotlist_status IN ('.$status.')';
        }
        $data['hotlist'] = Trans_hotlist::whereRaw($where)->paginate();
        return view('member.hot-list.tagihan', $data);
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
                    <script type="text/javascript">
                    </script>
                <?php
                break;
            case 'show':
                ?>
                    </script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
