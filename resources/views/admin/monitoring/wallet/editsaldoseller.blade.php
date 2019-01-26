@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title  pull_right">
    <div class="col-md-12">
      <div class="col-md-6">
      <h3 class="breadcrumb-header"></i>Edit Saldo Seller</h3>
    </div>
    <div class="col-md-6">
      <a href="{{route('admin.monitoring.wallet_sellerlist')}}"><button class="btn btn-warning btn-addon pull-right"><i class="fa fa-spin fa-refresh"></i> Kembali</button></a>
    </div>
      @include('layouts._flash')
    </div>
  </div>
  <div class="col-md-12">
  <div id="main-wrapper">
    <div class="row">
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.editsaldoseller_cw', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <p>Saldo CW</p>
                      <div class="form-group">
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="input-Default" value="{{$cw->wallet_ballance}}" name="wallet_ballance">
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.editsaldoseller_rw', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <p>Saldo RW</p>
                      <div class="form-group">
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="input-Default" value="{{$rw->wallet_ballance}}" name="wallet_ballance">
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
  </div>


  <div id="main-wrapper">
    <div class="row">
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.editsaldoseller_transaksi', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <p>Saldo Transaksi</p>
                      <div class="form-group">
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="input-Default" value="{{$transaksi->wallet_ballance}}" name="wallet_ballance">
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.editsaldoseller_iklan', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <p>Saldo Iklan</p>
                      <div class="form-group">
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="input-Default" value="{{$iklan->wallet_ballance}}" name="wallet_ballance">
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" class="btn btn-success btn-xs" style="width: 100%">Update Saldo</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->

  <div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.monitoring.editsaldoseller_pincode', $users->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <p>Saldo Pincode</p>
                      <div class="form-group">
                          <div class="col-md-9">
                              <input type="text" class="form-control" id="input-Default" value="{{$pincode->wallet_ballance}}" name="wallet_ballance">
                          </div>
                          <div class="col-sm-3">
                              <button type="submit" class="btn btn-success" style="width: 100%">Update Saldo</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!-- Main Wrapper -->
</div>
@endsection