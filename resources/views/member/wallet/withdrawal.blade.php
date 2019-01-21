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
@endsection
        