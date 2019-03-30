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
                    
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Kode Order</center></th>
                                    <th><center>Pembelian</center></th>
                                    <th><center>Tagihan</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($iklan->count() > 0)
                            @foreach ($iklan as $key => $i)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td><center>{{$i->trans_iklan_code}}</center></td>
                                    <td>
                                        <ul>
                                            <li>
                                                Pembeli : {{$i->user->name}}
                                            </li>
                                            <li>
                                                Paket : {{$i->paket->paket_iklan_name}}
                                            </li>
                                            <li>
                                                Poin : {{$i->trans_iklan_amount}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                Status : <button class="btn btn-xs btn-{!!FunctionLib::iklan_status($i->trans_iklan_status, 'btn')!!}">{!!FunctionLib::iklan_status($i->trans_iklan_status)!!}</button>
                                            </li>
                                            <li>
                                                Tagihan : Rp. {{FunctionLib::number_to_text($i->trans_iklan_amount)}}
                                            </li>
                                            <li>
                                                Pembayaran : {{Ucfirst($i->payment->payment_name)}}
                                            </li>
                                        </ul>
                                    </td>
                                    {{-- @if ($i->trans_iklan_status == 1)
                                    <td><center>Belum Konfirmasi</center></td>
                                    @elseif ($i->trans_iklan_status == 2)
                                    <td><center>Sudah Konfirmasi</center></td>
                                    @elseif ($i->trans_iklan_status == 3)
                                    <td><center>Approved</center></td>
                                    @elseif ($i->trans_iklan_status == 4)
                                    <td><center>Ditolak</center></td>
                                    @endif --}}
                                    <td>
                                        @if ($i->trans_iklan_status == 1)
                                        <center>
                                            <a href="{{route('admin.needapproval.approve_admin', $i->id)}}"><button type="submit" class="btn btn-success">Approve</button></a>
                                            <a href="{{route('admin.needapproval.tolak', $i->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($i->trans_hotlist_status == 4)
                                        <center>
                                            <p style="color: red">IKLAN DITOLAK</p>
                                        </center>
                                        @endif

                                        {{-- @if ($i->trans_iklan_status == 1)
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
                                        @endif --}}
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
