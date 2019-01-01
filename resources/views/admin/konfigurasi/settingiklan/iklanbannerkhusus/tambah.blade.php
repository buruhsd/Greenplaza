@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Create Iklan Banner</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <a href="{{route('admin.konfigurasi.iklanbanner')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Nama Iklan</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Pilih Paket</label>
                          <div class="col-sm-10">
                              <select id="select-list-buy" align="left"  class="form-control">
                                <option value="">Banner 2</option>
                                <option value="">Banner 3</option>
                                <option value="">Banner 4</option>
                                <option value="">Banner 5</option>
                                <option value="">Banner 6</option>
                                <option value="">Banner 10</option>
                                <option value="">Slider</option>
                                <option value="" selected>--Pilih Paket--</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Nama Pemesan</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Gambar Iklan</label>
                          <div class="col-sm-10">
                              <input type="file" name="">
                          </div>
                      </div>     
                      <center>
                        <button type="submit" class="btn btn-success" style="width: 40%">Reset</button>
                        <button type="submit" class="btn btn-primary" style="width: 40%">Simpan</button>
                      </center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection