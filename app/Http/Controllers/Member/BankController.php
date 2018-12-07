<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User_bank;
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
    private $mainTable = 'conf_bank';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
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
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['bank'] = Bank::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.bank.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['bank'] = Bank::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.bank.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Bank added!';
        
        $requestData = $request->all();
        
        $bank = Bank::findOrFail($id);
        $bank->bank_kode = $request->bank_kode;
        $bank->bank_name = $request->bank_name;
        $bank->bank_note = $request->bank_note;
        $bank->save();
        $res = $bank->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Bank Not updated!';
        }

        return redirect('member/bank')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
