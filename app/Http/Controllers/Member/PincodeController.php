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
use App\Models\Paket_pincode;
use App\Models\Trans_pincode;
use App\Models\Pincode;
use App\Models\Payment;
use App\User;
use Illuminate\Support\Facades\Hash;

class PincodeController extends Controller
{
    private $perPage = 10;
    private $mainTable = 'sys_trans_pincode';

    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Transfer confirmed!';
        $trans = Trans_pincode::findOrFail($id);
        $status = FunctionLib::midtrans_status($trans->trans_pincode_code);
        if($status){
            $trans->trans_pincode_status = 1;
            $trans->save();
            if($trans->pincode->count() == 0){
                $target = intval($trans->paket->paket_pincode_amount) + intval($trans->paket->paket_pincode_bonus);
                for ($no=1; $no <= $target; $no++) { 
                    $code = FunctionLib::str_rand(2).FunctionLib::str_rand(2);
                    $res = new Pincode;
                    $res->pincode_code = $trans->trans_pincode_code.$code;
                    $res->pincode_pincode_id = $trans->id;
                    $res->pincode_user_id = Auth::id();
                    $res->save();
                }
            }
            $status = 200;
            $message = 'You has been Transfered!';
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }else{
            $data['trans'] = $trans;
            return view('member.pincode.konfirmasi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function list(){
        return view('web_errors.maintenance');
        $data['pincode'] = Pincode::whereRaw('pincode_user_id ='.Auth::id())->paginate($this->perPage);
        return view('member.pincode.history', $data);
    }

    /**
    * @param method $method
    * @return view
    */
    public function buy_pincode(){
        return view('web_errors.maintenance');
        $data['paket'] = Paket_pincode::all();
        return view('member.pincode.buy_pincode', $data);
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_confirm(Request $request, $id){
        $res = Trans_pincode::findOrFail($id);
        $res->trans_pincode_status = 1;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return view
    */
    public function to_cancel(Request $request, $id){
        $res = Trans_pincode::findOrFail($id);
        $res->trans_pincode_status = 2;
        $res->save();
        return redirect()->back();
    }

    /**
    * @param method $method
    * @return 
    */
    public function buy_pincode_store(Request $request){
        $status = 200;
        $message = 'Buy Saldo Pincode Successfully!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_pincode_paket_id' => 'required|numeric',
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
        $paket_pincode = Paket_pincode::whereId($request->trans_pincode_paket_id)->first();
        $code = FunctionLib::str_rand(4).FunctionLib::str_rand(6);
        $date = date('Y-m-d H:i:s');
        $res = new Trans_pincode;
        $res->trans_pincode_code = 'PC-'.$code;
        $res->trans_pincode_user_id = Auth::id();
        // $res->trans_pincode_status = 0;
        $res->trans_pincode_paket_id = $request->trans_pincode_paket_id;
        $res->trans_pincode_amount = $paket_pincode->paket_pincode_price;
        $res->trans_pincode_note = 'Pembelian Paket Pincode '.$paket_pincode->paket_pincode_name.' by '.Auth::user()->username.' at '
            .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Cannot Buy Saldo Pincode!';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function tagihan(Request $request){
        return view('web_errors.maintenance');
        $arr = [
            "0" =>'new',
            "1" =>'wait',
            "3" =>'lunas',
            "2" =>'batal',
            "4" =>'ditolak',
            "0,1,2,3,4" =>'',
        ];
        $where = "1 AND trans_pincode_user_id =".Auth::id();
        if(!empty($request->get('code'))){
            $code = $request->get('code');
            $where .= ' AND trans_pincode_code LIKE "%'.$code.'%"';
        }
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = array_search($status,$arr);
            $where .= ' AND trans_pincode_status IN ('.$status.')';
        }
        $data['pincode'] = Trans_pincode::whereRaw($where)->paginate();
        $data['payment'] = Payment::where('payment_status', 1)->get();
        return view('member.pincode.tagihan', $data);
    }
}
