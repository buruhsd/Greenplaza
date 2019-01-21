@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
               <!-- Page Inner -->
<div id="main-wrapper">
    <div class="page-title">
        <h3 class="breadcrumb-header">Alamat seller</h3>
    </div>
    <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Ubah alamat seller</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => ['/member/user/seller_address_update'],
                        'class' => 'wizardForm',
                        'files' => false
                    ]) !!}
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="tab1">
                                <div class="row m-b-lg">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group  col-md-3">
                                                <label for="user_detail_province">Provinsi</label>
                                                <select name='user_detail_province' id='user_detail_province' class="form-control" onchange="get_city(this.value);">
                                                </select>
                                                {!! $errors->first('user_detail_province', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label for="user_detail_city">Kota/Kab</label>
                                            <select name='user_detail_city' id='user_detail_city' class="form-control" onchange="get_subdistrict(this.value);">
                                            </select>
                                            {!! $errors->first('user_detail_city', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <label for="user_detail_subdist">Kecamatan</label>
                                                <select name='user_detail_subdist' id='user_detail_subdist' class="form-control">
                                                </select>
                                                {!! $errors->first('user_detail_subdist', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="user_detail_pos">Kode Pos</label>
                                                {!! Form::text('user_detail_pos', $user->user_detail->user_detail_pos, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Postal Code', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_detail_pos', '<p class="help-block">:message</p>') !!}
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="user_detail_address">Alamat</label>
                                                {!! Form::textarea('user_detail_address', $user->user_detail->user_detail_address, [
                                                  'class' => 'form-control', 
                                                  'placeholder' => 'Address', 
                                                  'rows' => '4'
                                                ])!!}
                                                {!! $errors->first('user_detail_address', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection