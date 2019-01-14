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
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.add_page')}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Judul Page</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="page_judul">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Role_id</label>
                        <div class="col-sm-10">
                            <select id="" type="text" name="page_role_id" class="form-control">
                              <option value="">--Select Role--</option>
                              <option value="2">Admin</option>
                              <option value="3">Member</option>
                            </select>
                        </div>
                    </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Kategori</label>
                          <div class="col-sm-10">
                              <select id="select-list-buy" align="left"  class="form-control" name="page_kategori">
                                <option value="seller">Seller</option>
                                <option value="member">Member</option>
                                <option value="greenplaza">Greenplaza</option>
                                <option value="" selected>Select Category Roles</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Isi Page</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="page_text" placeholder="" rows="10" id="article-ckeditor"></textarea>
                          </div>
                      </div>
                      <center><button type="submit" class="btn btn-primary" style="width: 40%">Simpan</button></center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->
<script>
        CKEDITOR.replace( 'article-ckeditor', {
            height: 400,
            
        } );

        function myFunction(x) {
            var copyText = document.getElementById(x);
            copyText.select();
            document.execCommand("Copy");
        } 
        </script>   
@endsection