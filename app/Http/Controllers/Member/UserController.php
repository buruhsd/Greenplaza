<?php

namespace App\Http\Controllers\Member;

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
use Auth;


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
        $where = "1";
        $data['user'] = User::whereRaw($where)->where('id', Auth::id())->first();
        // dd($data['user']);
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.user.index', $data);
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
        return view('member.user.create', $data);
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
        return redirect('member/user')
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
        return view('member.user.show', $data);
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
        return view('member.user.edit', $data);
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

        return redirect('member/user')
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

        return redirect('member/user')
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

        return redirect('member/user')
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
                    <script type="text/javascript">
                        $(function(){
                            var rows, row;
                            get_province();
                        });
                        function get_province(){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url('localapi/content/get_province', 0);?>", // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_province').empty();
                                    $('#user_detail_province').html(rows);
                                },
                                success: function(data) {
                                    if (data) {
                                        $('#user_detail_province').empty();
                                        $.each( data.province, function(i, o){
                                            row = "<option value="+o.province_id+">"+o.province+"</option>";
                                            $('#user_detail_province').append(row);
                                            if(i == 0){
                                                get_city(o.province_id);
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_city(id = 0){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_city"); ?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_city').empty();
                                    $('#user_detail_city').html(rows);
                                },
                                success: function(data) {
                                    if (data) {
                                        $('#user_detail_city').empty();
                                        $.each( data.city, function(i, o){
                                            row = "<option value="+o.city_id+">"+o.city_name+"</option>";
                                            $('#user_detail_city').append(row);
                                            if(i == 0){
                                                get_subdistrict(o.city_id);
                                            }
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                        function get_subdistrict(id){
                            $.ajax({
                                type: "GET", // or post?
                                url: "<?php echo url("localapi/content/get_subdistrict");?>/"+id, // change as needed
                                beforeSend: function(){
                                    rows = "<option>Loading...</option>";
                                    $('#user_detail_subdist').empty();
                                    $('#user_detail_subdist').html(rows);
                                },
                                success: function(data) {
                                    if (data) {
                                        $('#user_detail_subdist').empty();
                                        $.each( data, function(i, o){
                                            row = "<option value="+o.subdistrict_id+">"+o.subdistrict_name+"</option>";
                                            $('#user_detail_subdist').append(row);
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Layanan Tidak Tersedia",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    // $("#btn-choose-shipment").val(text);
                                },
                                error: function(xhr, textStatus) {
                                    swal({
                                        type: "error",
                                        title: "failed",   
                                        text: "Layanan Tidak Tersedia",   
                                        showConfirmButton: false ,
                                        showCloseButton: true,
                                        footer: ''
                                    });
                                    $("#btn-choose-shipment").val(text);
                                }
                            });
                        }
                    </script>
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
