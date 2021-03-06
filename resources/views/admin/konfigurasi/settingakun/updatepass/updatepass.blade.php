@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Update Password Admin</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.change_password_update_admin')}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-3 control-label">Password Lama</label>
                          <div class="col-sm-9">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="old_password">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-3 control-label">Password Baru</label>
                          <div class="col-sm-9">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="new_password">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-3 control-label">Ketik Ulang Password</label>
                          <div class="col-sm-9">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="re_new_password">
                          </div>
                      </div>
                      <div class="col-sm-9 col-sm-offset-3">
                          <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                      <div class="col-sm-9">
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection