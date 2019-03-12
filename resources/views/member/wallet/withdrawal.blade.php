@extends('member.index')
@section('get penjual', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Withdrawal</h3>
</div>
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Withdrawal</h4>
    </div>
    <div class="panel-body">
        {!! Form::open(['url' => route('member.wallet.withdrawal'), 'id' => 'wizardForm', 'class' => 'form-horizontal', 'files' => true]) !!}
            <div class="form-group">
                <label class="col-sm-2 control-label">Withdrawal Saldo</label>
                <div class="col-sm-10">
                    <select name="withdrawal_wallet_type" style="margin-bottom:15px;" class="form-control">
                        @foreach($type as $item)
                            <option value="{{$item->id}}">{{ucfirst(strtolower(str_replace('_', ' ', $item->wallet_type_name)))}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="input-Default" class="col-sm-2 control-label">Input Saldo CW</label>
                <div class="col-sm-10">
                    <input type="text" name="withdrawal_wallet_amount" class="form-control" id="input-Default">
                </div>
            </div>
            <div class="form-group">
                <label for="input-help-block" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="input-default">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Withdrawal</button>
        {!! Form::close() !!}
    </div>
</div>
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">History Withdrawal</h4>
        </div>
        <div class="panel-body">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><center>No</center></th>
                                <th><center>Nama</center></th>
                                <th><center>Wallet_id</center></th>
                                <th><center>Transaksi</center></th>
                                <th><center>Jumlah Transaksi</center></th>
                                <th><center>Status</center></th>
                                <th><center>Detail</center></th>
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
                                <td><center>Approve</center></td>
                                @elseif($w->withdrawal_status == 1)
                                <td><center>Belum Approve</center></td>
                                
                                @endif
                                <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$w->id}}"><i class="fa fa-edit"></i>Detail Transaksi</button></td>
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
    @include('admin.need_approval.withdrawal.detail_withdraw_appv')
@endsection
        