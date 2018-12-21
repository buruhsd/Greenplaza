@extends('admin.index')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form action="#" method="GET">
                            <div class="input-group pull-right" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                            </div>
                        </form>
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
                                    <th>Response_text</th>
                                    <th>Response_date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($with as $key => $w)
                            <tbody>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$w->user->username}}</td>
                                    <td>{{$w->withdrawal_wallet_id}}</td>
                                    <td>{{$w->withdrawal_wallet_type}}</td>
                                    <td>{{$w->withdrawal_amount}}</td>
                                    <td>{{$w->withdrawal_status}}</td>
                                    <td>{{$w->withdrawal_response_text}}</td>
                                    <td>{{$w->withdrawal_response_date}}</td>
                                    <td>
                                        <a href=""><button type="submit" class="btn btn-success">Approve</button></a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Reject</button>
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
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {{$with->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection
