@extends('frontend.layout.indexall')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity" style="background-image: url('../frontend/images/banner/checkout.png'); width:100%;">
                            <h2>Checkout</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
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
                        <h2 class="section-title">Detail Belanjaan</h2>
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
                                        $diskon = FunctionLib::sum_cart_diskon(Session::get('chart'));
                                        $total = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');
                                        $total = ($diskon > 0)?'Rp '.FunctionLib::number_to_text($total-$diskon).' / <span class="text-danger"><del>Rp '.FunctionLib::number_to_text($total).'</del></span>':'Rp '.FunctionLib::number_to_text($total);
                                        $diskon = ($diskon > 0)? "<br/>Total diskon : <span class='text-danger'>Rp.".$diskon."</span>":"";
                                        echo '
                                        Tagihan : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount')).$diskon.' <br>
                                        Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_ship')).' <br>
                                        Kode Unik :  <br>
                                        <label style="color:#999;">Kode Unik berguna untuk memudahkan admin melakukan pengecekan transfer anda.</label>
                                        <br>
                                        <label>Jumlah yang harus ditransfer</label>
                                        <h2 style="">'.$total.'</h2>
                                        ';
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- <hr> -->
                            <div class="row" hidden>
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
                            <!-- <div class="form-group mx-sm-3 mb-2">
                                <div class="row" data-toggle="buttons">
                                    <div class="col-md-6">
                                        <label class="btn btn-info btn-block" data-toggle="collapse" data-target="#midtrans" aria-expanded="true" aria-controls="midtrans">
                                            <input type="radio" name="komplain_komplain_id" value="1" autocomplete="off">
                                            Midtrans <span class="check glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="btn btn-info btn-block" data-toggle="collapse" data-target="#masedi" aria-expanded="true" aria-controls="masedi">
                                            <input type="radio" name="komplain_komplain_id" value="1" autocomplete="off">
                                            MasEdi <span class="check glyphicon glyphicon-ok"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Pesan" class="btn btn-success" id="btn-pick-address" /> -->
                            <!-- <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.payment")}} value="Pesan" class="btn btn-success" id="btn-pick-address" /> -->
                            <!-- <input type="submit" name="save_order" id="save_order" class="btn btn-success" value="Place Order" /> -->
                            <!-- <div id="midtrans" class="collapse">
                                <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Pesan" class="btn btn-success" id="btn-pick-address" />
                            </div>
                            <div id="masedi" class="collapse">
                                <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Pesan" class="btn btn-success" id="btn-pick-address" />
                            </div> -->
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="payment" class="sr-only">Pembayaran</label>
                                <select class="form-control" id="payment">
                                    <option value="">Pilih Pembayaran</option>
                                    @foreach($payment as $item)
                                        <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment']) && $_GET['payment'] == "")?"selected":"" !!}>{{ucfirst(strtolower($item->payment_name))}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="payment_hide payment_Me collapse">
                                <hr/>
                                <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.payment")}} value="Pesan" class="btn btn-success" />
                            </div>
                            <div class="payment_hide payment_Mt collapse">
                                <hr/>
                                <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Pesan" class="btn btn-success" />
                            </div>
                            <div class="payment_hide payment_Tf collapse">
                                <hr/>
                                Cooming Soon.
                            </div>
                            <!-- <div class="payment_hide payment_Gln collapse">
                                <hr/>
                                Cooming Soon.
                            </div> -->
                            <div class="payment_hide payment_Gln collapse">
                                <hr/>
                                @if(Auth::user()->wallet()->where('wallet_type', 7)->exists())
                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.gln.payment")}} value="Pesan" class="btn btn-success" />
                                @else
                                    Anda belum memiliki akun gln. buat akun gln disini : <a id="saldo_gln" class="btn btn-info btn-xs" href="{{route('member.wallet.create_gln')}}">
                                                Buat
                                            </a>
                                @endif
                            </div>
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
    window.onload = function() {
        //on change hide all divs linked to select and show only linked to selected option
        $('#payment').change(function(){
            //Saves in a variable the wanted div
            var selector = '.payment_' + $(this).val();

            //hide all elements
            $('.payment_hide').collapse('hide');

            //show only element connected to selected option
            $(selector).collapse('show');
        });
    }
</script>
@endsection