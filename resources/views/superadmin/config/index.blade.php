@extends('superadmin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Greenplaza</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            {{-- <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" class="form-control" placeholder="username" name="username" value="{!! (!empty($_GET['username']))?$_GET['username']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        <option value="wait" {!! (!empty($_GET['status']) && $_GET['status'] == "wait")?"selected":"" !!}>Wait</option>
                        <option value="active" {!! (!empty($_GET['status']) && $_GET['status'] == "active")?"selected":"" !!}>Active</option>
                        <option value="block" {!! (!empty($_GET['status']) && $_GET['status'] == "block")?"selected":"" !!}>Block</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div> --}}
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Configuration Greenplaza</h4>
                    <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.form_config")}} value="Choose Address" class='btn btn-success btn-sm pull-right'>
                        Add New
                    </button>
                    {{-- <a href="{{ url('admin/user/create') }}" class="btn btn-success btn-sm pull-right">Add New</a> --}}
                    <br/>
                    <hr/>
                </div>
                <div class="panel-body">
                    <?php $no = 1; ?>
                    <div class="row" id="content_config">
                        @foreach($config as $item)
                            <div class="panel panel-success col-md-5 col-md-offset-1">
                                <div class="panel-body">
                                {!! Form::open(['url' => '/admin/config/update', 'files' => true, 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-md-12 m-b-xs">
                                        {!! Form::label('', ucwords(str_replace('_', ' ', $item->configs_name)).' : ', ['class' => 'col-md-12 control-label']) !!}
                                        </div>
                                        <div class="col-md-12 m-b-xs hidden">
                                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('configs_name') ? 'has-error' : ''}}">
                                                <div class="col-md-9">
                                                    {!! Form::text('configs_name', $item->configs_name, [
                                                        'class' => 'form-control', 
                                                        'placeholder' => 'Unit',  
                                                        'required'
                                                    ])!!}
                                                {!! $errors->first('configs_name', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-b-xs">
                                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('configs_value') ? 'has-error' : ''}}">
                                                <div class="col-md-9">
                                                    {!! Form::text('configs_value', $item->configs_value, [
                                                        'class' => 'form-control', 
                                                        'placeholder' => 'Unit',  
                                                        'required'
                                                    ])!!}
                                                {!! $errors->first('configs_value', '<p class="help-block">:message</p>') !!}
                                                </div>
                                                <div class="col-md-3">
                                                    <a onclick="update_config(this, '{{$item->id}}');" class="btn btn-primary">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                        {!! Form::label('produk_unit', ' ', ['class' => 'col-md-3 control-label']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="panel panel-white col-md-12 no-border">
                        <div class="panel-body">
                            <button type="submit" class="btn btn-success mb-2">Save</button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
    function get_content(){
        $.ajax({
            type: "POST", // or post?
            url: "{{route("localapi.content.config_content")}}", // change as needed
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
            url: "{{url("admin/config/update")}}/"+val, // change as needed
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
            url: "{{url("admin/config/store")}}", // change as needed
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
@endsection
        