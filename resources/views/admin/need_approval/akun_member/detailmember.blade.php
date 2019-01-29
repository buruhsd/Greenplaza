@extends('admin.index')
@section('need approval', 'active-page')
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
                                @if(App\Models\User_detail::where('user_detail_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td> : {{App\Models\User_detail::where('user_detail_user_id', $users->id)->first()->user_detail_jk}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Alamat</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_address}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Alamat</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Kode Pos</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_pos}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Kode Pos</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Provinsi</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_province}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Provinsi</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Kota/Kab</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_city}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Kota/Kab</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Kecamatan</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_subdist}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Kecamatan</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Email</th>
                                    <td> : {{$users->email}}</td>
                                <tr>
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>No. HP</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_phone}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>No. HP</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_address::where('user_address_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Telp. Rumah</th>
                                    <td> : {{App\Models\User_address::where('user_address_user_id', $users->id)->first()->user_address_tlp}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Telp. Rumah</th>
                                    <td> : - </td>
                                </tr>
                                @endif
                                @if(App\Models\User_bank::where('user_bank_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Nama Bank</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_name}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Nama Bank</th>
                                    <td> : -</td>
                                <tr>
                                @endif
                                @if(App\Models\User_bank::where('user_bank_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>No Rekening</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_no}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>No Rekening</th>
                                    <td> : -</td>
                                <tr>
                                @endif
                                @if(App\Models\User_bank::where('user_bank_user_id', $users->id)->count() > 0)
                                <tr>
                                    <th>Pemilik Rekening</th>
                                    <td> : {{App\Models\User_bank::where('user_bank_user_id', $users->id)->first()->user_bank_owner}}</td>
                                <tr>
                                @else 
                                <tr>
                                    <th>Pemilik Rekening</th>
                                    <td> : -</td>
                                <tr>
                                @endif
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