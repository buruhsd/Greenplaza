@extends('admin.index')
@section('monitoring', 'active-page')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix" style="margin-bottom: 2%">
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form action="#" method="GET">
                                <div class="input-group pull-right" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="input-group pull-left">
                            <select id="select-withdrawal" type="text" class="form-control">
                                <option value="">--Choose Option List--</option>
                                <option value="/admin/needapproval/withdrawal_member">Withdrawal Member</option>
                                <option value="/admin/needapproval/withdrawal_seller">Withdrawal Seller</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>User_id</center></th>
                                    <th><center>Wallet_id</center></th>
                                    <th><center>Wallet_type</center></th>
                                    <th><center>Wallet_amount</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Detail</center></th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                            @if($log_wd->count() > 0)
                                @foreach ($log_wd as $key => $w)
                                <tr>
                                    <td><center>{{++$key}}</center></td>
                                    <td><center>{{$w->user->username}}</center></td>
                                    <td><center>{{$w->withdrawal_wallet_id}}</center></td>
                                    <td><center>{{$w->type->wallet_type_name}}</center></td>
                                    <td><center>{{$w->withdrawal_wallet_amount}}</center></td>
                                    @if($w->withdrawal_status == 0)
                                    <td><center>Belum Approve</center></td>
                                    @elseif($w->withdrawal_status == 1)
                                    <td><center>Approve</center></td>
                                    @elseif($w->withdrawal_status == 2)
                                    <td><center>Reject</center></td>
                                    @endif
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$w->id}}"><i class="fa fa-edit"></i>Detail Transaksi</button></td>
                                </tr>
                                 @endforeach
                            @else
                                <td colspan="9"><center>KOSONG</center></td>
                            @endif
                            </tbody>

                        </table>
                        {{$log_wd->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>
@include('admin.need_approval.withdrawal.detail_withdraw_appv')
@endsection
@section('script')
<script type="text/javascript">
  $('#select-withdrawal').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection