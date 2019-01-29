@extends('admin.index')
@section('dashboard', 'active-page')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <a href="{{route('admin.dasboardseller')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
                    <h4 class="panel-title">Detail Seller GreenPlaza</h4>
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
                                    <th>Username</th>
                                    <td> : </td>
                                <tr>
                                
                                <tr>
                                    <th>Email</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>Tanggal registrasi</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>nama</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>nomor handphone</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>alamat</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>provinsi</th>
                                    <th>kabupaten</th>
                                    <th>kecamatan</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>kode_pos</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>bank</th>
                                    <td> : - </td>
                                </tr>
                                <tr>
                                    <th>Pemilik rekening</th>
                                    <td> : -</td>
                                <tr>
                                <tr>
                                    <th>No Rekening</th>
                                    <td> : -</td>
                                <tr>
                                <tr>
                                    <th>shipment</th>
                                    <td> : -</td>
                                <tr>
                                <tr>
                                    <th>Foto Profile dan KTP</th>
                                    <td> : 
                                            <center>
                                                <img src="" alt="" class="h100">
                                                <figcaption style="padding: 5px">Foto Profile</figcaption>
                                                <img src="" alt="" class="h100">
                                                <figcaption style="padding: 5px">Foto KTP</figcaption>
                                            </center>
                                    </td>
                                <tr>
                                <tr>
                                    <th>Foto NPWP dan Buku rekening</th>
                                    <td> : 
                                            <center>
                                                <img src="" alt="" class="h100">
                                                <figcaption style="padding: 5px">NPWP</figcaption>
                                                <img src="" alt="" class="h100">
                                                <figcaption style="padding: 5px">Buku Rekening</figcaption>
                                            </center>
                                    </td>
                                <tr>
                            </thead>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection