@extends('admin.index')
@section('masedi', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="col-md-12">
                <div class="col-md-4">
                    <div style="padding: 10px" class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                        <div class="panel-body">
                            <p class="stats-info">Total transaksi selesai : <br/>
                            <b>Rp. {{FunctionLib::number_to_text($sum)}}
                            </b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title">
                <h4 class="breadcrumb-header"><center>Laporan Transaksi Admin</center></h3>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-12">
                        <form action="{{route('admin.transaksi_lain_admin')}}" method="GET" class="form-inline">
                            <div class="col-md-12">
                                <div class="input-group pull-left">
                                    <input type="text" name="code" class="form-control search-input" placeholder="Kode detail" value="{!! (!empty($_GET['code']))?$_GET['code']:"" !!}">
                                </div>
                                <label for="payment_type" class="sr-only">Trannsaksi</label>
                                <select class="form-control" id="payment_type" name="payment_type">
                                    @foreach($payment_type as $item)
                                        @if($loop->first)
                                            <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment_type']) && $_GET['payment_type'] == $item->payment_kode)?"selected":"selected" !!}>{{$item->payment_name}}</option>
                                        @else
                                            <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment_type']) && $_GET['payment_type'] == $item->payment_kode)?"selected":"" !!}>{{$item->payment_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="status" class="sr-only">Trannsaksi</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="process" {!! (!empty($_GET['status']) && $_GET['status'] == 'process')?"selected":"" !!}>On Process</option>
                                    <option value="cancel" {!! (!empty($_GET['status']) && $_GET['status'] == 'cancel')?"selected":"" !!}>Cancel</option>
                                    <option value="dropping" {!! (!empty($_GET['status']) && $_GET['status'] == 'dropping')?"selected":"" !!}>Dropping</option>
                                </select>
                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="panel-body" style="margin-top: 2%">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Transaksi</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Seller</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            @if(count($list) != 0)
                                @foreach ($list as $key => $g)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td>
                                        <ul>
                                            <li>Kode Transaksi Detail : {{$g->trans_code}}</li>
                                            <li>Kode Transaksi : {{$g->trans->trans_code}}</li>
                                            <li>Amount : {{$g->trans_detail_amount}}</li>
                                            <li>Amount Ship : {{$g->trans_detail_amount_ship}}</li>
                                            <li>Amount Total : {{$g->trans_detail_amount_total}}</li>
                                            <li>Date : {{$item->created_at}}</li>
                                            <li>Jasa Pengiriman : {{$g->shipment->shipment_name}}</li>
                                            <li><b>&nbsp;&nbsp;-> {{$g->trans_detail_shipment_service}}</b></li>
                                            <li>Pembayaran : {{$g->trans->payment->payment_name}}</li>
                                        {{-- <center>{{$g->trans_code}}</center> --}}
                                        </ul>
                                    </td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    <td><center>{{$g->produk->user->username}}</center></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    @if($g->trans_detail_is_cancel == 1)
                                        <td><center>Cancel</center></td>
                                    @elseif($g->trans_detail_status == 6)
                                        <td><center>Dropping</center></td>
                                    @else
                                        <td><center>On Process</center></td>
                                    @endif

                                    <!-- @if ($g->trans_detail_status == 1)
                                        <td><center>in Chart</center></td>
                                    @elseif ($g->trans_detail_status == 2)
                                        <td><center>Transfer</center></td>
                                    @elseif ($g->trans_detail_status == 3)
                                        <td><center>Seller</center></td>
                                    @elseif ($g->trans_detail_status == 4)
                                        <td><center>Packing</center></td>
                                    @elseif ($g->trans_detail_status == 5)   
                                        <td><center>Shipping</center></td>
                                    @elseif ($g->trans_detail_status == 6)   
                                        <td><center>Dropping</center></td>
                                    @elseif ($g->trans_is_cancel == 1)   
                                        <td><center>Cancel</center></td>
                                    @else 
                                        <td><center>-</center></td>
                                    @endif -->
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">KOSONG</td>
                                </tr>
                            @endif  
                        </table>
                        {{-- {{$list->render()}} --}}
                    </div>
                    <div> {!! $list->appends(['code' => Request::get('code'), 'status' => Request::get('status'), 'payment_type' => Request::get('payment_type')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.masedi.detailmasedi')
@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
