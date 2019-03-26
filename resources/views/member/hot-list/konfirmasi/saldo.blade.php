@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pembayaran dengan Saldo</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="large-6 medium-6 small-12 columns">
                        <?php 
                        echo '
                        Kode Order : <b>'.$trans->trans_hotlist_code.'</b> <br>
                        Tagihan : Rp '.FunctionLib::number_to_text($trans->trans_hotlist_amount).' <br>
                        Paket Hot List : '.$trans->paket->paket_hotlist_name.' <br>
                        <br>
                        <label>Tagihan pembelian hot list sebesar: </label>
                        ';
                        ?>
                        <h2 style="">Rp. {{FunctionLib::number_to_text($trans->trans_hotlist_amount)}}</h2>
                    </div>
                    <hr>
                    <div class="col-md-6" id="form-type">
                        {!! Form::open(['id' => 'form-pay-hotlist']) !!}
                            @csrf
                            <select name="wallet_type" class="form-control">
                                <option value="1">Cash Wallet (CW)</option>
                                <option value="3">Transaksi</option>
                            </select>
                        {!! Form::close() !!}
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" id="pay" data-href='{{route("member.hotlist.bayar_saldo", $trans->trans_hotlist_code)}}'>Bayar</button>
                    </div>
                    <a class="btn btn-warning hide" id="back" href='{{route("member.hotlist.tagihan")}}'><i class="fa fa-arrow-left"></i> Kembali ke halaman tagihan</a>
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
    $('#pay').click(function(e){
        swal({
            title: 'Ingin lanjut membayar?',
            text: "Klik Bayar untuk lanjut membayar!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Bayar!'
        }).then((isConfirm) => {
            if (isConfirm.value){
                $.post($('#pay').data('href'), $("#form-pay-hotlist").serialize(), function( data ) {
                    var status = (data.status == 200)?'success':'error';
                    if((data.status == 200)){
                        $("#form-type").hide();
                        $('#pay').hide();
                        $('#back').removeClass('hide');
                    }
                    swal("notifikasi!", data.message, status);
                });
            } else {
                swal("Batal", "Pembayaran dibatalkan", "error");
                e.preventDefault();
            }
        });
    });
</script>
@endsection
        