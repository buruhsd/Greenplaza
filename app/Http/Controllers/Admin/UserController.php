<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = [
            "0" =>'wait',
            "1" =>'active',
            "2" =>'block',
            'wait' => ' AND (email_verified_at IS NULL OR email_verified_at = "")',
            'active' => ' AND (email_verified_at IS NOT NULL OR email_verified_at != "")',
            'block' =>'',
            '' =>'',
        ];
        $where = "1";
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            $status = $arr[$status];
            $where .= $status;
        }
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND name LIKE "%'.$name.'%"';
        }
        if(!empty($request->get('username'))){
            $username = $request->get('username');
            $where .= ' AND username LIKE "%'.$username.'%"';
        }

        if (!empty($where)) {
            $data['user'] = User::whereRaw($where)
                ->paginate($this->perPage);
        } else {
            $data['user'] = User::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['role'] = Role::all();
        $data['user'] = User::all();
        $data['category'] = Category::all();
        $data['brand'] = Brand::all();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user.create', $data);
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
        $message = 'User added!';
        
        $requestData = $request->all();


        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'user_store' => 'required',
            'user_store_image' => 'required',
            'user_slogan' => 'required',
            'user_slug' => 'required',
            'email' => 'required',
            'email_verified_at' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);
        $res = new Users;

        $res->username = $request->username;
        $res->name = $request->name;
        $res->user_store = $request->user_store;
        $res->user_store_image = $request->user_store_image;
        $res->user_slogan = $request->user_slogan;
        $res->user_slug = str_slug($request->user_store);
        $res->email = $request->email;
        $res->email_verified_at = $request->email_verified_at;
        $res->password = $request->password;
        $res->remember_token = $request->remember_token;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'User Not added!';
        }
        return redirect('admin/user')
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
        $data['user'] = User::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user.show', $data);
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
        $data['role'] = Role::all();
        $data['user'] = User::all();
        $data['category'] = Category::all();
        $data['brand'] = Brand::all();
        $data['user'] = User::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('admin.user.edit', $data);
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
        $message = 'User added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'user_store' => 'required',
            'user_store_image' => 'required',
            'user_slogan' => 'required',
            'user_slug' => 'required',
            'email' => 'required',
            'email_verified_at' => 'required',
            'password' => 'required',
            'remember_token' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->user_store = $request->user_store;
        $user->user_store_image = $request->user_store_image;
        $user->user_slogan = $request->user_slogan;
        $user->user_slug = str_slug($request->user_store);
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = $request->password;
        $user->remember_token = $request->remember_token;
        $user->save();
        $user = $user->update($requestData);
        if(!$user){
            $status = 500;
            $message = 'User Not updated!';
        }

        return redirect('admin/user')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disabled($id)
    {
        $status = 200;
        $message = 'User deleted!';
        $res = User::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User Not deleted!';
        }

        return redirect('admin/user')
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
        $message = 'User deleted!';
        $res = User::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'User Not deleted!';
        }

        return redirect('admin/user')
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
        $user = DB::query($qry);

        return $user;
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
