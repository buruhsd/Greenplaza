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
        $status = FunctionLib::midtrans_status($trans->trans_code);
        if($status){
            foreach ($trans->trans_detail as $item) {
                $trans_detail = Trans_detail::findOrFail($item->id);
                // to transfer
                $trans_detail->trans_detail_status = 2;
                $trans_detail->trans_detail_transfer_date = date('y-m-d h:i:s');
                $trans_detail->save();
            }
            if(!$trans_detail){
                $status = 500;
                $message = 'Transfer unconfirmed!';
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $data['trans'] = $trans;
            return view('member.hot-list.konfirmasi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function list(){
        return view('member.hot-list.tagihan');
    }

    /**
    * @param method $method
    * @return view
    */
    public function buy_poin(){
        $data['paket'] = Paket_hotlist::all();
        return view('member.hot-list.buy_poin', $data);
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_confirm(Request $request, $id){
        $res = Trans_hotlist::findOrFail($id);
        $res->trans_hotlist_status = 1;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_cancel(Request $request, $id){
        $res = Trans_hotlist::findOrFail($id);
        $res->trans_hotlist_status = 2;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return 
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
    * @param method $method
    * @return add main footer script / in spesific method
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
