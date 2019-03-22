@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pembayaran dengan Masedi</h3>
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
                    <ul class="list-group">
                        <li class="list-group-item no-border">
                            <a class="btn btn-info btn-block" data-toggle="collapse" href="#grosir" role="button" aria-expanded="false" aria-controls="grosir"><b>Bayar</b></a>
                            <div id="grosir" class="collapse">
                                <table class="table table-bordered table-striped table-highlight m-t-xs">
                                    <tbody id="grosir_row">
                                        <tr>
                                            <td>
                                            @if(empty($trans->trans_hotlist_qr))
                                                <a href='{{route("member.hotlist.generate_qr", $trans->id)}}' class="btn btn-success" >Generate</a>
                                                <i class="fa fa-arrow-right"></i>
                                            @endif
                                                <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href='{{route("localapi.masedi.qr_hotlist", $trans->trans_hotlist_code)}}' value="Bayar" class="btn btn-success" id="btn-pick-address" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
        