@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Seller Transaksi Pincode</h3>
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
                                    <th><center>Detail</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($pinseller->count() > 0)
                                @foreach ($pinseller as $d)
                               <tr>
                                    <td><center>{{$d->user->id}}</center></td>
                                    <td><center>{{$d->user->name}}</center></td>
                                    <td><center></center></td>

                                @if ($d->trans_hotlist_status == 0)
                                    <td><center>Baru</center></td>
                                @elseif ($d->trans_hotlist_status == 1)
                                    <td><center>Konfirmasi (paid)</center></td>
                                @elseif ($d->trans_hotlist_status == 2)
                                    <td><center>Batal</center></td>
                                @elseif ($d->trans_hotlist_status == 3)
                                    <td><center>Approve Admin</center></td>
                                @elseif ($d->trans_hotlist_status == 4)
                                    <td><center>Ditolak</center></td>
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