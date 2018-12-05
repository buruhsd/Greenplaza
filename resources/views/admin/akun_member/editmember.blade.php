@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Edit Profile</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <a href="{{route('admin.user.listmember')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.user.editmember_data', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">UserName</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" value="{{$users->username}}" style="color: #A9A9A9" name="username">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" value="{{$users->name}}" style="color: #A9A9A9" name="name">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">User Store</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" value="{{$users->user_store}}" style="color: #A9A9A9" name="user_store">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Image File</label>
                          <div class="col-sm-10">
                              <input type="file" name="gambar">
                          </div>
                      </div>         
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">User Slogan</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" value="{{$users->user_slogan}}" style="color: #A9A9A9" name="user_slogan">
                          </div>
                      </div>
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
                      <center><button type="submit" class="btn btn-primary" style="width: 50%">Submit</button></center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection