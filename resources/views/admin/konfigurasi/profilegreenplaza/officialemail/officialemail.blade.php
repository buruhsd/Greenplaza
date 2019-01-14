@extends('admin.index')
@section('content')

<div class="page-inner">
    <div class="page-title">
      <h3 class="breadcrumb-header">Manage Official Email View</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
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
                                    <th><center>Id</center></th>
                                    <th><center>Email</center></th>
                                    <th><center>Keterangan</center></th>
                                    <th><center>Data_Update</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($email as $e)
                                <tr>
                                    <td>{{$e->id}}</td>
                                    <td>{{$e->official_email_email}}</td>
                                    <td>{{$e->official_email_note}}</td>
                                    <td>{{$e->created_at}}</td>
                                    <td><center>
                                        <a href="{{route('admin.konfigurasi.delete_email', $e->id)}}"><button class="btn btn-danger">hapus</button></a>
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