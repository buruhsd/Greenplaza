@extends('admin.index')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            <div class="page-title">
			    <h4 class="breadcrumb-header">Manage Member Transaksi Iklan</h3>
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
                    <option value="">--Choose Option List--</option>
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
                                    <th><center>Member Id</center></th>
                                    <th><center>Nama</center></th>
                                    <th><center>Tagihan</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($iklanmember->count() > 0)
                                @foreach ($iklanmember as $d)
                               <tr>
                                    <td><center>{{$d->user->id}}</center></td>
                                    <td><center>{{$d->user->name}}</center></td>
                                    <td><center>{{$d->trans_iklan_amount}}</center></td> 

                                @if ($d->trans_hotlist_status == 0)
                                    <td><center><button class="btn btn-success btn-xs">Baru</button></center></td>
                                @elseif ($d->trans_hotlist_status == 1)
                                    <td><center><button class="btn btn-success btn-xs">Konfirmasi (paid)</button></center></td>
                                @elseif ($d->trans_hotlist_status == 2)
                                    <td><center><button class="btn btn-success btn-xs">Batal</button></center></td>
                                @elseif ($d->trans_hotlist_status == 3)
                                    <td><center><button class="btn btn-success btn-xs">Approve Admin</button></center></td>
                                @elseif ($d->trans_hotlist_status == 4)
                                    <td><center><button class="btn btn-success btn-xs">Ditolak</button></center></td>
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