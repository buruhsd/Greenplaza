@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Configuration Profil</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">User Profile</h4>
                </div>
                <div class="panel-body user-profile-panel">
                    <img src="{{asset('assets/images/profil/'.$user->user_detail->user_detail_image) }}" onerror="this.src='{{asset('assets/images/profil/nopic.png')}}'" class="user-profile-image img-circle" alt="">
                    <h4 class="text-center m-t-lg">{{$user->name}}</h4>
                    <hr>
                        {{-- <div class="col-md-12">
                            {!! Form::file('user_detail_image', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Image', 
                                'required'
                            ])!!}
                            {!! $errors->first('user_detail_image', '<p class="help-block">:message</p>') !!}
                        </div>
                    <hr> --}}
                </div>
            </div>
        </div>
        <div class="col-md-9">
        <section id="main-content">
            <section class="wrapper">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pengaturan Profil</h4>
                </div>
                <div class="panel-body">
                {!! Form::model($user, [
                    'method' => 'PATCH',
                    'url' => ['/member/user/update'],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('name') ? 'has-error' : ''}}">
                                {!! Form::label('name', 'Nama', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('name', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Name', 
                                        'disabled',
                                        'required'
                                    ])!!}
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::label('email', 'email', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('email', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'email', 
                                        'disabled',
                                        'required'
                                    ])!!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_phone') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_phone', 'Phone', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_detail_phone', $user->user_detail->user_detail_phone, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Phone', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_detail_phone', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_tlp') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_tlp', 'Telp Kantor', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_detail_tlp', $user->user_detail->user_detail_tlp, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'phone House'
                                    ])!!}
                                {!! $errors->first('user_detail_tlp', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_jk') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_jk', 'Gender', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9 text-left">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default <?php echo ($user->user_detail->user_detail_jk == 'laki-laki')?"active":"";?>">
                                            <input type="radio" name="user_detail_jk" value="laki-laki" autocomplete="off" <?php echo ($user->user_detail->user_detail_jk == 'laki-laki')?"checked":"";?>>
                                            Laki-Laki <span class="check glyphicon glyphicon-ok"></span>
                                        </label>
                                        <label class="btn btn-default <?php echo ($user->user_detail->user_detail_jk == 'perempuan')?"active":"";?>">
                                            <input type="radio" name="user_detail_jk" value="perempuan" autocomplete="off"<?php echo ($user->user_detail->user_detail_jk == 'perempuan')?"checked":"";?>>
                                            Perempuan <span class="check glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                {!! $errors->first('user_detail_jk', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_slug') ? 'has-error' : ''}}">
                                {!! Form::label('user_slug', 'Slug', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_slug', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Slug', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_slug', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div> --}}
                            <?php $store_status = ($user->user_store !== null && $user->user_store !== "")?'disabled':'';?>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_store') ? 'has-error' : ''}}">
                                {!! Form::label('user_store', 'Toko', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_store', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Window', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_store', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    <img class="h100" src="{{asset('assets/images/bg_etalase/'.$user->user_store_image) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_store_image') ? 'has-error' : ''}}">
                                {!! Form::label('user_store_image', 'Image', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::file('user_store_image', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Image', 
                                        'required'
                                    ])!!}
                                    {!! $errors->first('user_store_image', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-sm">
                            {!! Form::label('user_slogan', 'Slogan', ['class' => 'col-md-12']) !!}
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_slogan') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::textarea('user_slogan', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Slogan',
                                        'rows' => '3', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_slogan', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::label('user_detail_province', 'Provice', ['class' => 'col-md-12']) !!}
                                    <div class="form-group {{ $errors->has('user_detail_province') ? 'has-error' : ''}}">
                                        <div class="col-md-12">
                                            <select name='user_detail_province' id='user_detail_province' class="form-control" onchange="get_city(this.value);">
                                            </select>
                                            {!! $errors->first('user_detail_province', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('user_detail_city', 'City', ['class' => 'col-md-12']) !!}
                                    <div class="form-group {{ $errors->has('user_detail_city') ? 'has-error' : ''}}">
                                        <div class="col-md-12">
                                            <select name='user_detail_city' id='user_detail_city' class="form-control" onchange="get_subdistrict(this.value);">
                                                {{-- @foreach($city as $item)
                                                    <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                                                @endforeach --}}
                                            </select>
                                            {!! $errors->first('user_detail_city', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('user_detail_subdist', 'Subdistrict', ['class' => 'col-md-12']) !!}
                                    <div class="form-group {{ $errors->has('user_detail_subdist') ? 'has-error' : ''}}">
                                        <div class="col-md-12">
                                            <select name='user_detail_subdist' id='user_detail_subdist' class="form-control">
                                                {{-- @foreach($subdistrict as $item)
                                                    <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                                                @endforeach --}}
                                            </select>
                                            {!! $errors->first('user_detail_subdist', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    {!! Form::label('user_detail_pos', 'Postal Code', ['class' => 'col-md-12']) !!}
                                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_pos') ? 'has-error' : ''}}">
                                        <div class="col-md-12">
                                            {!! Form::text('user_detail_pos', $user->user_detail->user_detail_pos, [
                                                'class' => 'form-control', 
                                                'placeholder' => 'Postal Code', 
                                                'required'
                                            ])!!}
                                        {!! $errors->first('user_detail_pos', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::label('user_detail_address', 'Address', ['class' => 'col-md-12']) !!}
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_address') ? 'has-error' : ''}}">
                                <div class="col-md-12">
                                    {!! Form::textarea('user_detail_address', $user->user_detail->user_detail_address, [
                                      'class' => 'form-control', 
                                      'placeholder' => 'Address', 
                                      'rows' => '5', 
                                      'cols' => '5', 
                                    ])!!}
                                    {!! $errors->first('user_detail_address', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_name') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_bank_id', 'Bank Name', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    <select name='user_detail_bank_id' class="form-control">
                                        @foreach($cfg_bank as $item)
                                            <option value='{{$item->id}}' <?php if($user->user_detail->user_detail_bank_id == $item->id){echo "selected";}?>>{{$item->bank_name}}</option>
                                        @endforeach
                                    </select>
                                {!! $errors->first('user_detail_bank_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_owner') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_bank_owner', 'Owner', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_detail_bank_owner', $user->user_detail->user_detail_bank_owner, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Owner', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_detail_bank_owner', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_no') ? 'has-error' : ''}}">
                                {!! Form::label('user_detail_bank_no', 'Account number', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('user_detail_bank_no', $user->user_detail->user_detail_bank_no, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Account number', 
                                        'required'
                                    ])!!}
                                {!! $errors->first('user_detail_bank_no', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-white col-md-12 no-border">
                        <div class="panel-body">
                            <button type="submit" class="btn btn-primary mb-2">Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
          </section>
        </section>
        </div><!-- Row -->
    </div>
@endsection