@extends('layouts.index', ['active' => 'detail'])
@section('title', 'Detail')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Checkout</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-form p-10 border">
                        <h2 class="section-title">Billing Details</h2>
                        <form action="checkout">
                            <div class="row">
                                <div class="col-12">
                                    <div class="large-12 medium-12 small-12 columns">
                                    </div>
                                    <div class="large-6 medium-6 small-12 columns">
                                        <label>Kode Transaksi Anda</label>
                                        <h2></h2>
                                    </div>
                                    <div class="large-6 medium-6 small-12 columns">
                                        <?php 
                                        echo '
                                        Tagihan : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount')).' <br>
                                        Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_ship')).' <br>
                                        Kode Unik :  <br>
                                        <label style="color:#999;">Kode Unik berguna untuk memudahkan admin melakukan pengecekan transfer anda.</label>
                                        <br>
                                        <label>Jumlah yang harus ditransfer</label>
                                        <h2 style="">Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')).'</h2>
                                        ';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <h3>METODE PEMBAYARAN</h3>
                                        </div>

                                        <div class="col-6">
                                            <div class="large-12 columns text-center" id="box_pembayaran">
                                                <input type="radio" name="payment_method" value="0" id="metode_pembayaran_transfer">
                                                Transfer Bank<br>
                                                <small>Verifikasi manual maksimal 2 x 24 jam</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="large-12 columns text-center" id="box_pembayaran">
                                                <input type="radio" name="payment_method" value="0" id="metode_pembayaran_transfer">
                                                Midtrans<br>
                                                <small>Verifikasi manual maksimal 2 x 24 jam</small>
                                            </div>
                                        </div>
                                        <div class="col-4" hidden>
                                            <div class="large-12 columns text-center" id="box_pembayaran">
                                                <input type="radio" name="payment_method" value="1" id="metode_pembayaran_cw_trans">
                                                Gunakan Saldo CW Transaksi<br>
                                                <small>Verifikasi otomatis</small>
                                            </div>
                                        </div>
                                        <div class="col-4" hidden>
                                            <div class="col-12 text-center" id="box_pembayaran">
                                                <input type="radio" name="payment_method" value="2" id="metode_pembayaran_cw_bonus">
                                                Gunakan Saldo CW Bonus<br>
                                                <small>Verifikasi otomatis</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{-- <input type="submit" name="save_order" id="save_order" class="btn btn-success" value="Place Order" /> --}}
                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Place Order" class="btn btn-success" id="btn-pick-address" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    function process_payment(){
        var text = $("#btn-choose-shipment").val();
        $("#btn-choose-shipment").val("Loading");
        $.ajax({
            type: "POST", // or post?
            url: "{{route("localapi.midtrans.process")}}", // change as needed
            data: $("#form-shipment").serialize(), // change as needed
            success: function(data) {
                if (data) {
                    $('#shipment-price').empty().append(data);
                } else {
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }
                $("#btn-choose-shipment").val(text);
            },
            error: function(xhr, textStatus) {
                swal({
                    type: "error",
                    title: "failed",   
                    text: "Layanan Tidak Tersedia",   
                    showConfirmButton: false ,
                    showCloseButton: true,
                    footer: ''
                });
                $("#btn-choose-shipment").val(text);
            }
        });
    }
</script>
@endsection