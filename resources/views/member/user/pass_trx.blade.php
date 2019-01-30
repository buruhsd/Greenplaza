@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Ubah Password Transaksi</h3>
</div>
<div class="panel panel-white">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::open([
                            'method' => 'POST',
                            'url' => ['/member/user/pass_trx_update'],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}
                            <div class="form-group">
                                <label for="input-Default" class="col-sm-3 control-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" name="old_password" class="form-control" id="input-Default">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-help-block" class="col-sm-3 control-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="new_password" class="form-control" id="input-default">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input-help-block" class="col-sm-3 control-label">Ulangi Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="re_new_password" class="form-control" id="input-default">
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Edit</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="col-sm-6">
                        <h3>Info</h3>
                        <p>Password default menggunakan password login anda.<br/></p>
                        <p>Reset Password <a class="btn btn-xs btn-info" href="{{route('password.request_trx')}}">disini</a>.</p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
        