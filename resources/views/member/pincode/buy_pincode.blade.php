@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Beli Pin Code </h3>
</div>
<div class="panel panel-white">
    <div class="panel-body">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Saldo Pin Code Anda : <b>{{intval(FunctionLib::get_saldo(5))}} point</b></h4>
        </div>
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Kurs Pin Code Saat Ini : <b>{{FunctionLib::get_config('price_kurs_pin_code')}} point</b></h4>
            <h4 class="panel-title">PIN Code digunakan untuk memasang link ke website halaman pribadi anda pada iklan baris atau banner</h4>
        </div>
        {!! Form::open(['url' => route('member.pincode.buy_pincode_store'), 'id' => 'wizardForm', 'files' => true]) !!}
        <div class="tab-content">
            <div class="tab-pane active fade in" id="tab1">
                <div class="row m-b-lg">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="trans_pincode_paket_id">Paket Pin Code</label>
                                <select class="form-control" id="trans_pincode_paket_id" name="trans_pincode_paket_id">
                                    @foreach($paket as $item)
                                        <option value="{{$item->id}}">
                                            {{$item->paket_pincode_name}} 
                                            | Rp. {{FunctionLib::number_to_text($item->paket_pincode_price)}}
                                            - {{intval($item->paket_pincode_amount)}} Pin Code
                                            , Bonus {{intval($item->paket_pincode_bonus)}} Pin Code
                                        </option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_detail_pass_trx">Password Transaksi</label>
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
                                   
        
                                        
                                           

                                