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
                <div class="single-product-menu">
                    <div class="checkout-form p-10 border">
                        <h2 class="section-title">Detail Belanjaan</h2>
                        <form action="checkout">
                            <div class="row">
                                <div class="col-12">
                                    <div class="large-12 medium-12 small-12 columns">
                                    </div>
                                    <?php 
                                        $show_harga = 0;
                                        $show_harga_idr = 0;
                                        $show_shipment = 0;
                                        $show_harga_grosir_total = 0; 
                                        $show_harga_diskon_total = 0; 
                                        $show_harga_total = 0; 
                                        $show_harga_total_idr = 0; 
                                        $show_grosir = 0;
                                    ?>
                                    @if(Session::has('chart'))
                                        <div class="large-6 medium-6 small-12 columns">
                                            <label>Kode Transaksi Anda</label>
                                            <h2></h2>
                                        </div>
                                        <div class="large-6 medium-6 small-12 columns">
                                            @foreach(Session::get('chart') as $key => $item)
                                                <?php
                                                    $harga_grosir = 0;
                                                     $produk = App\Models\Produk::where('id', $item['trans_detail_produk_id'])->first(); 
                                                    $harga = $produk->produk_price;
                                                    $harga_idr = $produk->price_idr;
                                                    $is_grosir = false;
                                                    if($produk->is_grosir()){
                                                        $where = 'produk_grosir_start <= '.(int)$item['trans_detail_qty'].' AND produk_grosir_end >= '.(int)$item['trans_detail_qty'];
                                                        $grosir = $produk->grosir()->whereRaw($where);
                                                        if($grosir->count()){
                                                            $harga = (float)$grosir->first()->produk_grosir_price;
                                                            $harga_idr = (float)$grosir->first()->produk_grosir_price;
                                                            $is_grosir = true;
                                                            $harga_grosir = $produk->produk_price - $harga;
                                                            $harga_grosir_idr = $produk->price_idr - $harga_idr;
                                                        }
                                                    }
                                                    $diskon = ($produk['produk_discount'] > 0)?true:false;
                                                    $harga = $harga * (int)$item['trans_detail_qty'];
                                                    $harga_idr = $harga_idr * (int)$item['trans_detail_qty'];
                                                    $harga_grosir = (int)$harga_grosir * (int)$item['trans_detail_qty'];
                                                    $harga_grosir_idr = (int)$harga_grosir * (int)$item['trans_detail_qty'];
                                                    $harga_total = $harga+(float)$item['trans_detail_amount_ship'];
                                                    $harga_total_idr = $harga_idr+(float)$item['trans_detail_amount_ship'];
                                                    if($diskon){
                                                        $harga = $harga-($harga*$produk['produk_discount']/100);
                                                        $harga_idr = $harga_idr-($harga_idr*$produk['produk_discount']/100);
                                                        $harga_total = $harga+$item['trans_detail_amount_ship'];
                                                        $harga_total_idr = $harga_idr+$item['trans_detail_amount_ship'];
                                                    }
                                                    $show_grosir += (float)$harga_grosir;
                                                    $show_harga += (float)$harga;
                                                    $show_harga_idr += (float)$harga_idr;
                                                    $show_shipment += (float)$item['trans_detail_amount_ship'];
                                                    $show_harga_total += (float)$harga_total;
                                                    $show_harga_total_idr += (float)$harga_total_idr;
                                                ?>
                                            @endforeach
                                            @if($type == 'idr')
                                                <?php 
                                                    $diskon = "";
                                                    $total = 'Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_idr'));
                                                    if(Session::has('chart')){
                                                        $diskon = FunctionLib::sum_cart_diskon(Session::get('chart'));
                                                        $total = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');
                                                        $total = ($diskon > 0)?'Rp '.FunctionLib::number_to_text($total-$diskon).' / <span class="text-danger"><del>Rp '.FunctionLib::number_to_text($total).'</del></span>':'Rp '.FunctionLib::number_to_text($total);
                                                        $diskon = ($diskon > 0)? "<br/>Total diskon : <span class='text-danger'>Rp.".$diskon."</span>":"";
                                                    }
                                                    echo '
                                                    Tagihan : Rp '.FunctionLib::number_to_text($show_harga_idr+FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_idr')-$show_harga_total_idr).' 
                                                    <br/><span class="text-danger">Grosir : Rp.'.FunctionLib::number_to_text($show_grosir).'</span><br>
                                                    <span class="text-danger">Diskon : Rp.'.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_idr')-$show_harga_total_idr-$show_grosir).'</span><br>
                                                    Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_ship')).' <br>';
                                                    if(Session::has('voucher')){
                                                        $voucher = Session::get('voucher');
                                                        echo '<span class="text-danger">Voucher : Rp.'.FunctionLib::number_to_text($voucher['amount']).'</span>'.' <br>';
                                                        echo '
                                                        <label>Jumlah yang harus ditransfer</label>
                                                        <h2 style="">Rp. '.FunctionLib::number_to_text(FunctionLib::minus_to_zero($show_harga_total_idr-$voucher['amount'])).'</h2>
                                                        ';
                                                    }else{
                                                        echo '
                                                        <label>Jumlah yang harus ditransfer</label>
                                                        <h2 style="">Rp. '.FunctionLib::number_to_text($show_harga_total_idr).'</h2>
                                                        ';
                                                    }
                                                ?>
                                            @else
                                                <?php 
                                                    $diskon = "";
                                                    $total = 'Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'));
                                                    if(Session::has('chart')){
                                                        $diskon = FunctionLib::sum_cart_diskon(Session::get('chart'));
                                                        $total = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');
                                                        $total = ($diskon > 0)?'Rp '.FunctionLib::number_to_text($total-$diskon).' / <span class="text-danger"><del>Rp '.FunctionLib::number_to_text($total).'</del></span>':'Rp '.FunctionLib::number_to_text($total);
                                                        $diskon = ($diskon > 0)? "<br/>Total diskon : <span class='text-danger'>Rp.".$diskon."</span>":"";
                                                    }
                                                    echo '
                                                    Tagihan : Rp '.FunctionLib::number_to_text($show_harga+FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')-$show_harga_total).' 
                                                    <br/><span class="text-danger">Grosir : Rp.'.FunctionLib::number_to_text($show_grosir).'</span><br>
                                                    <span class="text-danger">Diskon : Rp.'.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')-$show_harga_total-$show_grosir).'</span><br>
                                                    Ongkos Kirim : Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_ship')).' <br>';
                                                    if(Session::has('voucher')){
                                                        $voucher = Session::get('voucher');
                                                        echo '<span class="text-danger">Voucher : Rp.'.FunctionLib::number_to_text($voucher['amount']).'</span>'.' <br>';
                                                        echo '
                                                        <label>Jumlah yang harus ditransfer</label>
                                                        <h2 style="">Rp. '.FunctionLib::number_to_text(FunctionLib::minus_to_zero($show_harga_total-$voucher['amount'])).'</h2>
                                                        ';
                                                    }else{
                                                        echo '
                                                        <label>Jumlah yang harus ditransfer</label>
                                                        <h2 style="">Rp. '.FunctionLib::number_to_text($show_harga_total).'</h2>
                                                        ';
                                                    }
                                                ?>
                                            @endif
                                        </div>
                                    @endif
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
                            @if(Session::has('chart'))
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="payment" class="sr-only">Pembayaran</label>
                                    <select class="form-control" id="payment">
                                        <option value="">Pilih Pembayaran</option>
                                        @foreach($payment as $item)
                                            @if($item->id !== 3 && $item->id !== 4)
                                                @if(Session::has('voucher')){
                                                @else
                                                    <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment']) && $_GET['payment'] == "")?"selected":"" !!}>{{ucfirst(strtolower($item->payment_name))}}</option>
                                                @endif
                                            @else
                                                <option value="{{$item->payment_kode}}" {!! (!empty($_GET['payment']) && $_GET['payment'] == "")?"selected":"" !!}>{{ucfirst(strtolower($item->payment_name))}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="payment_hide payment_Me collapse">
                                    <hr/>
                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.payment")}} value="Pesan" class="btn btn-success" />
                                </div>
                                <div class="payment_hide payment_Saldo collapse">
                                    <hr/>
                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.saldo.payment")}} value="Pesan" class="btn btn-success" />
                                </div>
                                <div class="payment_hide payment_Pw collapse">
                                    <hr/>
                                        <span>
                                            metode pembayaran ini dibayar menggunakan poin + wallet, <br/>
                                            perhitungan : <br/>
                                            Poin masedi x % + Wallet Masedi x % , berbeda untuk masing-masing produk, tergantung settingan penjual.
                                        </span>
                                    <hr/>
                                    @foreach(Session::get('chart') as $item)
                                        <?php
                                            $seller_gln = true;
                                            $where = 'id ='.$item['trans_detail_produk_id'];
                                            $seller_produk = App\Models\Produk::whereRaw($where)->first();
                                            $seller[$seller_produk->user->id]['toko'] = $seller_produk->user->user_store;
                                            $seller[$seller_produk->user->id]['persen'] = FunctionLib::UserConfig('user_poin', $seller_produk->produk_seller_id);
                                        ?>
                                    @endforeach
                                    @foreach(Session::get('chart') as $key => $item)
                                        <?php
                                            $harga_grosir = 0;
                                            $produk_pp = App\Models\Produk::find($item['trans_detail_produk_id']);
                                        ?> 
                                        <span class="text-danger">
                                            Persen Poin Produk 
                                            <b>{{$produk_pp['produk_name']}}</b> = {{$produk_pp['produk_poin']}}%</span><br/>
                                    @endforeach
                                    <hr/>
                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.masedi.payment_poin")}} value="Pesan" class="btn btn-success" />
                                </div>
                                <div class="payment_hide payment_Mt collapse">
                                    <hr/>
                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.midtrans.payment")}} value="Pesan" class="btn btn-success" />
                                </div>
                                <div class="payment_hide payment_Tf collapse">
                                    <hr/>
                                    Cooming Soon.
                                </div>
                                {{-- <div class="payment_hide payment_Gln collapse">
                                    <hr/>
                                    Cooming Soon.
                                </div> --}}
                               <div class="payment_hide payment_Gln collapse">
                                    <hr/>
                                    <ul class="nav">
                                        <li><a class="active btn-info" data-toggle="tab" href="#informasi">1 GLN = Rp <?php echo $gln ?></a> </li>
                                        <li><a onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.gln.payment")}} value="Pesan" class="btn btn-success" >Transaksi</a></li> 
                                    </ul>
                                    <hr/>
                                    @foreach(Session::get('chart') as $item)
                                        <?php
                                            $seller_gln = true;
                                            $where = 'id ='.$item['trans_detail_produk_id'];
                                            $seller_produk = App\Models\Produk::whereRaw($where)->first();
                                            $seller_gln = $seller_gln && $seller_produk->user->is_gln();
                                            if(!$seller_gln){
                                                $seller[$seller_produk->user->id] = $seller_produk->user->user_store;
                                            }
                                        ?>
                                    @endforeach
                                    @if(!$seller_gln)
                                        <span class="text-danger">Toko <b>{{(rtrim(implode(',', $seller), ','))}}</b> tidak menyediakan pembayaran melalui GLN.</span>
                                    @else
                                        @if(Auth::user()->wallet()->where('wallet_type', 7)->exists())
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.gln.payment")}} value="Pesan" class="btn btn-success" />
                                        @else
                                            Anda belum memiliki akun gln. buat akun gln disini : <a id="saldo_gln" class="btn btn-info btn-xs" href="{{route('member.wallet.create_gln')}}">
                                                        Buat
                                                    </a>
                                        @endif
                                    @endif
                                </div>
                            @endif
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