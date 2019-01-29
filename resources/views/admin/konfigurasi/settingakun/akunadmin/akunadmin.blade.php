@extends('admin.index')
@section('konfigurasi', 'active-page')
@section('content')

<div class="page-inner">
    <div class="page-title">
      <h3 class="breadcrumb-header">User Admin List</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <a href="{{route('admin.konfigurasi.tambah_akunadmin')}}"><button type="" class="btn btn-primary pull-left" style="margin-bottom: 3%">+ Tambah User</button></a> <br/>
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
                                    <th><center>Nama_User</center></th>
                                    <th><center>Password</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $u)
                                <tr>
                                    <td><center>{{$key++}}</center></td>
                                    <td><center>{{$u->name}}</center></td>
                                    <td><center>{{$u->password}}</center></td>
                                    <td><center>
                                        <a href="{{route('admin.konfigurasi.deleteadmin', $u->id)}}"><button class="btn btn-danger">hapus</button></a>
                                        <!-- <button class="btn btn-warning btn-xs">block akun</button> -->
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