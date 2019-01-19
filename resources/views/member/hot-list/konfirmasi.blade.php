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
                        <?php 
                        echo '
                        Kode Order : <b>'.$trans->trans_hotlist_code.'</b> <br>
                        Tagihan : Rp '.FunctionLib::number_to_text($trans->trans_hotlist_amount).' <br>
                        Paket Hot List : '.$trans->paket->paket_hotlist_name.' <br>
                        <br>
                        <label>Tagihan pembelian hot list sebesar: </label>
                        <h2 style="">Rp '.FunctionLib::number_to_text($trans->trans_hotlist_amount).'</h2>
                        ';
                        ?>
                    </div>
                    <hr>
                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.hotlist_payment", $trans->trans_hotlist_code)}} value="Pay" class="btn btn-success" id="btn-pick-address" />
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
        