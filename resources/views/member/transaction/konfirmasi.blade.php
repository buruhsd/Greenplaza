@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pembayaran</h3>
</div>
@if(!$trans->first()->trans_seller_note)
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="large-6 medium-6 small-12 columns">
                    </div>
                    <div class="large-6 medium-6 small-12 columns">
                        <button class="btn btn-default" data-toggle="modal" data-target="#pesanModal">Pesan ke Seller</button>
                    </div>
                        
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@else($trans->first()->trans_seller_note == 1)
@endif
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="large-6 medium-6 small-12 columns">
                        <label>Transaksi Anda</label>
                        <h2></h2>
                    </div>
                    <div class="large-6 medium-6 small-12 columns">
                        <p><b>#note</b> : jika anda sudah melakukan transfer dan status transaksi anda masih belum berubah, tinggu <b>1 X 24 jam</b>. jika status transaksi anda masih belum berubah silahkan hubungi admin greenplaza di <b>admin@greenplaza.me</b></p>
                        <?php 
                        echo '
                        Tagihan : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount')).' <br>
                        Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_ship')).' <br>
                        Kode Unik :  <b>'.$trans->first()->trans_code.'</b><br>
                        <label style="color:#999;">Kode Unik berguna untuk memudahkan admin melakukan pengecekan transaksi anda.</label>
                        <br>
                        ';
                        ?>

                        @if($trans->first()->voucher())
                            <span class="text-danger">Voucher : Rp. {{FunctionLib::number_to_text($trans->first()->voucher()->trans_voucher_amount)}}</span><br>
                            <label>Jumlah yang harus ditransfer</label>
                            <h2 style="">Rp. {{FunctionLib::number_to_text(FunctionLib::minus_to_zero(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total')-$trans->first()->voucher()->trans_voucher_amount))}}
                            @if($trans->first()->trans_payment_id == 4)
                                <?php 
                                $amount_total = FunctionLib::minus_to_zero(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total')-$trans->first()->voucher()->trans_voucher_amount);
                                $amount = FunctionLib::minus_to_zero(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount')-$trans->first()->voucher()->trans_voucher_amount);
                                // $amount_total = FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total');
                                if($amount_total > 0 && $amount > 0){
                                    $amount = FunctionLib::minus_to_zero(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount'-$trans->first()->voucher()->trans_voucher_amount));
                                    // $amount = FunctionLib::array_sum_key($trans->toArray(), 'trans_amount');
                                    $fee = ($amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                                    $fix = (($amount_total+$fee) / FunctionLib::gln('compare',[])['data']);
                                }elseif($amount > 0){
                                    $amount = FunctionLib::minus_to_zero(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount'-$trans->first()->voucher()->trans_voucher_amount));
                                    $fee = ($amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                                    $fix = (($amount_total+$fee) / FunctionLib::gln('compare',[])['data']);
                                }else{
                                    $amount = 0;
                                    $fee = ($amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                                    $fix = (($amount_total+$fee) / FunctionLib::gln('compare',[])['data']);
                                }
                                ?>
                                / Gln. {{FunctionLib::number_to_text($fix, 8)}} <small class="text-danger">(Bisa Berubah Setiap Saat)</small>
                            @endif
                        @else
                            <label>Jumlah yang harus ditransfer</label>
                            <h2 style="">Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total'))}}
                            @if($trans->first()->trans_payment_id == 4)
                                <?php 
                                $amount_total = FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total');
                                $amount = FunctionLib::array_sum_key($trans->toArray(), 'trans_amount');
                                $fee = ($amount*(FunctionLib::get_config('price_pajak_admin_gln'))/100);
                                $fix = (($amount_total+$fee) / FunctionLib::gln('compare',[])['data']);
                                ?>
                                / Gln. {{FunctionLib::number_to_text($fix, 8)}} <small class="text-danger">(Bisa Berubah Setiap Saat)</small>
                            @endif
                        @endif
                        </h2>
                    </div>
                        @if($trans->first()->trans_payment_id == 4)
                            <hr/>
                            <span class="text-danger">Harga sudah termasuk fee 10% dari harga produk.</span>
                        @endif
                    <hr>
                    @switch($trans->first()->trans_payment_id)
                        @case(1)
                        @break
                        @case(2)
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.re_payment", $trans->first()->trans_code)}} value="Bayar" class="btn btn-success" id="btn-pick-address" />
                        @break
                        @case(3)
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.qr", $trans->first()->trans_code)}} value="Bayar" class="btn btn-success" id="btn-pick-address" />
                        @break
                        @case(4)
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.gln.re_payment", $trans->first()->trans_code)}} value="Bayar" class="btn btn-success" id="btn-pick-address" />
                        @break
                    @endswitch
                    {{-- <input type="submit" name="save_order" id="save_order" class="btn btn-success" value="Place Order" /> --}}
                    {{-- <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.re_payment_id", $trans->id)}} value="Pay" class="btn btn-success" id="btn-pick-address" /> --}}
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@include('member.transaction.note_seller')
@endsection
@section('script')
<script type="text/javascript">
    $('#ajax-modal').on('hidden.bs.modal', function () {
        var dataurl = "{{ route('member.transaction.purchase',['status'=>'order'])}}";
        window.location = dataurl;
    });
</script>
@endsection