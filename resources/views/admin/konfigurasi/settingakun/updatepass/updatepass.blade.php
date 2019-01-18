@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Update Password Superadmin</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.changepass', $users->id)}})}}" enctype = "multipart/form-data">
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
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="password">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-3 control-label">Ketik Ulang Password</label>
                          <div class="col-sm-9">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="re_password">
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