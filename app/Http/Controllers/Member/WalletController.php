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
use Auth;
use FunctionLib;


class WalletController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_wallet';

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
        $wallet_type = Wallet_type::where('wallet_type_kode', $slug)->pluck('id')[0];
        $data['log_wallet'] = Log_wallet::where('wallet_user_id', Auth::id())
            ->where('wallet_type', $wallet_type)
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
    public function withdrawal()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.withdrawal', $data);
    }

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function transfer_cw()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wallet.transfer_cw', $data);
    }

    /**
     * 
     * @param
     * @return \Illuminate\View\View
     */
    public function transfer_rw()
    {
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
