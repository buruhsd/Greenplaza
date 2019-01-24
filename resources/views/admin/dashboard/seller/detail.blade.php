@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Seller Transaksi Detail</h3>
			</div>
			<form action="#" method="GET">
                <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                    <div class="input-group pull-left" style="width: 225px;">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search by seller id ..." name="search" value="" autocomplete="off" id="search_table_currency">
                    </div>
                </div> 
            </form>
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
                            @if($detailseller->count() > 0)
                                @foreach ($detailseller as $d)
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

                                	<td><center><a href="{{route('admin.needapproval.changepassword_seller', $d->trans->pembeli->id)}}"><button type="submit" class="btn btn-success btn-rounded" style="width: 70%; margin-bottom: 1%">Reset Password</button></a></center></td>
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