@extends('admin.index')
@section('content')

<div class="page-inner">
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
                                    <th><center>No</center></th>
                                    <th><center>Kode_Order</center></th>
                                    <th><center>Nama_Seller</center></th>
                                    <th><center>Jumlah_Transfer</center></th>
                                    <th><center>Bank_Tujuan</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            @if($hot->count() > 0)
                            @foreach ($hot as $key => $h)
                            <tbody>
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$h->trans_hotlist_code}}</center></td>
                                    <td><center>{{App\User::where('id', $h->trans_hotlist_user_id)->first()->name}}</center></td>
                                    <td><center>{{$h->trans_hotlist_amount}}</center></td>
                                    <td><center>{{App\Models\Bank::where('id', $h->trans_hotlist_bank_id)->first()->bank_kode}}</center></td>
                                    </center></td>
                                    @if ($h->trans_hotlist_status == 1)
                                    <td><center>Belum Konfirmasi</center></td>
                                    @elseif ($h->trans_hotlist_status == 2)
                                    <td><center>Sudah Konfirmasi</center></td>
                                    @elseif ($h->trans_hotlist_status == 3)
                                    <td><center>Approved</center></td>
                                    @elseif ($h->trans_hotlist_status == 4)
                                    <td><center>Ditolak</center></td>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($h->trans_hotlist_status == 1)
                                        <center>
                                            <a href="{{route('admin.needapproval.konfirmasi_hotlist', $h->id)}}"><button type="submit" class="btn btn-info">Konfirmasi</button></a>
                                            <a href="{{route('admin.needapproval.tolakhotlist', $h->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($h->trans_hotlist_status == 2)
                                        <center>
                                            <a href="{{route('admin.needapproval.approve_adminhotlist', $h->id)}}"><button type="submit" class="btn btn-success">Approve</button></a>
                                            <a href="{{route('admin.needapproval.tolakhotlist', $h->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($h->trans_hotlist_status == 3)
                                        <center>
                                            <a href="{{route('admin.needapproval.tolakhotlist', $h->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($h->trans_hotlist_status == 4)
                                        <center>
                                            <p style="color: red">IKLAN DITOLAK</p>
                                        </center>
                                        @endif
                                </tr>
                                @else
                                    <td colspan="7"><center>KOSONG</center></td>
                                @Endif
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection