@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Member Transaksi Detail</h3>
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
                    <option value="/admin/dashboarddetailmember">Detail Member</option>
                    <option value="/admin/dashboardhotlistmember">Hotlist member</option>
                    <option value="/admin/dashboardiklanmember">Iklan Member</option>
                    <option value="/admin/dashboardpincodemember">Pincode Member</option>
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
                                    <th><center>Detail</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($detailmember->count() > 0)
                                @foreach ($detailmember as $d)
                               <tr>
                                    <td><center>{{$d->trans->trans_user_id}}</center></td>
                                    <td><center>{{$d->trans->pembeli->name}}</center></td>
                                    <td><center></center></td>

                                @if ($d->trans_detail_status == 1)
                                    <td><center>Order</center></td>
                                @elseif ($d->trans_detail_status == 2)
                                    <td><center>Transfer</center></td>
                                @elseif ($d->trans_detail_status == 3)
                                    <td><center>Seller</center></td>
                                @elseif ($d->trans_detail_status == 4)
                                    <td><center>Packing</center></td>
                                @elseif ($d->trans_detail_status == 5)
                                    <td><center>Shipping</center></td>
                                @elseif ($d->trans_detail_status == 6)
                                    <td><center>Dropping</center></td>
                                @endif

                                	<td><center><a href=""><button type="submit" class="btn btn-success btn-rounded" style="width: 70%; margin-bottom: 1%">Reset Password</button></a></center></td>
                               </tr>
                               @endforeach
                            @else
                                <td colspan="5"><center>KOSONG</center></td>
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