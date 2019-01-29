@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Change Password Member</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <a href="{{route('admin.dasboardmember')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.needapproval.password_member', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Password Baru</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="value">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Ketik Ulang Password</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" id="input-Default" style="color: #A9A9A9" name="password">
                          </div>
                      </div>
                      <center><button type="submit" class="btn btn-success" style="width: 50%">Reset Password</button></center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection