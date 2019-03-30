@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pembayaran dengan Gln</h3>
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
                        Kode Order : <b>'.$trans->trans_iklan_code.'</b> <br>
                        Tagihan : Rp '.FunctionLib::number_to_text($trans->trans_iklan_amount).' <br>
                        Paket Hot List : '.$trans->paket->paket_iklan_name.' <br>
                        <br>
                        <label>Tagihan pembelian hot list sebesar: </label>
                        ';
                        ?>
                        <h2 style="">Rp. {{FunctionLib::number_to_text($trans->trans_iklan_amount)}}
                            @if($trans->trans_iklan_payment_id == 4)
                                <?php
                                $fix = ($trans->trans_iklan_amount / FunctionLib::gln('compare',[])['data']);
                                ?>
                                / Gln. {{FunctionLib::number_to_text($fix, 8)}} <small class="text-danger">(Bisa Berubah Setiap Saat)</small>
                            @endif
                        </h2>
                    </div>
                    <hr>
                    <button class="btn btn-success" id="pay" data-href='{{route("member.iklan.bayar_gln", $trans->trans_iklan_code)}}'>Bayar</button>
                    <a class="btn btn-warning hide" id="back" href='{{route("member.iklan.tagihan")}}'><i class="fa fa-arrow-left"></i> Kembali ke halaman tagihan</a>
                    <!-- <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href='{{route("member.iklan.bayar_gln", $trans->trans_iklan_code)}}' value="Pay" class="btn btn-success" id="btn-pick-address" /> -->
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
                $.post($('#pay').data('href'), {"_token": "{{ csrf_token() }}"}, function( data ) {
                    var status = (data.status == 200)?'success':'error';
                    if((data.status == 200)){
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
        