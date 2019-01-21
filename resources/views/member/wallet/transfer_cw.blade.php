@extends('member.index')
@section('get penjual', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Transfer CW</h3>
</div>
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Transfer</h4>
    </div>
    <div class="panel-body">
        {!! Form::open(['url' => route('member.wallet.transfer_cw'), 'id' => 'wizardForm', 'class' => 'form-horizontal', 'files' => true]) !!}
            <div class="form-group">
                <label class="col-sm-3 control-label">Withdrawal Saldo</label>
                <div class="col-sm-9">
                    <select name="wallet_type" style="margin-bottom:15px;" class="form-control">
                        @foreach($type as $item)
                            <option value="{{$item->id}}">{{ucfirst(strtolower(str_replace('_', ' ', $item->wallet_type_name)))}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Transfer ke { Username }</label>
                <div class="col-sm-9">
                    <select name="username" class="combobox form-control">
                        <option></option>
                        @foreach($user as $item)
                            <option value="{{$item->username}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="input-Default" class="col-sm-3 control-label">Input Saldo CW</label>
                <div class="col-sm-9">
                    <input name="wallet_amount" type="text" class="form-control" id="input-Default">
                </div>
            </div>
            <div class="form-group">
                <label for="input-help-block" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input name="password" type="text" class="form-control" id="input-default">
                    
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Transfer</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
        