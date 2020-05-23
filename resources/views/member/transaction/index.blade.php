@extends('member.index')
@section('sales', 'active-page')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">{{__('dashboard.transaksi') }}</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">{{__('dashboard.pencarian') }}</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="code" class="sr-only">{{__('dashboard.code') }}</label>
                    <input type="text" class="form-control" placeholder="Code" name="code" value="{!! (!empty($_GET['code']))?$_GET['code']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>{{__('dashboard.all') }}</option>
                        {{-- <option value="chart" {!! (!empty($_GET['status']) && $_GET['status'] == "chart")?"selected":"" !!}>Chart</option> --}}
                        <option value="order" {!! (!empty($_GET['status']) && $_GET['status'] == "order")?"selected":"" !!}>Order</option>
                        <option value="transfer" {!! (!empty($_GET['status']) && $_GET['status'] == "transfer")?"selected":"" !!}>Transfer</option>
                        <option value="packing" {!! (!empty($_GET['status']) && $_GET['status'] == "packing")?"selected":"" !!}>Packing</option>
                        <option value="shipping" {!! (!empty($_GET['status']) && $_GET['status'] == "shipping")?"selected":"" !!}>Shipping</option>
                        <option value="dropping" {!! (!empty($_GET['status']) && $_GET['status'] == "dropping")?"selected":"" !!}>Dropping</option>
                        <option value="cancel" {!! (!empty($_GET['status']) && $_GET['status'] == "cancel")?"selected":"" !!}>Cancel</option>
                        <option value="komplain" {!! (!empty($_GET['status']) && $_GET['status'] == "komplain")?"selected":"" !!}>Komplain</option>
                    </select>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">{{__('dashboard.paid') }}</label>
                    <select class="form-control" id="payment" name="payment">
                        <option value="" {!! (!empty($_GET['payment']) && $_GET['payment'] == "")?"selected":"" !!}>{{__('dashboard.all') }}</option>
                        @foreach($payment as $item)
                            <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment']) && $_GET['payment'] == $item->payment_kode)?"selected":"" !!}>{{ucfirst(strtolower($item->payment_name))}}</option>
                        @endforeach
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">{{__('dashboard.pencarian') }}</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">{{__('dashboard.transaksi') }}</h4>
                    {{-- <button type="button" onclick="search('chart');" class="btn btn-info">Chart<span class="label label-default pull-right">{{FunctionLib::count_trans(0, Auth::id(), 'seller')}}</span></button> --}}
                    <button type="button" onclick="search('order');" class="btn btn-info">{{__('dashboard.order') }}<span class="label label-default pull-right">{{FunctionLib::count_trans(1, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('transfer');" class="btn btn-info">Transfer<span class="label label-default pull-right">{{FunctionLib::count_trans(2, Auth::id(), 'seller')}}</span></button>
                    {{-- <button type="button" onclick="search('seller');" class="btn btn-info">Seller<span class="label label-default pull-right">{{FunctionLib::count_trans(3, Auth::id())}}</span></button> --}}
                    <button type="button" onclick="search('packing');" class="btn btn-info">{{__('dashboard.packing') }}<span class="label label-default pull-right">{{FunctionLib::count_trans("3,4", Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('shipping');" class="btn btn-info">{{__('dashboard.pengiriman') }}<span class="label label-default pull-right">{{FunctionLib::count_trans(5, Auth::id(), 'seller')}}</span></button>
                    {{-- <button type="button" onclick="search('Sent');" class="btn btn-info">Sent<span class="label label-default pull-right">{{FunctionLib::count_trans(5, Auth::id())}}</span></button> --}}
                    <button type="button" onclick="search('dropping');" class="btn btn-info">{{__('dashboard.dropping') }}<span class="label label-default pull-right">{{FunctionLib::count_trans(6, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('cancel');" class="btn btn-info">{{__('dashboard.cancel') }}<span class="label label-default pull-right">{{FunctionLib::count_trans(7, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('komplain');" class="btn btn-info">{{__('dashboard.komplain') }}<span class="label label-default pull-right">{{FunctionLib::count_trans(8, Auth::id(), 'seller')}}</span></button>
                    {{-- <a href="{{ url('admin/transaction/create') }}" class="btn btn-success btn-sm pull-right">Add New</a> --}}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{__('dashboard.gambar') }}</th>
                                    <th>{{__('dashboard.nama') }}</th>
                                    <th>{{__('dashboard.code') }}</th>
                                    <th>{{__('dashboard.detail_transaction') }}</th>
                                    <th>{{__('dashboard.detail_pembeli') }}</th>
                                    <th>{{__('dashboard.paid') }}</th>
                                    <th>{{__('dashboard.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($transaction as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td><img class="h100" scr="{{ asset("assets/images/product/".$item->trans_detail->first()->produk->produk_image) }}" style="width: 50px; height: 50px"></td>
                                        <td>{{$item->trans_detail->first()->produk->produk_name}}</td>
                                        <td>{{$item->trans_code}}</td>
                                        <td scope="row">
                                            <ul>
                                                <li>{{__('dashboard.amount') }} : {{$item->trans_amount}}</li>
                                                <li>{{__('dashboard.amount_ship') }} : {{$item->trans_amount_ship}}</li>
                                                <li>{{__('dashboard.amount_total') }} : {{$item->trans_amount_total}}</li>
                                                <li>{{__('dashboard.date') }} : {{$item->created_at}}</li>
                                                <li>{{__('dashboard.jasa_pengiriman') }} : {{$item->trans_detail->first()->shipment->shipment_name}}</li>
                                                <li><b>&nbsp;&nbsp;-> {{$item->trans_detail->first()->trans_detail_shipment_service}}</b></li>
                                                <li>{{__('dashboard.total_transaksi') }} : <button class="btn btn-warning btn-xs">{{$item->count_detail}}</button></li>
                                                <li>{{__('dashboard.pembayaran') }} : {{$item->payment->payment_name}}</li>
                                                <li>
                                                    {!! Form::open(['id' => 'form-transDetail']) !!}
                                                        <input type="hidden" name="trans_status" value="{{isset($_GET['status'])?$_GET['status']:'all'}}"/>
                                                        <input type="hidden" name="type" value="seller"/>
                                                        <input type="button" onclick='modal_post($(this), $("#form-transDetail").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.trans_detail_post", $item->id)}} value="More" class="btn btn-info btn-xs" />
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <ul>
                                                <li>Username : {{$item->pembeli->username}}</li>
                                                <li>{{__('dashboard.name') }} : {{$item->pembeli->name}}</li>
                                                <li>Email : {{$item->pembeli->email}}</li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            {!!($item->trans_is_paid == 1)
                                                ?"<button class='btn btn-success btn-xs'>Done</button>"
                                                :"<button class='btn btn-danger btn-xs'>Unpaid</button>"!!}
                                        </td>
                                        <td scope="row">
                                            {!!Plugin::trans_purchase_btn(['id'=>$item->id, 'type'=>'seller'])!!}
                                            {{-- <a href="{{route('member.produk.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                            <a href="{{route('member.produk.edit', $item->id)}}" class='btn btn-info btn-xs'>Edit</a> --}}
                                            {{-- <a href="{{route('member.produk.delete', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $transaction->appends(['search' => Request::get('search'), 'code' => Request::get('code'), 'status' => Request::get('status'), 'payment' => Request::get('payment')])->render() !!} </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div><!-- Row -->
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
        