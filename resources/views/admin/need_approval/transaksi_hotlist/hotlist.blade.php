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
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Kode Hotlist ..."></a>
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
                                    <th><center>Kode Order</center></th>
                                    <th><center>Pembelian</center></th>
                                    <th><center>Tagihan</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody class="table-responsive table table-striped">
                            @if($hot->count() > 0)
                            @foreach ($hot as $key => $h)
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$h->trans_hotlist_code}}</center></td>
                                    <td>
                                        <ul>
                                            <li>
                                                Pembeli : {{$h->user->name}}
                                            </li>
                                            <li>
                                                Paket : {{$h->paket->paket_hotlist_name}}
                                            </li>
                                            <li>
                                                Poin : {{$h->trans_hotlist_jml}}
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                Status : <button class="btn btn-xs btn-{!!FunctionLib::hotlist_status($h->trans_hotlist_status, 'btn')!!}">{!!FunctionLib::hotlist_status($h->trans_hotlist_status)!!}</button>
                                            </li>
                                            <li>
                                                Tagihan : Rp. {{FunctionLib::number_to_text($h->trans_hotlist_amount)}}
                                            </li>
                                            <li>
                                                Pembayaran : {{Ucfirst($h->payment->payment_name)}}
                                            </li>
                                        </ul>
                                    </td>
                                    {{-- @if ($h->trans_hotlist_status == 1)
                                    <td><center>Belum Konfirmasi</center></td>
                                    @elseif ($h->trans_hotlist_status == 2)
                                    <td><center>Sudah Konfirmasi</center></td>
                                    @elseif ($h->trans_hotlist_status == 3)
                                    <td><center>Approved</center></td>
                                    @elseif ($h->trans_hotlist_status == 4)
                                    <td><center>Ditolak</center></td>
                                    @endif --}}
                                    </td>
                                    <td>
                                        @if ($h->trans_hotlist_status == 1)
                                        <center>
                                            <a href="{{route('admin.needapproval.approve_adminhotlist', $h->id)}}"><button type="submit" class="btn btn-success">Approve</button></a>
                                            <a href="{{route('admin.needapproval.tolakhotlist', $h->id)}}"><button type="submit" class="btn btn-danger">Tolak</button></a>
                                        </center>
                                        @elseif ($h->trans_hotlist_status == 4)
                                        <center>
                                            <p style="color: red">IKLAN DITOLAK</p>
                                        </center>
                                        @endif
                                        {{-- @if ($h->trans_hotlist_status == 1)
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
                                        @endif --}}
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