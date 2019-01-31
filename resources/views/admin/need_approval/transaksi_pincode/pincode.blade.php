@extends('admin.index')
@section('need approval', 'active-page')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix" style="margin-bottom: 2%">
                    <!-- <div class="col-md-6">
                        <div class="input-group pull-left">
                            <select id="select-list" type="text" class="form-control">
                                <option value="">--Choose Option List--</option>
                                <option value="/admin/needapproval/listmember">List Member</option>
                                <option value="/admin/needapproval/listseller">List Seller</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form action="#" method="GET">
                                <div class="input-group pull-left" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Kode Pincode ..."></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Kode_Order</center></th>
                                    <th><center>Nama</center></th>
                                    <th><center>Jumlah_Transfer</center></th>
                                    <th><center>Bank_Tujuan</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>

                            <tbody>
                            @if($pin->count() > 0)
                            @foreach ($pin as $key => $p)
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$p->trans_pincode_code}}</center></td>
                                    <td><center>{{App\User::where('id', $p->trans_pincode_user_id)->first()->name}}</center></td>
                                    <td><center>{{$p->trans_pincode_amount}}</center></td>
                                    <td><center>{{App\Models\Bank::where('id', $p->trans_pincode_bank_id)->first()->bank_kode}}</center></td>
                                    @if ($p->trans_pincode_status == 1)
                                    <td><center>Belum Konfirmasi</center></td>
                                    @elseif ($p->trans_pincode_status == 2)
                                    <td><center>Sudah Konfirmasi</center></td>
                                    @elseif ($p->trans_pincode_status == 3)
                                    <td><center>Approved</center></td>
                                    @elseif ($p->trans_pincode_status == 4)
                                    <td><center>Ditolak</center></td>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($p->trans_pincode_status == 1)
                                        <center>
                                            <a href="{{route('admin.needapproval.konfirmasi_pincode', $p->id)}}"><button type="submit" class="btn btn-info">Konfirmasi</button></a>
                                            <a href="{{route('admin.needapproval.tolakpincode', $p->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($p->trans_pincode_status == 2)
                                        <center>
                                            <a href="{{route('admin.needapproval.approve_adminpincode', $p->id)}}"><button type="submit" class="btn btn-success">Approve</button></a>
                                            <a href="{{route('admin.needapproval.tolakpincode', $p->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($p->trans_pincode_status == 3)
                                        <center>
                                            <a href="{{route('admin.needapproval.tolakpincode', $p->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($p->trans_pincode_status == 4)
                                        <center>
                                            <p style="color: red">IKLAN DITOLAK</p>
                                        </center>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <td colspan="7"><center>KOSONG</center></td>
                            @endif
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