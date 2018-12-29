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
    public function tagihan(){
        return view('member.hot-list.tagihan');
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
