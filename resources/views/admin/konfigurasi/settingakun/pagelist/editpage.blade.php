@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Edit Page</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
              <a href="{{route('admin.konfigurasi.pagelist')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
              <div class="col-lg-12">
            </div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.edit_page_add', $page->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Judul Page</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="page_judul" value="{{$page->page_judul}}">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="input-Default" class="col-sm-2 control-label">Page Role_id</label>
                        <div class="col-sm-10">
                            <select id="" type="text" name="page_role_id" class="form-control">
                              @if ($page->page_role_id == 2)
                              <option value="2" selected>Admin</option>
                              @elseif ($page->page_role_id == 3)
                              <option value="3" selected>Member</option>
                              @endif
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
                                <option value="{{$page->page_kategori}}" selected>{{$page->page_kategori}}</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Isi Page</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="page_text" placeholder="" rows="10" id="article-ckeditor" >{!!$page->page_text!!}</textarea>
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