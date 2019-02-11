@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pembayaran</h3>
</div>
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
                        <?php 
                        echo '
                        Tagihan : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount')).' <br>
                        Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_ship')).' <br>
                        Kode Unik :  <b>'.$trans->first()->trans_code.'</b><br>
                        <label style="color:#999;">Kode Unik berguna untuk memudahkan admin melakukan pengecekan transfer anda.</label>
                        <br>
                        <label>Jumlah yang harus ditransfer</label>
                        <h2 style="">Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key($trans->toArray(), 'trans_amount_total')).'</h2>
                        ';
                        ?>
                    </div>
                    <hr>
                    @switch($trans->first()->trans_payment_id)
                        @case(1)
                        @break
                        @case(2)
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.re_payment", $trans->first()->trans_code)}} value="Pay" class="btn btn-success" id="btn-pick-address" />
                        @break
                        @case(3)
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.qr", $trans->first()->trans_code)}} value="Pay" class="btn btn-success" id="btn-pick-address" />
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
@endsection
@section('script')
<script type="text/javascript">
    $('#ajax-modal').on('hidden.bs.modal', function () {
        var dataurl = "{{ route('member.transaction.purchase',['status'=>'order'])}}";
        window.location = dataurl;
    });
</script>
@endsection