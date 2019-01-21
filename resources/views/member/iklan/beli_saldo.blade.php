@extends('member.index')
@section('pasang iklan', 'active-page')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Beli Saldo Iklan </h3>
</div>
<div class="panel panel-white">
    <div class="panel-body">
        {!! Form::open(['url' => route('member.iklan.beli_saldo_store'), 'id' => 'wizardForm', 'files' => true]) !!}
            <div class="tab-content">
                <div class="tab-pane active fade in" id="tab1">
                    <div class="row m-b-lg">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail">Pilih Paket</label>
                                    <select class="form-control" id="sel1" name="trans_iklan_paket_id">
                                        @foreach($paket as $item)
                                            <option value="{{$item->id}}">
                                                {{$item->paket_iklan_name}} 
                                                | Rp. {{FunctionLib::number_to_text($item->paket_iklan_price)}}
                                                {{-- | {{intval($item->paket_hotlist_amount)}} Poin
                                                | Bonus {{intval($item->paket_hotlist_bonus)}} Poin --}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="trans_iklan_note">Keterangan</label>
                                    <textarea class="form-control" name="trans_iklan_note" placeholder="Keterangan" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Info</h3>
                            <h4>Saldo Iklan Anda : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_saldo(4))}}</b></h4>
                            <p>Harga iklan saat : <br>
                            Iklan Baris : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_baris'))}}</b><br>
                            Iklan Banner : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_banner'))}}</b><br>
                            Iklan Banner Khusus : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_banner_khusus'))}}</b><br>
                            Iklan Slider : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_slider'))}}</b><br></p>

                            <p>Diskon 15% untuk pembelian saldo minimal Rp 500.000,00, atau setelah akumulasi pembelian mencapai Rp 1.500.000,00 (* </p><br>

                            <p>Dapatkan bonus cakra point yang dapat digunakan untuk bermain di cakragames. Menangkan hadiah-hadiah menarik dari CAKRAGAMES. Nilai bonus saat ini adalah Rp 2.000,00 mendapatkan 1 Cakra Point.</p>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Beli</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
                                   
        
                                        
                                           

                                