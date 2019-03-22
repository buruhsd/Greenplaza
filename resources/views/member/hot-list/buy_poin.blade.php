@extends('member.index')
@section('hot list', 'active-page')
@section('content')
<div class="page-title">
<h3 class="breadcrumb-header">Beli Poin Hot List </h3>
</div>
<div class="panel panel-white">
    <div class="panel-body">
    {{-- <div class="panel-heading clearfix">
        <h4 class="panel-title">Saldo Hot List Anda : nominal e hehe</h4>
    </div>
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Kurs Hot List Saat Ini : nominal e hehe</h4>
    </div> --}}
        {!! Form::open(['url' => route('member.hotlist.buy_poin_store'), 'id' => 'wizardForm', 'files' => true]) !!}
            <div class="tab-content">
                <div class="tab-pane active fade in" id="tab1">
                    <div class="row m-b-lg">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <a href="{{route('member.hotlist.tagihan')}}" class="btn btn-xs btn-info pull">Tagihan</a>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="trans_hotlist_paket_id">Paket Hot List</label>
                                    <select class="form-control" id="trans_hotlist_paket_id" name="trans_hotlist_paket_id">
                                        @foreach($paket as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->paket_hotlist_name}} 
                                                | Rp. {{FunctionLib::number_to_text($item->paket_hotlist_price)}}
                                                | {{intval($item->paket_hotlist_amount)}} Poin
                                                | Bonus {{intval($item->paket_hotlist_bonus)}} Poin
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="trans_hotlist_payment_id">Pembayaran</label>
                                    <select class="form-control" id="trans_hotlist_payment_id" name="trans_hotlist_payment_id">
                                        @foreach($payment as $item)
                                            <option value="{{$item->id}}">
                                                {{ucfirst($item->payment_name)}} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password Transaksi</label>
                                    <input type="password" class="form-control col-md-6" name="user_detail_pass_trx" id="user_detail_pass_trx" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Beli</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
                                   
        
                                        
                                           

                                