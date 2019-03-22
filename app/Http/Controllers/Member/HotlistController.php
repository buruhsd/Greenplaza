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
use App\Models\Payment;
use App\User;
use Illuminate\Support\Facades\Hash;

class HotlistController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_produk';



    /**
    * @param $request, $id
    * @return view
    */
    public function generate_qr(Request $request, $id){
        $trans = Trans_hotlist::findOrFail($id);
        // $trans->trans_hotlist_status = 1;
        // $trans->save();

        $transaction_details = array(
          'note' => $trans->trans_hotlist_code,
          'price' => $trans->trans_hotlist_amount, // no decimal allowed for creditcard
        );
        try{
            // $masedi = FunctionLib::masedi_payment($transaction_details);
            $masedi = [
                  "status" => true,
                  "va" => "WUN2NLT4HJ"
                ];
            if($masedi['status'] == true){
                $trans->trans_hotlist_qr = $masedi['va'];
                $trans->save();
            }
        }catch(\Exception $err){
            
        }
        return redirect()->back();
    }

    /**
     * #buyer
     * process buyer mengkonfirmasi pembayaran
     * @param
     * @return
     */
    public function konfirmasi($id){
        $status = 200;
        $message = 'Anda sudah melakukan transfer!';
        $trans = Trans_hotlist::findOrFail($id);
        if($trans->trans_hotlist_status == 0){
            $data['trans'] = $trans;
            switch ($trans->trans_hotlist_payment_id) {
                case 1:
                    $status = 200;
                    $message = 'Pembayaran menggunakan transfer!';
                break;
                case 2:
                    $status = FunctionLib::midtrans_status($trans->trans_hotlist_code);
                    if($status){
                        $trans->trans_hotlist_status = 1;
                        $trans->save();
                        $status = 200;
                        $message = 'Anda sudah melakukan transfer!';
                        return redirect()->back()
                            ->with(['flash_status' => $status,'flash_message' => $message]);
                    }else{
                        return view('member.hot-list.konfirmasi', $data);
                    }
                break;
                case 3:
                    $message = 'Pembayaran menggunakan Masedi!';
                    return view('member.hot-list.konfirmasi.masedi', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;
                case 4:
                    $message = 'Pembayaran menggunakan Gln!';
                    return view('member.hot-list.konfirmasi.gln', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;
                case 5:
                    $message = 'Pembayaran menggunakan Saldo!';
                    return view('member.hot-list.konfirmasi.saldo', $data)->with(['flash_status' => $status,'flash_message' => $message]);
                break;                
            }
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $request
    * @return view
    */
    public function history(Request $request){
        return view('web_errors.maintenance');
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
        return view('web_errors.maintenance');
        $data['paket'] = Paket_hotlist::all();
        $data['payment'] = Payment::where('payment_status', 1)->get();
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
        $message = 'Berhasil membeli poin!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'trans_hotlist_paket_id' => 'required|numeric',
            'user_detail_pass_trx' => 'required',
            'trans_hotlist_payment_id' => 'required',
        ]);
        // validasi password
        $user = User::findOrFail(Auth::id());
        if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
            $status = 500;
            $message = 'Password salah!';
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
        $res->trans_hotlist_payment_id = $request->trans_hotlist_payment_id;
        $res->trans_hotlist_amount = $paket_hotlist->paket_hotlist_price;
        $res->trans_hotlist_jml = $paket_hotlist->paket_hotlist_amount + $paket_hotlist->paket_hotlist_bonus;
        $res->trans_hotlist_note = 'Pembelian Paket Hotlist '.$paket_hotlist->paket_hotlist_name.' by '.Auth::user()->username.' at '
            .FunctionLib::datetime_indo($date, true, 'full');
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Gagal membeli poin!';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $request
    * @return View
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
        $data['payment'] = Payment::where('payment_status', 1)->get();
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
