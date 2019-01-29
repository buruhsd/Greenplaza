@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Edit Iklan</h3>
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
                  <form class="form-horizontal" method="POST" action= "{{route('admin.konfigurasi.edit_iklanadd', $iklan->id)}}" enctype = "multipart/form-data">
                    {{ csrf_field() }}
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
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Nama Iklan</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="iklan_title" value="{{$iklan->iklan_title}}">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Pilih Paket</label>
                          <div class="col-sm-10">
                              <select id="select-list-buy" align="left"  class="form-control" name="iklan_iklan_id">
                                <option value="1">Banner 1</option>
                                <option value="2">Banner 2</option>
                                <option value="3">Banner 3</option>
                                <option value="4">Banner 4</option>
                                <option value="5">Banner 5</option>
                                <option value="{{$iklan->iklan_iklan_id}}" selected>{{App\Models\Conf_iklan::where('id', $iklan->iklan_iklan_id)->first()->iklan_name}}</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Nama Pemesan</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" id="input-Default" style="color: #A9A9A9" name="iklan_user_id" value="{{App\User::where('id', $iklan->iklan_user_id)->first()->name}}">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="input-Default" class="col-sm-2 control-label">Gambar Iklan</label>
                          <div class="col-sm-10">
                              <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image)}}" style="width: 200px"> <br/><br/>
                              <input type="file" name="iklan_image">
                          </div>
                      </div>     
                      <center>
                        <button type="submit" class="btn btn-primary" style="width: 40%">Simpan</button>
                      </center>
                  </form>
              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

@endsection