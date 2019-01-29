@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-inner">
    <div class="page-title">
      <h3 class="breadcrumb-header">Page List</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <a href="{{route('admin.konfigurasi.tambah_pagelist')}}"><button type="" class="btn btn-primary pull-left" style="margin-bottom: 3%"><i class="fa fa-file-archive-o"></i> Tambah Page</button></a> <br/>
                    <!-- <div class="col-md-6">
                        <div class="input-group pull-left">
                            <select id="select-list" type="text" class="form-control">
                                <option value="">--Choose Option List--</option>
                                <option value="/admin/needapproval/listmember">List Member</option>
                                <option value="/admin/needapproval/listseller">List Seller</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form action="#" method="GET">
                                <div class="input-group pull-right" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                                </div>
                            </form>
                        </div>
                    </div> -->
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No.</center></th>
                                    <th><center>Judul_Page</center></th>
                                    <th><center>Kategory</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($page as $key => $p)
                                <tr>
                                    <td><center>{{$key++}}</center></td>
                                    <td><center>{{$p->page_judul}}</center></td>
                                    <td><center>{{$p->page_kategori}}</center></td>

                                    @if ($p->page_status == 0)
                                    <td><center>nonaktif <a href="{{route('admin.konfigurasi.status_active', $p->id)}}"><button class="btn btn-success btn-xs">aktifkan</button></a></center></td>
                                    @elseif ($p->page_status == 1)
                                    <td><center>aktif <a href="{{route('admin.konfigurasi.status_non_active', $p->id)}}"><button class="btn btn-danger btn-xs">nonaktifkan</button></a></center></td>
                                    @endif

                                    <td><center>
                                        <a href="{{route('admin.konfigurasi.edit_page', $p->id)}}"><button class="btn btn-warning btn-xs">edit</button>
                                        <a href="{{route('admin.konfigurasi.perview', $p->id)}}"><button class="btn btn-primary btn-xs" >perview</button></a>
                                        <a href="{{route('admin.konfigurasi.deletepage', $p->id)}}"><button class="btn btn-danger btn-xs">hapus</button></a>
                                    </center></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection