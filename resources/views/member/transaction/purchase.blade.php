@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Transaction</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="code" class="sr-only">Code</label>
                    <input type="text" class="form-control" placeholder="Search" name="code" value="{!! (!empty($_GET['code']))?$_GET['code']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        <option value="chart" {!! (!empty($_GET['status']) && $_GET['status'] == "chart")?"selected":"" !!}>Chart</option>
                        <option value="order" {!! (!empty($_GET['status']) && $_GET['status'] == "order")?"selected":"" !!}>Konfirmasi Pembayaran</option>
                        <option value="transfer" {!! (!empty($_GET['status']) && $_GET['status'] == "transfer")?"selected":"" !!}>Menunggu Validasi</option>
                        <option value="seller" {!! (!empty($_GET['status']) && $_GET['status'] == "seller")?"selected":"" !!}>Tunggu Seller</option>
                        <option value="packing" {!! (!empty($_GET['status']) && $_GET['status'] == "packing")?"selected":"" !!}>Packing</option>
                        <option value="shipping" {!! (!empty($_GET['status']) && $_GET['status'] == "shipping")?"selected":"" !!}>Shipping</option>
                        <option value="dropping" {!! (!empty($_GET['status']) && $_GET['status'] == "dropping")?"selected":"" !!}>Dropping</option>
                        <option value="cancel" {!! (!empty($_GET['status']) && $_GET['status'] == "cancel")?"selected":"" !!}>Cancel</option>
                        <option value="komplain" {!! (!empty($_GET['status']) && $_GET['status'] == "komplain")?"selected":"" !!}>Komplain</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Transaction</h4>
                    <button type="button" onclick="search('chart');" class="btn btn-info">Chart<span class="label label-default pull-right">{{FunctionLib::count_trans(0, Auth::id())}}</span></button>
                    <button type="button" onclick="search('order');" class="btn btn-info">Konfirmasi Pembayaran<span class="label label-default pull-right">{{FunctionLib::count_trans(1, Auth::id())}}</span></button>
                    <button type="button" onclick="search('transfer');" class="btn btn-info">Menunggu Validasi<span class="label label-default pull-right">{{FunctionLib::count_trans(2, Auth::id())}}</span></button>
                    <button type="button" onclick="search('seller');" class="btn btn-info">Tunggu Seller<span class="label label-default pull-right">{{FunctionLib::count_trans(3, Auth::id())}}</span></button>
                    <button type="button" onclick="search('packing');" class="btn btn-info">Packing<span class="label label-default pull-right">{{FunctionLib::count_trans(4, Auth::id())}}</span></button>
                    <button type="button" onclick="search('shipping');" class="btn btn-info">Shipping<span class="label label-default pull-right">{{FunctionLib::count_trans(5, Auth::id())}}</span></button>
                    {{-- <button type="button" onclick="search('Sent');" class="btn btn-info">Sent<span class="label label-default pull-right">{{FunctionLib::count_trans(5, Auth::id())}}</span></button> --}}
                    <button type="button" onclick="search('dropping');" class="btn btn-info">Dropping<span class="label label-default pull-right">{{FunctionLib::count_trans(6, Auth::id())}}</span></button>
                    <button type="button" onclick="search('cancel');" class="btn btn-info">Cancel<span class="label label-default pull-right">{{FunctionLib::count_trans(7, Auth::id())}}</span></button>
                    <button type="button" onclick="search('komplain');" class="btn btn-info">Komplain<span class="label label-default pull-right">{{FunctionLib::count_trans(8, Auth::id())}}</span></button>
                    {{-- <a href="{{ url('admin/transaction/create') }}" class="btn btn-success btn-sm pull-right">Add New</a> --}}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Detail Transaction</th>
                                    <th>Detail Pembeli</th>
                                    <th>Paid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($transaction as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td>{{$item->trans_code}}</td>
                                        <td scope="row">
                                            <ul>
                                                <li>Amount : {{$item->trans_amount}}</li>
                                                <li>Amount Ship : {{$item->trans_amount_ship}}</li>
                                                <li>Amount Total : {{$item->trans_amount_total}}</li>
                                                <li>Date : {{$item->created_at}}</li>
                                                <li>Total Transaksi : <button class="btn btn-warning btn-xs">{{$item->trans_detail->count()}}</button></li>
                                                <li>
                                                    {!! Form::open(['id' => 'form-transDetail']) !!}
                                                        <input type="hidden" name="type" value="buyer"/>
                                                        <input type="button" onclick='modal_post($(this), $("#form-transDetail").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.trans_detail_post", $item->id)}} value="More" class="btn btn-info btn-xs" />
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <ul>
                                                <li>Username : {{$item->pembeli->username}}</li>
                                                <li>Name : {{$item->pembeli->name}}</li>
                                                <li>Email : {{$item->pembeli->email}}</li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            {!!($item->trans_is_paid == 1)
                                                ?"<button class='btn btn-success btn-xs'>Done</button>"
                                                :"<button class='btn btn-danger btn-xs'>Not yet</button>"!!}
                                        </td>
                                        <td scope="row">
                                            {!!Plugin::trans_purchase_btn(['id'=>$item->id])!!}
                                            {{-- <a href="{{route('member.produk.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                            <a href="{{route('member.produk.edit', $item->id)}}" class='btn btn-info btn-xs'>Edit</a> --}}
                                            {{-- <a href="{{route('member.produk.delete', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $transaction->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
        