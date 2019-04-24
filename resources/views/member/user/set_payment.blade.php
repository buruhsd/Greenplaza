@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Masedi Poin</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">
                        {{-- Configuration Masedi Poin --}}
                    </h4>
                    {{-- <hr/> --}}
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/member/user/set_payment', 'files' => true, 'method' => 'POST']) !!}
                        <div class="row">
                            <div class="col-md-12 m-b-xs">
                                <div class="form-group mx-sm-3 mb-2 {{ $errors->has($data->config_name) ? 'has-error' : ''}}">
                                    {!! Form::label('reff_code', ucwords(str_replace('_', ' ', $data->config_name)).' : ', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-10 input-group">
                                        {!! Form::text($data->config_name, $data->config_value, [
                                            'class' => 'form-control', 
                                            'id' => 'user_poin', 
                                            'placeholder' => 'Percen Poin'
                                        ])!!}
                                        <span class="input-group-btn">
                                            <a type="button" class="btn btn-default image-preview-clear">
                                                %
                                            </a>
                                        </span>
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-success image-preview-clear">
                                                Simpan
                                            </button>
                                        </span>
                                    </div>
                                    <br/>
                                    <span class="text-info">
                                        <pre>{{$data->config_note}}</pre>
                                    </span>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            </div>
            </div>
        </div><!-- Row -->
    </div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
        