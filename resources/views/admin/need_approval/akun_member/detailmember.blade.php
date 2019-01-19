@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <a href="{{route('admin.needapproval.listmember')}}"><button type="" class="btn btn-default pull-right" style="margin-bottom: 2%">Kembali</button></a>
                    <h4 class="panel-title">Detail Member GreenPlaza</h4>
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
                                    <th>Nama Lengkap</th>
                                    <td> : {{$users->username}}</td>
                                <tr>
                                <tr>
                                    <th>jenis Kelamin</th>
                                    <td> : {{App\Models\User_detail::where('user_detail_user_id', $users->id)->first()->user_detail_jk}}</td>
                                <tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_address}}</td>
                                <tr>
                                <tr>
                                    <th>Kode Pos</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_pos}}</td>
                                <tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_province}}</td>
                                <tr>
                                <tr>
                                    <th>Kota/Kab</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_city}}</td>
                                <tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_subdist}}</td>
                                <tr>
                                <tr>
                                    <th>Email</th>
                                    <td> : {{$users->email}}</td>
                                <tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_phone}}</td>
                                <tr>
                                <tr>
                                    <th>Telp. Rumah</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_tlp}}</td>
                                <tr>
                                <tr>
                                    <th>Nama Bank</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_name}}</td>
                                <tr>
                                <tr>
                                    <th>No Rekening</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_no}}</td>
                                <tr>
                                <tr>
                                    <th>Pemilik Rekening</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_owner}}</td>
                                <tr>
                                <tr>
                                    <th>Foto Profile dan KTP</th>
                                    <td> : 
                                            <center>
                                                <img src="{{ asset('assets/images/profil/'.$detail->user_detail_image) }}" alt="" class="h100">
                                                <figcaption style="padding: 5px">Foto Profile</figcaption>
                                                <img src="{{ asset('assets/images/ktp/'.$detail->user_detail_ktp) }}" alt="" class="h100">
                                                <figcaption style="padding: 5px">Foto KTP</figcaption>
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