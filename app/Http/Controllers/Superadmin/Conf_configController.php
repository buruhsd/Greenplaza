<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Conf_config;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use FunctionLib;


class Conf_configController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'conf_configs';

    /**
    * @param
    * @return
    */
    public function bank(Request $request)
    {
        $arr = FunctionLib::config_arr('bank');
        $data['config'] = Conf_config::whereIn('configs_name', $arr)
                ->paginate($this->perPage);
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('superadmin.config.bank', $data);
    }

    /**
    * @param
    * @return
    */
    public function profil(Request $request)
    {
        $arr = FunctionLib::config_arr('profil');
        // $arr = FunctionLib::config_arr('profil')->toArray();
        // $arr = array_merge($arr, ['bank_greenplaza']);
        $data['config'] = Conf_config::whereIn('configs_name', $arr)
                ->paginate($this->perPage);
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('superadmin.config.index', $data);
    }

    /**
    * @param
    * @return
    */
    public function transaction(Request $request)
    {
        $arr = FunctionLib::config_arr('transaksi');
        $data['config'] = Conf_config::whereIn('configs_name', $arr)
                ->paginate($this->perPage);
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('superadmin.config.index', $data);
    }

    /**
    * @param
    * @return
    */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['config'] = Conf_config::where('configs_status', 'LIKE', "%$keyword%")
                ->orWhere('configs_name', 'LIKE', "%$keyword%")
                ->orWhere('configs_value', 'LIKE', "%$keyword%")
                ->orWhere('configs_note', 'LIKE', "%$keyword%")
                ->paginate($this->perPage);
        } else {
            $data['config'] = Conf_config::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('superadmin.config.index', $data);
    }

    /**
    * @param
    * @return
    */
    public function create()
    {
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.create', $data);
    }

    /**
    * @param
    * @return
    */
    public function store(Request $request)
    {
        $status = 200;
        $message = 'Config added!';
        $this->validate($request, [
			'configs_name' => 'required',
			'configs_value' => 'required'
		]);
        $requestData = $request->all();
        
        $res = Conf_config::create($requestData);
        if(!$res){
            $status = 500;
            $message = 'Config Not added!';
        }
        if($request->ajax()){
            return response()->json(['flash_status'=>$status, 'flash_message'=>$message]);
        }
        return redirect('superadmin/conf_config')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $id
    * @return
    */
    public function show($id)
    {
        $data['conf_config'] = Conf_config::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.show', $data);
    }

    /**
    * @param $id
    * @return
    */
    public function edit($id)
    {
        $data['conf_config'] = Conf_config::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('superadmin.config.edit', $data);
    }

    /**
    * @param $id
    * @return
    */
    public function update(Request $request, $id)
    {
        $status = 200;
        $message = 'Config Updated!';
        $this->validate($request, [
			'configs_name' => 'required',
			'configs_value' => 'required'
		]);
        $requestData = $request->all();
        $conf_config = Conf_config::findOrFail($id);
        $res = $conf_config->update($requestData);
        if(!$res){
            $status = 500;
            $message = 'Config Not updated!';
        }

        if($request->ajax()){
            return response()->json(['flash_status'=>$status, 'flash_message'=>$message]);
        }
        return redirect('superadmin/config')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $id
    * @return
    */
    public function destroy($id)
    {
        $status = 200;
        $message = 'conf_config deleted!';
        $res = Conf_config::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'conf_config Not deleted!';
        }

        return redirect('superadmin/config')
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
        $conf_config = DB::query($qry);

        return $conf_config;
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
            case 'bank':
                ?>
                    <script type="text/javascript">
                        function search(val){
                            $('#status').val(val);
                            $('#src').submit();
                        }
                        function get_content(){
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo route("localapi.content.config_content");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
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
                                }
                            });
                        }
                        function update_config(e, val=0){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/update");?>/"+val, // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Save');
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
                                    $(e).html('Save');
                                }
                            });
                        }
                        function store_config(e){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/store");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                        location.reload();
                                        // $('#content_config').empty();
                                        // get_content();
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Add');
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
                                    $(e).html('Add');
                                }
                            });
                        }
                    </script>
                <?php
                break;
            case 'profil':
                ?>
                    <script type="text/javascript">
                        function search(val){
                            $('#status').val(val);
                            $('#src').submit();
                        }
                        function get_content(){
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo route("localapi.content.config_content");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
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
                                }
                            });
                        }
                        function update_config(e, val=0){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/update");?>/"+val, // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Save');
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
                                    $(e).html('Save');
                                }
                            });
                        }
                        function store_config(e){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/store");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                        location.reload();
                                        // $('#content_config').empty();
                                        // get_content();
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Add');
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
                                    $(e).html('Add');
                                }
                            });
                        }
                        CKEDITOR.replace( 'configs_name' );
                    </script>
                <?php
                break;
            case 'transaction':
                ?>
                    <script type="text/javascript">
                        function search(val){
                            $('#status').val(val);
                            $('#src').submit();
                        }
                        function get_content(){
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo route("localapi.content.config_content");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
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
                                }
                            });
                        }
                        function update_config(e, val=0){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/update");?>/"+val, // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Save');
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
                                    $(e).html('Save');
                                }
                            });
                        }
                        function store_config(e){
                            var form = e.closest("form");
                            $.ajax({
                                type: "POST", // or post?
                                url: "<?php echo url("admin/config/store");?>", // change as needed
                                data: $(form).serialize(), // change as needed
                                beforeSend: function(){
                                    $(e).html('loading...');
                                },
                                success: function(data) {
                                    if (data) {
                                        var status = (data.flash_status == 200)?'success':'error';
                                        var status_type = (data.flash_status == 200)?'Success':'Failed';
                                        swal({   
                                            type: status,
                                            title: status_type,
                                            text: data.flash_message,   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                        location.reload();
                                        // $('#content_config').empty();
                                        // get_content();
                                    } else {
                                        swal({   
                                            type: "error",
                                            title: "failed",   
                                            text: "Update Failed",   
                                            showConfirmButton: false ,
                                            showCloseButton: true,
                                            footer: ''
                                        });
                                    }
                                    $(e).html('Add');
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
                                    $(e).html('Add');
                                }
                            });
                        }
                        CKEDITOR.replace( 'configs_name' );
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
