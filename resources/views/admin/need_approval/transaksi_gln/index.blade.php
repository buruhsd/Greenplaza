@extends('admin.index')
@section('need approval', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
                <h4 class="breadcrumb-header"><center>Transaksi Greenline</center></h3>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6">
                        <form action="#" method="GET">
                            <div class="input-group pull-left" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Transaction Id ..."></a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default">1 GLN = {{number_format($url)}}</button>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin-top: 2%">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Transaksi Code</center></th>
                                    <th><center>Transaksi id</center></th>
                                    <th><center>Detail id</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            @if(count($gln) != 0)
                                @foreach ($gln as $key => $g)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    <td><center>{{$g->trans->trans_code}}</center></td>
                                    <td><center>{{$g->trans_detail_trans_id}}</center></td>
                                    <td><center>{{$g->id}}</center></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    @if ($g->trans_detail_status == 3 && $g->trans_detail_is_cancle == 1)
                                        <td><center>Seller Cancel</center></td>
                                    @elseif ($g->trans_detail_status == 4 && $g->trans_detail_is_cancel == 1)
                                        <td><center>Seller Cancel</center></td>
                                    @elseif ($g->trans_detail_status == 6 && $g->trans_detail_is_cancel == 0)
                                        <td><center>Seller Sanggup</center></td>
                                    @elseif ($g->trans_detail_status == 1 && $g->trans_detail_is_cancel == 0)
                                        <td><center>Member Order</center></td>
                                    @elseif ($g->trans_detail_status == 2 && $g->trans_detail_is_cancel == 0)   
                                        <td><center>Member Transfer</center></td>
                                    @else 
                                        <td><center>-</center></td>
                                    @endif

                                    @if ($g->trans_detail_status == 6 && $g->trans_detail_is_cancel == 0)
                                        @if ($g->gln->trans_gln_status == 1)
                                            <td><center><a onclick="return confirm('Anda yakin ingin melanjutkan?')" href="{{route('admin.needapproval.gln_send', [$g->trans_code, $g->id])}}">
                                                <button class="btn btn-info btn-xs">send coin to seller</button>
                                            </a></center></td>
                                        @elseif ($g->gln->trans_gln_status == 2)
                                            <td><center><button class="btn btn-success btn-xs">success send to seller</button></center></td>
                                        @endif

                                    @elseif (($g->trans_detail_status == 4 || $g->trans_detail_status == 3) && $g->trans_detail_is_cancel == 1)
                                        @if ($g->gln->trans_gln_status == 2)
                                            <td><center><a onclick="return confirm('Anda yakin ingin melanjutkan?')" href="{{route('admin.needapproval.gln_sendback', [$g->trans_code, $g->id])}}">
                                                <button class="btn btn-warning btn-xs">send coin back to member</button>
                                            </a></center></td>
                                        @elseif ($g->gln->trans_gln_status == 1)
                                            <td><center><a onclick="return confirm('Anda yakin ingin melanjutkan?')" href="{{route('admin.needapproval.gln_sendback', [$g->trans_code, $g->id])}}">
                                                <button class="btn btn-warning btn-xs">send coin back to member</button>
                                            </a></center></td>
                                        @elseif ($g->gln->trans_gln_status == 3)
                                            <td><center><button class="btn btn-success btn-xs">success send to member</button></center></td>
                                        @endif

                                    @else 
                                        <td><center>Pending</center></td>
                                    @endif
                                </tr>
                                @endforeach                            
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">KOSONG</td>
                                </tr>
                            @endif  
                        </table>
                        {{$gln->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.need_approval.transaksi_gln.detail')
@endsection
