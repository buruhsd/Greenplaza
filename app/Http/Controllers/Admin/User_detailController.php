<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User_detail;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class User_detailController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_detail';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['user_detail'] = User_detail::paginate($this->perPage);
        } else {
            $data['user_detail'] = User_detail::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.user_detail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user_detail.create', $data);
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
        $message = 'User_detail added!';
        
        $requestData = $request->all();
        
        $res = new User_detail;
        $res->user_detail_jk = $request->user_detail_jk;
        $res->user_detail_token = $request->user_detail_token;
        $res->user_detail_address = $request->user_detail_address;
        $res->user_detail_phone = $request->user_detail_phone;
        $res->user_detail_tlp = $request->user_detail_tlp;
        $res->user_detail_province = $request->user_detail_province;
        $res->user_detail_city = $request->user_detail_city;
        $res->user_detail_subdist = $request->user_detail_subdist;
        $res->user_detail_pos = $request->user_detail_pos;
        $res->user_detail_image = $request->user_detail_image;
        $res->user_detail_bank_name = $request->user_detail_bank_name;
        $res->user_detail_bank_owner = $request->user_detail_bank_owner;
        $res->user_detail_bank_no = $request->user_detail_bank_no;
        $res->user_detail_note = $request->user_detail_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User_detail Not added!';
        }
        return redirect('admin/user_detail')
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
        $data['user_detail'] = User_detail::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user_detail.show', $data);
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
        $data['user_detail'] = User_detail::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user_detail.edit', $data);
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
        $message = 'User_detail added!';
        
        $requestData = $request->all();
        
        $user_detail = User_detail::findOrFail($id);
        $user_detail->user_detail_jk = $request->user_detail_jk;
        $user_detail->user_detail_token = $request->user_detail_token;
        $user_detail->user_detail_address = $request->user_detail_address;
        $user_detail->user_detail_phone = $request->user_detail_phone;
        $user_detail->user_detail_tlp = $request->user_detail_tlp;
        $user_detail->user_detail_province = $request->user_detail_province;
        $user_detail->user_detail_city = $request->user_detail_city;
        $user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user_detail->user_detail_pos = $request->user_detail_pos;
        $user_detail->user_detail_image = $request->user_detail_image;
        $user_detail->user_detail_bank_name = $request->user_detail_bank_name;
        $user_detail->user_detail_bank_owner = $request->user_detail_bank_owner;
        $user_detail->user_detail_bank_no = $request->user_detail_bank_no;
        $user_detail->user_detail_note = $request->user_detail_note;
        $user_detail->save();
        $res = $user_detail->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'User_detail Not updated!';
        }

        return redirect('admin/user_detail')
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
        $message = 'User_detail deleted!';
        $res = User_detail::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User_detail Not deleted!';
        }

        return redirect('admin/user_detail')
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
        $user_detail = DB::query($qry);

        return $user_detail;
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
