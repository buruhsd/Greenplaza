<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Withdrawal;
use App\Models\Wallet;
use App\Models\Wallet_type;
use App\Models\Log_wallet;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Trans;
use App\Models\Trans_detail;
use App\Models\Trans_gln;
use Auth;
use FunctionLib;


class WalletController extends Controller
{
    //MASEDI 
    public function log_masedi ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 3)->where('trans_user_id', Auth::id())->pluck('id')->toArray();
        // dd($trans);
        $masedi = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_transfer', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($masedi);
        return view('member.wallet.log.masedi.log_masedi', compact('masedi'));
    }

    //GLN
    public function log_gln ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->where('trans_user_id', Auth::id())->pluck('id')->toArray();
        // dd($trans);
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($gln);
        return view('member.wallet.log.gln.log_gln', compact('gln'));
    }
    public function log_gln_done ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->where('trans_user_id', Auth::id())->pluck('id')->toArray();
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_status', 6)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($masedi);
        return view('member.wallet.log.gln.log_gln_done', compact('gln'));
    }
    public function log_gln_done_receiver ()
    {
        $search = \Request::get('search');
        $wallet = Wallet::where('wallet_user_id', Auth::id())->where('wallet_type', 7)->first();
        // dd($wallet);
        $trans = Trans::where('trans_payment_id', '=', 4)->where('trans_user_id', Auth::id())->pluck('id')->toArray();
        $gln = Trans_gln::where('trans_gln_to', $wallet->wallet_address)
            ->where('trans_gln_status', 2)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($gln);
        return view('member.wallet.log.gln.log_gln_done_receiver', compact('gln'));
    }
    public function log_gln_cancel ()
    {
        $search = \Request::get('search');
        $trans = Trans::where('trans_payment_id', '=', 4)->where('trans_user_id', Auth::id())->pluck('id')->toArray();
        $gln = Trans_detail::where('trans_code', 'like', '%'.$search.'%')
            ->whereIn('trans_detail_trans_id', $trans)
            ->where('trans_detail_is_cancel', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        // dd($masedi);
        return view('member.wallet.log.gln.log_gln_cancel', compact('gln'));
    }

    private $perPage = 25;
    private $mainTable = 'sys_wallet';

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function create_gln(Request $request)
    {
        $status = 500;
        $message = 'Gagal membuat wallet gln.';
        $response = FunctionLib::gln('create', ['label'=>Auth::user()->username]);
        if($response['status'] == 200){
            $wallet = new Wallet;
            $wallet->wallet_user_id = Auth::id();
            $wallet->wallet_type = 7;
            $wallet->wallet_ballance_before = 0;
            $wallet->wallet_ballance = 0;
            $wallet->wallet_address = $response['data']['address'];
            $wallet->wallet_public = $response['data']['public'];
            $wallet->wallet_private = $response['data']['private'];
            $wallet->wallet_note = json_encode($response['data']);
            $wallet->save();
                $status = 200;
                $message = 'Wallet berhasil dibuat.';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }
    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['wallet'] = Wallet::where('wallet_user_id', Auth::id())->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.index', $data);
    }
    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function type($slug='')
    {
        $search = \Request::get('search');
        $wallet_type = Wallet_type::where('wallet_type_kode', $slug)->first();
        // dd($wallet_type['id']);
        $data['wallet_type'] = $wallet_type;
        // $data['log_wallet'] = Log_wallet::where('wallet_user_id', Auth::id())
        //     ->get();
        $data['log_wallet'] = $wallet_type->log()->where('wallet_user_id', Auth::id())->where('wallet_note', 'like', '%'.$search.'%')
            ->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.type', $data);
    }

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function cw_bonus()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.cw_bonus', $data);
    }
    
    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function cw_trans()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.cw_trans', $data);
    }
    
    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function rw()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.rw', $data);
    }
    
    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function withdrawal(Request $request)
    {
        $status = 200;
        $message = 'Withdrawal Success.';
        $requestData = $request->all();
        if(!empty($requestData)){
            // dd($requestData);
            $this->validate($request, [
                'withdrawal_wallet_type' => 'required',
                'withdrawal_wallet_amount' => 'required',
                'password' => 'required',
            ]);
            // validasi password
            $user = User::findOrFail(Auth::id());
            if (!Hash::check($request->password, $user->user_detail->user_detail_pass_trx)) {
                $status = 500;
                $message = 'Password does Not Match!';
                return redirect()->back()
                    ->with(['flash_status' => $status,'flash_message' => $message]);
            }
            $where = 'wallet_user_id = '.Auth::id();
            $where .= ' AND wallet_type = '.$request->withdrawal_wallet_type;
            $wallet = Wallet::whereRaw($where)->first();
            if($wallet && $wallet->wallet_ballance >= $request->withdrawal_wallet_amount){
                $wd = new Withdrawal;
                $wd->withdrawal_user_id = Auth::id();
                $wd->withdrawal_wallet_id = $wallet->id;
                $wd->withdrawal_wallet_type = $request->withdrawal_wallet_type;
                $wd->withdrawal_wallet_amount = $request->withdrawal_wallet_amount;
                    if($request->withdrawal_wallet_amount < 50000){
                        $status = 500;
                        $message = 'Withdrawal minimal 50.000';
                        return redirect()->back()
                            ->with(['flash_status' => $status,'flash_message' => $message]);
                    }else{
                        $wd->save();
                        
                    }

                // $wd->withdrawal_status = $request->withdrawal_status;
                // $wd->withdrawal_approval_id = $request->withdrawal_approval_id;
                // $wd->withdrawal_response_date = $request->withdrawal_response_date;
                // $wd->withdrawal_response_text = $request->withdrawal_response_text;
                // $iklan->iklan_note = 'Pembelian iklan baris oleh '.Auth::user()->username.' pada '.date('Y-m-d H:i:s');
            }else{
                $status = 500;
                $message = 'Withdrawal Failed.';
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $search = \Request::get('search');
        $with = Withdrawal::where('withdrawal_user_id', Auth::id())
                ->orderBy('created_at', 'DESC')->paginate(10);
                // dd($with);
        $data['with'] = $with;     
        $data['type'] = Wallet_type::whereRaw('id IN (1)')->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.withdrawal', $data);


    }

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function transfer_cw(Request $request)
    {
        $status = 200;
        $message = 'Transfer Berhasil.';
        $date = date('Y-m-d H:i:s');
        $requestData = $request->all();
        if(!empty($requestData)){
            $this->validate($request, [
                'wallet_type' => 'required',
                'username' => 'required',
                'wallet_amount' => 'required',
                'password' => 'required',
            ]);
            // validasi password
            $user = User::findOrFail(Auth::id());
            if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
                $status = 500;
                $message = 'Password does Not Match!';
                return redirect()->back()
                    ->with(['flash_status' => $status,'flash_message' => $message]);
            }
            $where = 'wallet_user_id = '.Auth::id();
            $where .= ' AND wallet_type = '.$request->wallet_type;
            $wallet_from = Wallet::whereRaw($where)->first();
            $where_to = 'wallet_type = '.$request->wallet_type;
            $wallet_to = Wallet::whereRaw($where_to)->whereHas('user', function($query) use ($request){
                    $query->where('users.username', $request->username);
                    return $query;
                })->first();
            if($wallet_from && $wallet_from->wallet_ballance >= $request->wallet_amount){
                $wallet_from->wallet_ballance_before = $wallet_from->wallet_ballance;
                $wallet_from->wallet_ballance = ($wallet_from->wallet_ballance - $request->wallet_amount);
                $wallet_from->wallet_address = $wallet_from->wallet_address;
                $wallet_from->wallet_public = $wallet_from->wallet_public;
                $wallet_from->wallet_private = $wallet_from->wallet_private;
                $wallet_from->wallet_note = 'Transfer Wallet ke '.$request->username.' pada '.FunctionLib::date_indo($date, true, 'full');
                $wallet_from->save();
                $wallet_to->wallet_ballance_before = $wallet_to->wallet_ballance;
                $wallet_to->wallet_ballance = ($wallet_to->wallet_ballance + $request->wallet_amount);
                $wallet_to->wallet_address = $wallet_to->wallet_address;
                $wallet_to->wallet_public = $wallet_to->wallet_public;
                $wallet_to->wallet_private = $wallet_to->wallet_private;
                $wallet_to->wallet_note = 'Transfer Wallet dari '.Auth::user()->username.' pada '.FunctionLib::date_indo($date, true, 'full');
                $wallet_to->save();
                // $wd = new Withdrawal;
                // $log_wallet->wallet_type_log = 'manual';
                // $log_wallet->wallet_type = $request->wallet_type;
                // $log_wallet->wallet_user_id = $request->wallet_user_id;
                // $log_wallet->wallet_user_name = $request->wallet_user_name;
                // $log_wallet->wallet_ballance_before = $request->wallet_ballance_before;
                // $log_wallet->wallet_ballance_after = $request->wallet_ballance_after;
                // $log_wallet->wallet_cash_in = $request->wallet_cash_in;
                // $log_wallet->wallet_cash_out = $request->wallet_cash_out;
                // $log_wallet->wallet_user_from = $request->wallet_user_from;
                // $log_wallet->wallet_user_from_name = $request->wallet_user_from_name;
                // $log_wallet->wallet_note = $request->wallet_note;
                // $log_wallet->wallet_pajak = $request->wallet_pajak;
                // $log_wallet->wallet_id_grade_pajak = $request->wallet_id_grade_pajak;
                // $log_wallet->wallet_id_referensi = $request->wallet_id_referensi;
                // $wd->save();
            }else{
                $status = 500;
                $message = 'Transfer Gagal.';
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        // $data['user'] = User::all();
        $data['user'] = User::whereHas('roles', function($query){
                $query->whereRaw('name IN ("member", "admin")');
                return $query;
            })->get();
        $data['type'] = Wallet_type::whereRaw('id IN (1, 3)')->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.transfer_cw', $data);
    }

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function transfer_rw(Request $request)
    {
        $status = 200;
        $message = 'Transfer Berhasil.';
        $date = date('Y-m-d H:i:s');
        $requestData = $request->all();
        if(!empty($requestData)){
            $this->validate($request, [
                'wallet_type' => 'required',
                'username' => 'required',
                'wallet_amount' => 'required',
                'password' => 'required',
            ]);
            // validasi password
            $user = User::findOrFail(Auth::id());
            if (!Hash::check($request->user_detail_pass_trx, $user->user_detail->user_detail_pass_trx)) {
                $status = 500;
                $message = 'Password does Not Match!';
                return redirect()->back()
                    ->with(['flash_status' => $status,'flash_message' => $message]);
            }
            $where = 'wallet_user_id = '.Auth::id();
            $where .= ' AND wallet_type = '.$request->wallet_type;
            $wallet_from = Wallet::whereRaw($where)->first();
            $where_to = 'wallet_type = '.$request->wallet_type;
            $wallet_to = Wallet::whereRaw($where_to)->whereHas('user', function($query) use ($request){
                    $query->where('users.username', $request->username);
                    return $query;
                })->first();
            if($wallet_from && $wallet_from->wallet_ballance >= $request->wallet_amount){
                $wallet_from->wallet_ballance_before = $wallet_from->wallet_ballance;
                $wallet_from->wallet_ballance = ($wallet_from->wallet_ballance - $request->wallet_amount);
                $wallet_from->wallet_address = $wallet_from->wallet_address;
                $wallet_from->wallet_public = $wallet_from->wallet_public;
                $wallet_from->wallet_private = $wallet_from->wallet_private;
                $wallet_from->wallet_note = 'Transfer Wallet ke '.$request->username.' pada '.FunctionLib::date_indo($date, true, 'full');
                $wallet_from->save();
                $wallet_to->wallet_ballance_before = $wallet_to->wallet_ballance;
                $wallet_to->wallet_ballance = ($wallet_to->wallet_ballance + $request->wallet_amount);
                $wallet_to->wallet_address = $wallet_to->wallet_address;
                $wallet_to->wallet_public = $wallet_to->wallet_public;
                $wallet_to->wallet_private = $wallet_to->wallet_private;
                $wallet_to->wallet_note = 'Transfer Wallet dari '.Auth::user()->username.' pada '.FunctionLib::date_indo($date, true, 'full');
                $wallet_to->save();
                // $wd = new Withdrawal;
                // $log_wallet->wallet_type_log = 'manual';
                // $log_wallet->wallet_type = $request->wallet_type;
                // $log_wallet->wallet_user_id = $request->wallet_user_id;
                // $log_wallet->wallet_user_name = $request->wallet_user_name;
                // $log_wallet->wallet_ballance_before = $request->wallet_ballance_before;
                // $log_wallet->wallet_ballance_after = $request->wallet_ballance_after;
                // $log_wallet->wallet_cash_in = $request->wallet_cash_in;
                // $log_wallet->wallet_cash_out = $request->wallet_cash_out;
                // $log_wallet->wallet_user_from = $request->wallet_user_from;
                // $log_wallet->wallet_user_from_name = $request->wallet_user_from_name;
                // $log_wallet->wallet_note = $request->wallet_note;
                // $log_wallet->wallet_pajak = $request->wallet_pajak;
                // $log_wallet->wallet_id_grade_pajak = $request->wallet_id_grade_pajak;
                // $log_wallet->wallet_id_referensi = $request->wallet_id_referensi;
                // $wd->save();
            }else{
                $status = 500;
                $message = 'Transfer Gagal.';
            }
            return redirect()->back()
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        // $data['user'] = User::all();
        $data['user'] = User::whereHas('roles', function($query){
                $query->whereRaw('name IN ("member", "admin")');
                return $query;
            })->get();        $data['type'] = Wallet_type::whereRaw('id IN (1, 3)')->get();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.transfer_rw', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Bank added!';
        
        $requestData = $request->all();
        
        $res = new Bank;
        $res->bank_kode = $request->bank_kode;
        $res->bank_name = $request->bank_name;
        $res->bank_note = $request->bank_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Bank Not added!';
        }
        return redirect('member/bank')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $where
    * @return
    */
    public function get_one_row($where='1', $join=array()){
        $qry = 'SELECT * FROM '.$this->mainTable;
        if(!empty($join)){
            foreach ($join as $value) {
                $qry .= $value;
            }
        }
        $qry .= ' WHERE '.$where.' Limit 1';
        $bank = DB::query($qry);

        return $bank;
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
                    <!-- <link href="<?php //echo asset('xtreme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet"> -->
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'transfer_rw':
            case 'transfer_cw':
                ?>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-combobox/1.1.8/css/bootstrap-combobox.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-combobox/1.1.8/js/bootstrap-combobox.min.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){
                          $('.combobox').combobox();
                          
                          // bonus: add a placeholder
                          $('.combobox').attr('placeholder', 'Contoh, tulis "user"');
                        });
                    </script>
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
