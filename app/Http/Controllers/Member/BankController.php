<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User_bank;
use App\Models\Bank;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;


class BankController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_bank';
    
    /**
     * menampilkan data bank user.
     * @param search $request
     * @return view data bank user.
     */
    public function index(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.bank.index', $data);
    }

    /**
    * Set default user bank
    * @param $id #sys_user_bank
    **/
    public function set_default($id){
        $status = 200;
        $message = "Bank Updated";
        $user = User::findOrFail(Auth::id());
        $user_id = Auth::id();
        $userbank = $user->user_bank()->pluck('id')->toArray();
        // delete if uncheck
        array_walk($userbank, function($value) use ($user_id, $id) {
            if($value == (integer)$id){
                $user_bank = User_bank::where('id', $value)->first();
                $user_bank->user_bank_status = 1;
                $user_bank->save();
            }else{
                $user_bank = User_bank::where('id', $value)->first();
                $user_bank->user_bank_status = 0;
                $user_bank->save();
            }
        });
        return redirect('member/bank')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.bank.create', $data);
    }

    /**
     * menambahkan data bank user.
     * @param $request
     * @return redirect bank user
     */
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Bank berhasil ditambahkan!';
        
        $requestData = $request->all();
        $this->validate($request, [
            'user_bank_bank_id' => 'required|numeric',
            'user_bank_owner' => 'required',
            'user_bank_no' => 'required|numeric',
        ]);
        
        $res = new User_bank;
        $res->user_bank_user_id = Auth::id();
        $res->user_bank_bank_id = $request->user_bank_bank_id;
        $res->user_bank_name = Bank::whereId($request->user_bank_bank_id)->pluck('bank_kode')[0];
        $res->user_bank_owner = $request->user_bank_owner;
        $res->user_bank_no = $request->user_bank_no;
        $res->user_bank_note = 'User '.Auth::user()->username.' mengubah data bank.';
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Bank gagal ditambahkan!';
        }
        return redirect('member/bank')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Update data bank user.
     * @param  $request
     * @param  int  $id
     * @return redirect bank user.
     */
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Bank berhasil dirubah!';
        
        $requestData = $request->all();
        
        $res = User_bank::findOrFail($id);
        $res->user_bank_user_id = Auth::id();
        $res->user_bank_bank_id = $request->user_bank_bank_id;
        $res->user_bank_name = Bank::whereId($request->user_bank_bank_id)->pluck('bank_kode')[0];
        $res->user_bank_owner = $request->user_bank_owner;
        $res->user_bank_no = $request->user_bank_no;
        $res->user_bank_note = 'User '.Auth::user()->username.' menambahkan bank baru.';
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Bank gagal dirubah!';
        }
        return redirect('member/bank')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * menghapus data bank.
     * @param  int  $id
     * @return redirect data bank.
     */
    public function destroy($id)
    {
        $status = 200;
        $message = 'Bank deleted!';
        $res = Bank::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Bank Not deleted!';
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
