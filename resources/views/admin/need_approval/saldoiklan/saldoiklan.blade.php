@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Kode_tagihan</center></th>
                                    <th><center>Pemesan</center></th>
                                    <th><center>Jumlah_tagihan</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($iklan as $key => $i)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td><center>{{$i->trans_code}}</center></td>
                                    <td><center>{{$i->user->username}}</center></td>
                                    <td></td>
                                    @if ($i->trans_iklan_status == 1)
                                    <td><center>Belum Konfirmasi</center></td>
                                    @elseif ($i->trans_iklan_status == 2)
                                    <td><center>Sudah Konfirmasi</center></td>
                                    @elseif ($i->trans_iklan_status == 3)
                                    <td><center>Approved</center></td>
                                    @elseif ($i->trans_iklan_status == 4)
                                    <td><center>Ditolak</center></td>
                                    @endif
                                    <td>
                                        @if ($i->trans_iklan_status == 1)
                                        <center>
                                            <a href="{{route('admin.needapproval.konfirmasi_iklan', $i->id)}}"><button type="submit" class="btn btn-info">Konfirmasi</button></a>
                                            <a href="{{route('admin.needapproval.tolak', $i->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($i->trans_iklan_status == 2)
                                        <center>
                                            <a href="{{route('admin.needapproval.approve_admin', $i->id)}}"><button type="submit" class="btn btn-success">Approve</button></a>
                                            <a href="{{route('admin.needapproval.tolak', $i->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($i->trans_iklan_status == 3)
                                        <center>
                                            <a href="{{route('admin.needapproval.tolak', $i->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($i->trans_iklan_status == 4)
                                        <center>
                                            <p style="color: red">IKLAN DITOLAK</p>
                                        </center>
                                        @endif
                                    </td>
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
