@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Seller Transaksi Detail</h3>
			</div>
            <a href="{{route('admin.dashboard')}}"><button type="button" class="btn btn-warning btn-addon pull-right"><i class="fa fa-spin fa-refresh"></i> Back</button></a>
			<form action="#" method="GET">
                <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                    <div class="input-group pull-left" style="width: 225px;">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by seller id ..." name="search" value="" autocomplete="off" id="search_table_currency">
                    </div>
                </div> 
            </form>
            <div class="input-group pull-right" style="margin-top: 2%; margin-right: 2%">
                <select id="select-list" type="text" class="form-control">
                    <option value="">--< Choose Option List >--</option>
                    <option value="/admin/dashboarddetail">Detail Seller</option>
                    <option value="/admin/dashboardhotlist">Hotlist Seller</option>
                    <option value="/admin/dashboardiklan">Iklan Seller</option>
                    <option value="/admin/dashboardpincode">Pincode Seller</option>
                </select>
            </div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>Seller Id</center></th>
                                    <th><center>Nama</center></th>
                                    <th><center>Tagihan</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($detailseller->count() > 0)
                                @foreach ($detailseller as $d)
                               <tr>
                                    <td><center>{{$d->trans->trans_user_id}}</center></td>
                                    <td><center>{{$d->trans->pembeli->name}}</center></td>
                                    
                                    <td><center>{{$d->trans_detail_amount}}</center></td>

                                @if ($d->trans_detail_status == 1)
                                    <td><center><button class="btn btn-success btn-xs">Order</button></center></td>
                                @elseif ($d->trans_detail_status == 2)
                                    <td><center><button class="btn btn-success btn-xs">Transfer</button></center></td>
                                @elseif ($d->trans_detail_status == 3)
                                    <td><center><button class="btn btn-success btn-xs">Seller</button></center></td>
                                @elseif ($d->trans_detail_status == 4)
                                    <td><center><button class="btn btn-success btn-xs">Packing</button></center></td>
                                @elseif ($d->trans_detail_status == 5)
                                    <td><center><button class="btn btn-success btn-xs">Shipping</button></center></td>
                                @elseif ($d->trans_detail_status == 6)
                                    <td><center><button class="btn btn-success btn-xs">Dropping</button></center></td>
                                @else
                                    <td><center>-</center></td>
                                @endif

                                	
                               </tr>
                               @endforeach
                            @else
                                <td colspan="4"><center>KOSONG</center></td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection