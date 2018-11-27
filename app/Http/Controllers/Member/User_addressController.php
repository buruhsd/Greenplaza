<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User_address;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;


class User_addressController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_user_address';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['user_address'] = User_address::paginate($this->perPage);
        } else {
            $data['user_address'] = User_address::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.user_address.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user_address.create', $data);
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
        $message = 'User_address added!';
        
        $requestData = $request->all();
        
        $res = new User_address;
        $res->user_address_user_id = Auth::id();
        $res->user_address_label = $request->address_label;
        $res->user_address_owner = $request->address_owner;
        $res->user_address_address = $request->address_address;
        $res->user_address_phone = $request->address_phone;
        $res->user_address_tlp = $request->address_tlp;
        $res->user_address_province = $request->address_province;
        $res->user_address_city = $request->address_city;
        $res->user_address_subdist = $request->address_subdist;
        $res->user_address_pos = $request->address_pos;
        $res->user_address_note = $request->address_note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User_address Not added!';
        }
        return redirect()->back()//('member/user_address')
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
        $data['user_address'] = User_address::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user_address.show', $data);
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
        $data['user_address'] = User_address::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user_address.edit', $data);
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
        $message = 'User_address added!';
        
        $requestData = $request->all();
        
        $user_address = User_address::findOrFail($id);
        $user_address->user_address_user_id = $request->user_address_user_id;
        $user_address->user_address_label = $request->user_address_label;
        $user_address->user_address_owner = $request->user_address_owner;
        $user_address->user_address_address = $request->user_address_address;
        $user_address->user_address_phone = $request->user_address_phone;
        $user_address->user_address_tlp = $request->user_address_tlp;
        $user_address->user_address_province = $request->user_address_province;
        $user_address->user_address_city = $request->user_address_city;
        $user_address->user_address_subdist = $request->user_address_subdist;
        $user_address->user_address_pos = $request->user_address_pos;
        $user_address->user_address_note = $request->user_address_note;
        $user_address->save();
        $res = $user_address->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'User_address Not updated!';
        }

        return redirect('member/user_address')
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
        $message = 'User_address deleted!';
        $res = User_address::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User_address Not deleted!';
        }

        return redirect('member/user_address')
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
        $user_address = DB::query($qry);

        return $user_address;
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
