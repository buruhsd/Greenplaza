@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header"><i class="fa fa-check-square-o"></i>Setting Harga Iklan</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Iklan Baris (Rp.)</label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-danger">Update</button>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Iklan Banner (Rp.)</label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-danger">Update</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection