<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Bank;
use App\Models\Shipment;
use App\Models\User_shipment;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use FunctionLib;

class UserController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function profil(Request $request)
    {
        $data['cfg_bank'] = Bank::all();
        $data['user'] = User::findOrFail(Auth::id());

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.index', $data);
    }

    /**
     * alamat kirim.
     *
     */
    public function buyer_address(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.buyer_address', $data);
    }

    /**
     * update password page.
     *
     */
    public function set_shipment(Request $request)
    {
        $data['shipment'] = Shipment::where('shipment_is_usable', 1)->get();
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.set_shipment', $data);
    }

    /**
     * update password process
     * $request
     */
    public function set_shipment_update(Request $request)
    {
        $status = 200;
        $message = 'Shipment updated!';
        $requestData = $request->all();
        $this->validate($request, [
            'user_shipment_shipment_id' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        $id = Auth::id();
        $input = $requestData['user_shipment_shipment_id'];
        $usershipment = $user->user_shipment()->pluck('user_shipment_shipment_id')->toArray();
        // delete if uncheck
        array_walk($usershipment, function($value) use ($input, $id) {
            if(!in_array((integer)$value, $input)){
                User_shipment::where('user_shipment_shipment_id', $value)
                    ->where('user_shipment_user_id', $id)
                    ->delete();
            }
        });
        // insert if check and not exist
        array_walk($input, function($value) use ($usershipment, $id) {
            if(!in_array((integer)$value, $usershipment)){
                $user_shipment = new User_shipment;
                $user_shipment->user_shipment_user_id = $id;
                $user_shipment->user_shipment_shipment_id = $value;
                $user_shipment->save();
            }
        });
        return redirect('member/user/set_shipment')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * update password page.
     *
     */
    public function upload_foto_profil(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.upload_foto_profil', $data);
    }

    /**
     * update password process
     * $request
     */
    public function upload_foto_profil_update(Request $request)
    {
        $status = 200;
        $message = 'User added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_detail_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());
        $userdetail = $user->user_detail()->first();
        // upload
        if ($request->hasFile('user_detail_image')){
            $file = $request->file('user_detail_image');
            $path = public_path('assets/images/profil');
            $field = $user->user_detail->user_detail_image;
            $imagename = FunctionLib::doUpload($file, $path, $field);
            $user->user_detail->user_detail_image = $imagename;
        }
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'Address Not updated!';
        }
        return redirect('member/upload_foto_profil')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * update password page.
     *
     */
    public function upload_scan_npwp(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.upload_scan_npwp', $data);
    }

    /**
     * update password process
     * $request
     */
    public function upload_scan_npwp_update(Request $request)
    {
        $status = 200;
        $message = 'NPWP added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_detail_npwp_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());
        $userdetail = $user->user_detail()->first();
        // upload
        if ($request->hasFile('user_detail_npwp_image')){
            $file = $request->file('user_detail_npwp_image');
            $path = public_path('assets/images/npwp');
            $field = $user->user_detail->user_detail_npwp_image;
            $imagename = FunctionLib::doUpload($file, $path, $field);
            $user->user_detail->user_detail_npwp_image = $imagename;
        }
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'NPWP Not updated!';
        }
        return redirect('member/upload_scan_npwp')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * update password page.
     *
     */
    public function upload_siup(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.upload_siup', $data);
    }

    /**
     * update password process
     * $request
     */
    public function upload_siup_update(Request $request)
    {
        $status = 200;
        $message = 'SIUP Updated!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_detail_siup_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail(Auth::id());
        $userdetail = $user->user_detail()->first();
        // upload
        if ($request->hasFile('user_detail_siup_image')){
            $file = $request->file('user_detail_siup_image');
            $path = public_path('assets/images/siup');
            $field = $user->user_detail->user_detail_siup_image;
            $imagename = FunctionLib::doUpload($file, $path, $field);
            $user->user_detail->user_detail_siup_image = $imagename;
        }
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'SIUP Not updated!';
        }
        return redirect('member/upload_siup')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * update password page.
     *
     */
    public function seller_address(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.seller_address', $data);
    }

    /**
     * update password process
     * $request
     */
    public function seller_address_update(Request $request)
    {
        $status = 200;
        $message = 'User added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_detail_province' => 'required',
            'user_detail_city' => 'required',
            'user_detail_subdist' => 'required',
            'user_detail_pos' => 'required',
            'user_detail_address' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        $userdetail = $user->user_detail()->first();
        $user->user_detail->user_detail_province = $request->user_detail_province;
        $user->user_detail->user_detail_city = $request->user_detail_city;
        $user->user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user->user_detail->user_detail_pos = $request->user_detail_pos;
        $user->user_detail->user_detail_address = $request->user_detail_address;
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'Address Not updated!';
        }
        return redirect('member/seller_address')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     * update password page.
     *
     */
    public function change_password(Request $request)
    {
        $data['user'] = User::findOrFail(Auth::id());
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.user.change_password', $data);
    }

    /**
     * update password process
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function change_password_update(Request $request)
    {
        $status = 200;
        $message = 'Password Has Been updated!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        if (!Hash::check($request->old_password, $user->password)) {
            $status = 500;
            $message = 'Password does Not Match!';
            return redirect('member/change_password')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        if ($request->new_password !== $request->re_new_password) {
            $status = 500;
            $message = 'New Password does Not Match!';
            return redirect('member/change_password')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        $password = $request->new_password;
        $user->password = Hash::make($password);
        $user->setRememberToken(Str::random(60));
        $user->save();
        if(!$user){
            $status = 500;
            $message = 'Password Not updated!';
        }
        return redirect('member/change_password')
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
                $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $status = 200;
        $message = 'User added!';
        
        $requestData = $request->all();
        
        $this->validate($request, [
            'user_store' => 'required',
            'user_slogan' => 'required',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->user_store = $request->user_store;
        // upload
        if ($request->hasFile('user_store_image')){
            $file = $request->file('user_store_image');
            $path = public_path('assets/images/bg_etalase');
            $field = $user->user_store_image;
            $imagename = FunctionLib::doUpload($file, $path, $field);
            $user->user_store_image = $imagename;
        }
        $user->user_slogan = $request->user_slogan;
        $user->user_slug = str_slug($request->user_store);
        $user->save();
        if(!$user){
            $status = 500;
            $message = 'User Not updated!';
                return redirect('member/user')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
        
        $userdetail = $user->user_detail()->first();
        // $user->user_detail->user_detail_phone = $request->user_detail_phone;
        // upload
        if ($request->hasFile('user_detail_image')){
            $file = $request->file('user_detail_image');
            $path = public_path('assets/images/profil');
            $field = $user->user_detail->user_detail_image;
            $imagename = FunctionLib::doUpload($file, $path, $field);
            $user->user_detail->user_detail_image = $imagename;
        }
        $user->user_detail->user_detail_tlp = $request->user_detail_tlp;
        $user->user_detail->user_detail_jk = $request->user_detail_jk;
        $user->user_detail->user_detail_province = $request->user_detail_province;
        $user->user_detail->user_detail_city = $request->user_detail_city;
        $user->user_detail->user_detail_subdist = $request->user_detail_subdist;
        $user->user_detail->user_detail_pos = $request->user_detail_pos;
        $user->user_detail->user_detail_address = $request->user_detail_address;
        $user->user_detail->user_detail_bank_id = $request->user_detail_bank_id;
        $user->user_detail->user_detail_bank_name = Bank::whereId($request->user_detail_bank_id)->pluck('bank_kode')[0];
        $user->user_detail->user_detail_bank_owner = $request->user_detail_bank_owner;
        $user->user_detail->user_detail_bank_no = $request->user_detail_bank_no;
        $userdetail = $user->user_detail;
        $userdetail->save();
        if(!$userdetail){
            $status = 500;
            $message = 'Detail User Not updated!';
                return redirect('member/user')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }

        return redirect('member/profil')
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
            case 'profil':
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
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_province;?>");
                                    if (data) {
                                        $('#user_detail_province').empty();
                                        $.each( data.province, function(i, o){
                                            $check = (o.province_id == id)?"selected":"";
                                            row = "<option value="+o.province_id+" "+$check+">"+
                                                o.province+"</option>";
                                            $('#user_detail_province').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_city(id);
                                                }else{
                                                    get_city(o.province_id);
                                                }
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
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_city;?>");
                                    if (data) {
                                        $('#user_detail_city').empty();
                                        $.each( data.city, function(i, o){
                                            $check = (o.city_id == id)?"selected":"";
                                            row = "<option value="+o.city_id+" "+$check+">"+o.city_name+"</option>";
                                            $('#user_detail_city').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_subdistrict(id);
                                                }else{
                                                    get_subdistrict(o.city_id);
                                                }
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
                                            $check = (o.subdistrict_id == parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_subdist;?>"))?"selected":"";
                                            row = "<option value="+o.subdistrict_id+" "+$check+">"+o.subdistrict_name+"</option>";
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
            case 'buyer_address':
            case 'seller_address':
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
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_province;?>");
                                    if (data) {
                                        $('#user_detail_province').empty();
                                        $.each( data.province, function(i, o){
                                            $check = (o.province_id == id)?"selected":"";
                                            row = "<option value="+o.province_id+" "+$check+">"+
                                                o.province+"</option>";
                                            $('#user_detail_province').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_city(id);
                                                }else{
                                                    get_city(o.province_id);
                                                }
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
                                    var id = parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_city;?>");
                                    if (data) {
                                        $('#user_detail_city').empty();
                                        $.each( data.city, function(i, o){
                                            $check = (o.city_id == id)?"selected":"";
                                            row = "<option value="+o.city_id+" "+$check+">"+o.city_name+"</option>";
                                            $('#user_detail_city').append(row);
                                            if(i == 0){
                                                if(id !== null || id !== 0){
                                                    get_subdistrict(id);
                                                }else{
                                                    get_subdistrict(o.city_id);
                                                }
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
                                            $check = (o.subdistrict_id == parseInt("<?php echo Auth::user()->user_detail()->first()->user_detail_subdist;?>"))?"selected":"";
                                            row = "<option value="+o.subdistrict_id+" "+$check+">"+o.subdistrict_name+"</option>";
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
            case 'upload_foto_profil':
            case 'upload_scan_npwp':
            case 'upload_siup':
                ?>
                    <script type="text/javascript">
                        $(document).on('click', '#close-preview', function(){ 
                            $(this).parents(".parent-img").find('.image-preview').popover('hide');
                            // Hover befor close the preview
                            $('.image-preview').hover(
                                function () {
                                   $(this).popover('show');
                                }, 
                                 function () {
                                   $(this).popover('hide');
                                }
                            );    
                        });

                        $(function() {
                            // Create the close button
                            var closebtn = $('<button/>', {
                                type:"button",
                                text: 'x',
                                id: 'close-preview',
                                style: 'font-size: initial;',
                            });
                            closebtn.attr("class","close pull-right");
                            // Set the popover default content
                            $('.image-preview').popover({
                                trigger:'manual',
                                html:true,
                                title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                                content: "There's no image",
                                placement:'bottom'
                            });
                            // Clear event
                            $('.image-preview-clear').click(function(){
                                $(this).parents(".parent-img").find('.image-preview').attr("data-content","").popover('hide');
                                $(this).parents(".parent-img").find('.image-preview-filename').val("");
                                $(this).parents(".parent-img").find('.image-preview-clear').hide();
                                $(this).parents(".parent-img").find('.image-preview-input input:file').val("");
                                $(this).parents(".parent-img").find(".image-preview-input-title").text("Browse"); 
                            }); 
                            // Create the preview image
                            $(".image-preview-input input:file").change(function (){     
                                var img = $('<img/>', {
                                    id: 'dynamic',
                                    width:250,
                                    height:200
                                });      
                                var file = this.files[0];
                                var reader = new FileReader();
                                var x = $(this);
                                // Set preview image into the popover data-content
                                reader.onload = function (e) {
                                    $(x).parents(".parent-img").find(".image-preview-input-title").text("Change");
                                    $(x).parents(".parent-img").find(".image-preview-clear").show();
                                    $(x).parents(".parent-img").find(".image-preview-filename").val(file.name);
                                    img.attr('src', e.target.result);
                                    $(x).parents(".parent-img").find(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                                }        
                                reader.readAsDataURL(file);
                            });  
                        });
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
