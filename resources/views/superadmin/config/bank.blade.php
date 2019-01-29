@extends('superadmin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Greenplaza</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Configuration Greenplaza</h4>
                    <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.form_config")}} value="Choose Address" class='btn btn-success btn-sm pull-right'>
                        Add New
                    </button>
                    <br/>
                    <hr/>
                </div>
                <div class="panel-body">
                    <?php $no = 1; ?>
                    <div class="row" id="content_config">
                        @foreach($config as $item)
                            <div class="panel col-md-10 col-md-offset-1">
                                <div class="panel-body">
                                {!! Form::open(['url' => '/admin/config/update', 'files' => true, 'method' => 'POST']) !!}
                                    <div class="row">
                                        <div class="col-md-12 m-b-xs">
                                            {!! Form::label('', ucwords(str_replace('_', ' ', $item->configs_name)).' : ', ['class' => 'col-md-12 control-label']) !!}
                                            <small class="col-md-12 control-label">{!!$item->configs_note!!}</small>
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
                                                    {!! Form::textarea('configs_value', $item->configs_value, [
                                                        'class' => 'form-control', 
                                                        'id' => 'configs_value',
                                                        'rows' => 2, 
                                                        'cols' => 54,
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
</script>
@endsection
        