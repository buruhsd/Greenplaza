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
    * @return add main footer script / in spesific method
    */
    public function list(){
        return view('member.pincode.tagihan');
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function baris(){
        $data['iklan'] = Iklan::whereRaw('iklan_user_id ='.Auth::id())->paginate($this->perPage);
        return view('member.iklan.history', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function banner(){
        $data['iklan'] = Iklan::whereRaw('iklan_user_id ='.Auth::id())->paginate($this->perPage);
        return view('member.iklan.history', $data);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function slider(){
        $data['iklan'] = Iklan::whereRaw('iklan_user_id ='.Auth::id())->paginate($this->perPage);
        return view('member.iklan.history', $data);
    }

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
    * @return view
    */
    public function to_confirm(Request $request, $id){
        $res = Trans_iklan::findOrFail($id);
        $res->trans_iklan_status = 1;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_cancel(Request $request, $id){
        $res = Trans_iklan::findOrFail($id);
        $res->trans_iklan_status = 2;
        $res->save();
        return redirect()->back();
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
        $paket_iklan = Paket_iklan::whereId($request->trans_iklan_paket_id)->first();
        $code = FunctionLib::str_rand(4).FunctionLib::str_rand(6);
        $date = date('Y-m-d H:i:s');
        $res = new Trans_iklan;
        $res->trans_iklan_code = 'IKL-'.$code;
        $res->trans_iklan_user_id = Auth::id();
        // $res->trans_iklan_status = 0;
        $res->trans_iklan_paket_id = $request->trans_iklan_paket_id;
        $res->trans_iklan_amount = $paket_iklan->paket_iklan_price;
        $res->trans_iklan_note = $request->trans_iklan_note;//'Pembelian Paket Iklan '.$paket_iklan->paket_iklan_name.' by '.Auth::user()->username.' at '
            // .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Cannot Buy Saldo Iklan!';
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
        $where = "1 AND trans_iklan_user_id =".Auth::id();
        if(!empty($request->get('code'))){
            $code = $request->get('code');
            $where .= ' AND trans_iklan_code LIKE "%'.$code.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_iklan_status IN ('.$status.')';
        }
        $data['iklan'] = Trans_iklan::whereRaw($where)->paginate();
        return view('member.iklan.tagihan', $data);
    }
}
