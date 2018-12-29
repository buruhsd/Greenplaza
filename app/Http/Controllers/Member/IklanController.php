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
use App\Models\Paket_iklan;
use App\Models\Trans_iklan;
use App\User;
use Illuminate\Support\Facades\Hash;

class IklanController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_iklan';

    /**
    * @param method $method
    * @return view
    */
    public function beli_saldo(){
        $data['paket'] = Paket_iklan::all();
        return view('member.iklan.beli_saldo', $data);
    }

    /**
    * @param method $method
    * @return 
    */
    public function beli_saldo_store(Request $request){
        $status = 200;
        $message = 'Buy Saldo Iklan Successfully!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_iklan_paket_id' => 'required|numeric',
            'trans_iklan_note' => 'required',
        ]);
        // validasi password
        // $user = User::findOrFail(Auth::id());
        // if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
        //     $status = 500;
        //     $message = 'Password does Not Match!';
        //     return redirect()->back()
        //         ->with(['flash_status' => $status,'flash_message' => $message]);
        // }
        // input transaksi
        $paket_hotlist = Paket_iklan::whereId($request->trans_hotlist_paket_id)->first();
        $code = FunctionLib::str_rand(4).FunctionLib::str_rand(6);
        $date = date('Y-m-d H:i:s');
        $res = new Trans_iklan;
        $res->trans_iklan_code = 'IKL-'.$code;
        $res->trans_iklan_user_id = Auth::id();
        // $res->trans_hotlist_status = 0;
        $res->trans_iklan_paket_id = $request->trans_hotlist_paket_id;
        $res->trans_iklan_amount = $paket_hotlist->paket_hotlist_price;
        $res->trans_iklan_note = $request->trans_iklan_note;//'Pembelian Paket Iklan '.$paket_hotlist->paket_hotlist_name.' by '.Auth::user()->username.' at '
            // .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Cannot Buy Saldo Iklan!';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }
}
