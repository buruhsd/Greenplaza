@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">{{__('dashboard.ubah_password') }}</h3>
</div>
<div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">{{__('dashboard.ubah_password') }} Login</h4>
            </div>
            <div class="panel-body">
                {!! Form::open([
                    'method' => 'POST',
                    'url' => ['/member/user/change_password_update'],
                    'class' => 'form-horizontal',
                    'files' => true
                ]) !!}
                    <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">{{__('dashboard.password_lama') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="old_password" class="form-control" id="input-Default">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-help-block" class="col-sm-2 control-label">{{__('dashboard.password_baru') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="new_password" class="form-control" id="input-default">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="input-help-block" class="col-sm-2 control-label">{{__('dashboard.ulangi_password') }}</label>
                        <div class="col-sm-10">
                            <input type="password" name="re_new_password" class="form-control" id="input-default">
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary">Edit</button>
            
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
        