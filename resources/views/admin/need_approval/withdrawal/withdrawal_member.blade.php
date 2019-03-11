@extends('admin.index')
@section('need approval', 'active-page')
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
                        <div class="input-group pull-left">
                            <select id="select-withdrawal" type="text" class="form-control">
                                <option value="">--Choose Option List--</option>
                                <option value="/admin/needapproval/withdrawal_member">Withdrawal Member</option>
                                <option value="/admin/needapproval/withdrawal_seller">Withdrawal Seller</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User_id</th>
                                    <th>Wallet_id</th>
                                    <th>Wallet_type</th>
                                    <th>Wallet_amount</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @if($with->count() > 0)
                                @foreach ($with as $key => $w)
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
                                    
                                    @endif
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$w->id}}"><i class="fa fa-edit"></i>Detail Transaksi</button></td>
                                    <td>
                                    @if($w->withdrawal_status == 0)
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalappv">Approve</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Reject</button></center>
                                    @elseif($w->withdrawal_status == 1)
                                    
                                    @endif
                                         <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Alasan Withdrawal Ditolak</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="{{route('admin.needapproval.withdrawal_member_reject', $w->id)}}" method="POST" id="usrform">
                                                {{ csrf_field() }}
                                              <div class="modal-body">
                                                <textarea rows="4" cols="75"  name="comment" form="usrform">
                                                </textarea>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Kirim Alasan</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal fade" id="exampleModalappv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Masukkan Nomor Referensi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form action="{{route('admin.needapproval.withdrawal_member_appv', $w->id)}}" method="POST" id="usrform">
                                                {{ csrf_field() }}
                                              <div class="modal-body">
                                                    <input type="text" class="form-control" name="no_ref">

                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                 @endforeach
                            @else
                                <td colspan="9"><center>KOSONG</center></td>
                            @endif
                            </tbody>

                        </table>
                        {{$with->render()}}
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