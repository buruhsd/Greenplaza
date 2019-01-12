@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <a href="{{route('admin.konfigurasi.tambah_iklanbanner')}}"><button type="" class="btn btn-primary pull-left" style="margin-bottom: 3%">+ Tambah Iklan</button></a> <br/>
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
                                    <th><center>Nama</center></th>
                                    <th><center>Detail</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($iklan as $i)
                                <tr>
                                    <td><center>{{$i->id}}</center></td>
                                    <td><center>{{$i->jenis->iklan_name}}</center></td>
                                    <td><center>
                                        pemesan : {{$i->user->name}} <br/>
                                        <img src="{{asset('assets/images/iklan/'.$i->iklan_image)}}" style="width: 200px"> <br/>
                                        nama paket banner : {{$i->jenis->iklan_name}} <br/>
                                        @if ($i->iklan_status == 0)
                                        status : <p style="color: red"> un-publish </p> <br/>
                                        @elseif ($i->iklan_status == 1)
                                        status : <p style="color: green"> publish </p> <br/>
                                        @endif
                                        tanggal publish terakir : {{$i->updated_at}}
                                    </center></td>
                                    <td><center>
                                        <a href="{{route('admin.konfigurasi.edit_iklan', $i->id)}}"><button class="btn btn-warning btn-xs" style="width: 100%"> edit </button></a> <br/>
                                        <a href="{{route('admin.konfigurasi.delete_iklan', $i->id)}}"><button class="btn btn-danger btn-xs" style="width: 100%"> delete </button></a> <br/>
                                        <a href="{{route('admin.konfigurasi.publish', $i->id)}}"><button class="btn btn-success btn-xs" style="width: 100%"> publish </button> <br/>
                                        <a href="{{route('admin.konfigurasi.unpublish', $i->id)}}"><button class="btn btn-primary btn-xs" style="width: 100%"> un-publish </button>
                                    </center></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$iklan->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection