@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Tambah Page</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <a href="{{route('admin.konfigurasi.pagelist')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Judul Page</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Kategori</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Status</label>
                          <div class="col-sm-10">
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox">Disable
                                  </label>
                              </div>
                              <div class="checkbox">
                                  <label>
                                      <input type="checkbox" checked>Active
                                  </label>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Isi Page</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="page_text" placeholder="" rows="10"></textarea>
                          </div>
                      </div>
                      <center><button type="submit" class="btn btn-primary" style="width: 40%">Simpan</button></center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection