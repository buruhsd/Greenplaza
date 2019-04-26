@extends('admin.index')
@section('need approval', 'active-page')
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
                    <input type="text" class="form-control" placeholder="Code" name="code" value="{!! (!empty($_GET['code']))?$_GET['code']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        {{-- <option value="chart" {!! (!empty($_GET['status']) && $_GET['status'] == "chart")?"selected":"" !!}>Chart</option> --}}
                        <option value="order" {!! (!empty($_GET['status']) && $_GET['status'] == "order")?"selected":"" !!}>Order</option>
                        <option value="transfer" {!! (!empty($_GET['status']) && $_GET['status'] == "transfer")?"selected":"" !!}>Transfer</option>
                        <option value="seller" {!! (!empty($_GET['status']) && $_GET['status'] == "seller")?"selected":"" !!}>Seller</option>
                        <option value="packing" {!! (!empty($_GET['status']) && $_GET['status'] == "packing")?"selected":"" !!}>Packing</option>
                        <option value="shipping" {!! (!empty($_GET['status']) && $_GET['status'] == "shipping")?"selected":"" !!}>Shipping</option>
                        <option value="dropping" {!! (!empty($_GET['status']) && $_GET['status'] == "dropping")?"selected":"" !!}>Dropping</option>
                        <option value="cancel" {!! (!empty($_GET['status']) && $_GET['status'] == "cancel")?"selected":"" !!}>Cancel</option>
                        <option value="komplain" {!! (!empty($_GET['status']) && $_GET['status'] == "komplain")?"selected":"" !!}>Komplain</option>
                    </select>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="user" class="sr-only">User</label>
                    <select class="form-control" id="user" name="user">
                        <option value="" {!! (!empty($_GET['user']) && $_GET['user'] == "")?"selected":"" !!}>All</option>
                        <option value="admin" {!! (!empty($_GET['user']) && $_GET['user'] == "admin")?"selected":"" !!}>Admin</option>
                        <option value="member" {!! (!empty($_GET['user']) && $_GET['user'] == "member")?"selected":"" !!}>Member</option>
                    </select>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="payment" class="sr-only">Pembayaran</label>
                    <select class="form-control" id="payment" name="payment">
                        <option value="" {!! (!empty($_GET['payment']) && $_GET['payment'] == "")?"selected":"" !!}>All</option>
                        @foreach($payment as $item)
                            <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment']) && $_GET['payment'] == $item->payment_kode)?"selected":"" !!}>{{ucfirst(strtolower($item->payment_name))}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="is_paid" class="sr-only">Status Paid</label>
                    <select class="form-control" id="is_paid" name="is_paid">
                        <option value="" {!! (!empty($_GET['is_paid']) && $_GET['is_paid'] == "")?"selected":"" !!}>All</option>
                        <option value="paid" {!! (!empty($_GET['is_paid']) && $_GET['is_paid'] == "paid")?"selected":"" !!}>Paid</option>
                        <option value="notyet" {!! (!empty($_GET['is_paid']) && $_GET['is_paid'] == "notyet")?"selected":"" !!}>Not Paid</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    {{-- <div class="col-md-12">
                        <div class="col-md-6">
                            <h4 class="panel-title">Transaction</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group pull-right">
                                <select id="select-list" type="text" class="form-control">
                                    <option value="">--Choose Paid Option--</option>
                                    <option value="/admin/transaction/paid">Is Paid</option>
                                    <option value="/admin/transaction/not_paid">Not Paid</option>
                                    <option value="/admin/transaction">All Transaction</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <button type="button" onclick="search('chart');" class="btn btn-info">Chart<span class="label label-default pull-right">{{FunctionLib::count_trans(0)}}</span></button> --}}
                    <button type="button" onclick="search('order');" class="btn btn-info">Order<span class="label label-default pull-right">{{FunctionLib::count_trans(1, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('transfer');" class="btn btn-info">Transfer<span class="label label-default pull-right">{{FunctionLib::count_trans(2, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('seller');" class="btn btn-info">Seller<span class="label label-default pull-right">{{FunctionLib::count_trans(3, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('packing');" class="btn btn-info">Packing<span class="label label-default pull-right">{{FunctionLib::count_trans(4, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('shipping');" class="btn btn-info">Shipping<span class="label label-default pull-right">{{FunctionLib::count_trans(5, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('dropping');" class="btn btn-info">Dropping<span class="label label-default pull-right">{{FunctionLib::count_trans(6, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('cancel');" class="btn btn-info">Cancel<span class="label label-default pull-right">{{FunctionLib::count_trans(7, Auth::id(), 'seller')}}</span></button>
                    <button type="button" onclick="search('komplain');" class="btn btn-info">Komplain<span class="label label-default pull-right">{{FunctionLib::count_trans(8, Auth::id(), 'seller')}}</span></button>
                    <!-- <a href="{{ url('admin/transaction/create') }}" class="btn btn-success btn-sm pull-right">Add Newssss</a> -->
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
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            @if($transaction->count() > 0)
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
                                                <li>Jasa Pengiriman : {{$item->trans_detail->first()->shipment->shipment_name}}</li>
                                                <li><b>&nbsp;&nbsp;-> {{$item->trans_detail->first()->trans_detail_shipment_service}}</b></li>
                                                <li>Total Transaksi : <button class="btn btn-warning btn-xs">{{$item->count_detail}}</button></li>
                                                <li>Pembayaran : {{$item->payment->payment_name}}</li>
                                                <li>
                                                    <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.trans_detail", $item->id)}} value="Choose Address" class='btn btn-info btn-xs'>
                                                        More
                                                    </button>
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
                                                :"<button class='btn btn-danger btn-xs'>Unpaid</button>"!!}
                                        </td>
                                        <td scope="row">
                                            {!!Plugin::trans_purchase_btn_admin(['id'=>$item->id, 'type'=>'seller'])!!}                                            
                                        </td>
                                        <!-- <td scope="row">
                                            <a href="{{route('admin.produk.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                            <a href="{{route('admin.transaction.edit_trans', $item->id)}}" class='btn btn-info btn-xs'>Edit</a>
                                            <a href="{{route('admin.produk.delete', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                        </td> -->
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="6"><center>KOSONG</center></td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $transaction->appends(['search' => Request::get('search'), 'code' => Request::get('code'), 'status' => Request::get('status')])->render() !!} </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.input-tanggal').datepicker();       
    });
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
        