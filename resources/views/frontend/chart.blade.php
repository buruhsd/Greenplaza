@extends('frontend.layout.indexall')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1 ">
                        <div class="breadcumb-content black-opacity" style="background-image: url('frontend/images/cart.jpg')">
                            <h2>Cart</h2>
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
    <!-- cart-area start -->
    <div class="cart-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="cart-wrapper bg-5 p-10">
                        <div class="col-12">
                            <div class="form-group">
                              <label for="sel1">Select your payment:</label>
                              <select class="form-control" id="sel1" onchange="location = this.value;">
                                <option value="{{ url('/chart?type=') }}">IDR</option>
                                {{-- <option value="{{ url('/chart?type=myr') }}">MYR</option> --}}
                                <option value="{{ url('/chart?type=gln') }}">GLN</option>
                                {{-- <option name="{{ url('/chart/{}') }}">Greenline</option> --}}
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-wrapper bg-5 p-10">
                        <div class="col-12">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">Image</th>
                                        <th class="product">Item</th>
                                        <th class="ptice">Price</th>
                                        <th class="ptice">Shipping</th>
                                        <th class="quantity">Quantity</th>
                                        <th class="total">Total</th>
                                        <th class="remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $show_harga = 0;
                                        $show_harga_myr = 0;
                                        $show_harga_gln = 0;
                                        $show_shipment = 0;
                                        $show_harga_grosir_total = 0; 
                                        $show_harga_diskon_total = 0; 
                                        $show_harga_total = 0; 
                                        $show_harga_total_myr = 0; 
                                        $show_harga_total_gln = 0; 
                                        $show_grosir = 0;
                                    ?>

                                    @if(Session::has('chart'))
                                        @foreach(Session::get('chart') as $key => $item)
                                        {{-- {{ dd($item)}}; --}}
                                            <?php
                                                $harga_grosir = 0;
                                                $produk = App\Models\Produk::where('id', $item['trans_detail_produk_id'])->first(); 
                                                $harga = $produk->produk_price;
                                                $harga_myr = $produk->price_myr;
                                                $harga_gln = $produk->gln_coin;
                                                var_dump($produk->gln_coin);
                                                $is_grosir = false;
                                                if($produk->is_grosir()){
                                                    $where = 'produk_grosir_start <= '.(int)$item['trans_detail_qty'].' AND produk_grosir_end >= '.(int)$item['trans_detail_qty'];
                                                    $grosir = $produk->grosir()->whereRaw($where);
                                                    if($grosir->count()){
                                                        $harga = (float)$grosir->first()->produk_grosir_price;
                                                        $is_grosir = true;
                                                        $harga_grosir = $produk->produk_price - $harga;
                                                    }
                                                }
                                                $diskon = ($produk['produk_discount'] > 0)?true:false;
                                                $ship_gln = (int)$item['trans_detail_amount_ship']/75100;
                    
                                                $harga = $harga * (int)$item['trans_detail_qty'];
                                                $harga_myr = $harga_myr * (int)$item['trans_detail_qty'];
                                                $harga_gln = $harga_gln * (int)$item['trans_detail_qty'];
                                                $harga_grosir = (int)$harga_grosir * (int)$item['trans_detail_qty'];
                                                $harga_total_myr = $harga_myr+(float)$item['trans_detail_amount_ship'];
                                                $harga_total = $harga+(float)$item['trans_detail_amount_ship'];
                                                $harga_total_gln = $harga_gln+$ship_gln;

                                            ?>
                                            <tr>
                                                <td class="images"><img src="assets/images/product/{{$produk['produk_image']}}" alt=""></td>
                                                <td class="product"><a href="#">{{$produk['produk_name']}}</a></td>
                                                <td class="ptice">
                                                    @if($type == 'myr')
                                                            <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    MYR. {{FunctionLib::number_to_text($item['trans_detail_amount_myr'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                               MYR.{{FunctionLib::number_to_text($harga_myr)}}
                                                            </del>
                                                            MYR.{{FunctionLib::number_to_text($harga_myr-($harga_myr*$produk['produk_discount']/100))}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    MYR. {{FunctionLib::number_to_text($item['trans_detail_amount'])}}
                                                                </del>
                                                            @endif
                                                            MYR.{{FunctionLib::number_to_text($harga)}}
                                                        <?php } ?>
                                                    @elseif($type == 'gln')
                                                        <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    GLN. {{FunctionLib::number_to_text($item['trans_detail_amount_gln'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                               GLN.{{FunctionLib::number_to_text($harga_gln)}}
                                                            </del>
                                                            GLN.{{FunctionLib::number_to_text($harga_gln-($harga_gln*$produk['produk_discount']/100))}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    GLN. {{FunctionLib::number_to_text($item['trans_detail_amount_gln'])}}
                                                                </del>
                                                            @endif
                                                            GLN.{{FunctionLib::number_to_text($harga_gln)}}
                                                        <?php } ?>
                                                    @else
                                                        <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp. {{FunctionLib::number_to_text($item['trans_detail_amount'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                               Rp.{{FunctionLib::number_to_text($harga)}}
                                                            </del>
                                                            Rp.{{FunctionLib::number_to_text($harga-($harga*$produk['produk_discount']/100))}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp. {{FunctionLib::number_to_text($item['trans_detail_amount'])}}
                                                                </del>
                                                            @endif
                                                            Rp.{{FunctionLib::number_to_text($harga)}}
                                                        <?php } ?>
                                                    @endif
                                                    
                                                </td>
                                                @if($type == 'gln')
                                                <td class="ptice">Rp.{{FunctionLib::number_to_text($item['trans_detail_amount_ship']/75100)}}</td>
                                                @else
                                                <td class="ptice">Rp.{{FunctionLib::number_to_text($item['trans_detail_amount_ship'])}}</td>
                                                @endif
                                                <td class="quantity ">{{$item['trans_detail_qty']}}</td>
                                                <!-- <td class="quantity ">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="1" />
                                                    </div>
                                                </td> -->
                                                <td class="total">
                                                    @if($type == 'myr')
                                                        <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    MYR.{{FunctionLib::number_to_text($item['trans_detail_amount_total_myr'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                                MYR.{{FunctionLib::number_to_text($harga_myr+$item['trans_detail_amount_ship'])}}
                                                            </del>
                                                            MYR.{{FunctionLib::number_to_text($harga_myr-($harga_myr*$produk['produk_discount']/100)+$item['trans_detail_amount_ship'])}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp. {{FunctionLib::number_to_text($item['trans_detail_amount_total'])}}
                                                                </del>
                                                            @endif
                                                            MYR.{{FunctionLib::number_to_text($harga_total)}}
                                                        <?php } ?>
                                                    @elseif($type == 'gln')
                                                        <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    GLN.{{FunctionLib::number_to_text($item['trans_detail_amount_total_gln'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                                GLN.{{FunctionLib::number_to_text($harga_gln+$item['trans_detail_amount_ship'])}}
                                                            </del>
                                                            GLN.{{FunctionLib::number_to_text($harga_gln-($harga_gln*$produk['produk_discount']/100)+$item['trans_detail_amount_ship'])}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp. {{FunctionLib::number_to_text($item['trans_detail_amount_total_gln'])}}
                                                                </del>
                                                            @endif
                                                            GLN.{{FunctionLib::number_to_text($harga_total_gln)}}
                                                        <?php } ?>
                                                    @else
                                                        <?php if($diskon){ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp.{{FunctionLib::number_to_text($item['trans_detail_amount_total'])}}
                                                                </del>
                                                            @endif
                                                            <del class="text-danger">
                                                                Rp.{{FunctionLib::number_to_text($harga+$item['trans_detail_amount_ship'])}}
                                                            </del>
                                                            Rp.{{FunctionLib::number_to_text($harga-($harga*$produk['produk_discount']/100)+$item['trans_detail_amount_ship'])}}
                                                        <?php }else{ ?>
                                                            @if($is_grosir)
                                                                <del class="text-danger">
                                                                    Rp. {{FunctionLib::number_to_text($item['trans_detail_amount_total'])}}
                                                                </del>
                                                            @endif
                                                            Rp.{{FunctionLib::number_to_text($harga_total)}}
                                                        <?php } ?>
                                                    @endif
                                                </td>
                                                <td class="remove">
                                                    {!! Form::open([
                                                        'method'=>'GET',
                                                        'url' => url('/chart/destroy/'.$key),
                                                        'style' => 'display:inline'
                                                    ]) !!}
                                                        {!! Form::button('<i class="fa fa-times"></i>', array(
                                                                'class' => 'btn btn-danger btn-xs',
                                                                'type' => 'submit',
                                                                'title' => 'Delete blog',
                                                                'onclick'=>'return confirm("Confirm delete?")'
                                                        )) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                @if($produk->is_grosir())
                                                    <tr class="accordion" id="accordiongrosir">
                                                        <td colspan="3">
                                                        @foreach($produk->grosir as $grosir)
                                                            <button class="btn btn-success btn-block btn-sm" type="button" data-toggle="collapse" data-target="#grosir{{$grosir->id}}" aria-expanded="false" aria-controls="grosir{{$grosir->id}}">Grosir {{$grosir->produk_grosir_start}} {{$produk->unit->produk_unit_name}}</button>
                                                        @endforeach
                                                        </td>
                                                        <td colspan="4">
                                                        @foreach($produk->grosir as $grosir)
                                                            <div class="collapse multi-collapse {!!($loop->first)?'show':''!!}" data-parent="#accordiongrosir" id="grosir{{$grosir->id}}">
                                                                <div class="card card-body">
                                                                    <table>
                                                                        <tr>
                                                                            <th><b>Dari</b></th>
                                                                            <th><b>sampai</b></th>
                                                                            <th><b>harga</b></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{$grosir->produk_grosir_start}}</td>
                                                                            <td>{{$grosir->produk_grosir_end}}</td>
                                                                            <td>Rp. {{FunctionLib::number_to_text($grosir->produk_grosir_price)}}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tr>
                                            <?php
                                                if($diskon){
                                                    $harga = $harga-($harga*$produk['produk_discount']/100);
                                                    $harga_myr = $harga_myr-($harga_myr*$produk['produk_discount']/100);
                                                    $harga_gln = $harga_gln-($harga_gln*$produk['produk_discount']/100);
                                                    $harga_total = $harga+$item['trans_detail_amount_ship'];
                                                    $harga_total_myr = $harga_myr+$item['trans_detail_amount_ship'];
                                                    $harga_total_gln = $harga_gln+$item['trans_detail_amount_ship'];
                                                }
                                                $show_grosir += (float)$harga_grosir;
                                                $show_harga += (float)$harga;
                                                $show_harga_myr += (float)$harga_myr;
                                                $show_harga_gln += (float)$harga_gln;
                                                $show_shipment += (float)$item['trans_detail_amount_ship'];
                                                $show_harga_total += (float)$harga_total;
                                                $show_harga_total_myr += (float)$harga_total_myr;
                                                $show_harga_total_gln += (float)$harga_total_gln;
                                            ?>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-60">
                            <div class="col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap"><!--  style="display:none;"> -->
                                    <ul class="d-flex">
                                        <!-- <li>
                                            <button>Update Cart</button>
                                        </li> -->
                                        <li><a href="{{route('category')}}">Lanjutkan Belanja</a></li>
                                    </ul>
                                    {{-- @if(!Session::has('voucher'))
                                        <h3 class="form-voucher">Voucher Masedi</h3>
                                        <p class="form-voucher">Masukkan kode Voucher jika punya</p>
                                        <div class="cupon-wrap form-voucher">
                                            <input type="text" id="code_voucher" placeholder="Kode Voucher">
                                            <button id="voucher" data-href="{{route('localapi.masedi.cek_voucher')}}">Gunakan Voucher</button>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                            <?php 
                                $diskon = "";
                                $total = 'Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'));
                                $total_gln = 'Rp '.FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_gln'));
                                if(Session::has('chart')){
                                    $diskon = FunctionLib::sum_cart_diskon(Session::get('chart'));
                                    $total = FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total');
                                    $total = ($diskon > 0)
                                        ?'Rp '.FunctionLib::number_to_text($total-$diskon)
                                        :'Rp '.FunctionLib::number_to_text($total);
                                    $diskon = ($diskon > 0)
                                        ?"<li><span class='pull-left text-danger'>Diskon </span><span class='text-danger'>Rp.".FunctionLib::number_to_text($diskon)."</span></li><h3></h3>"
                                        :"";
                                }
                            ?>
                            <div class=" col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Total Belanjaan</h3>
                                    <ul>
                                        @if($type == 'myr')
                                            <li>
                                                <span class="pull-left">Subtotal </span>
                                                MYR. {{FunctionLib::number_to_text($show_harga_myr+FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_myr')-$show_harga_total_myr)}}
                                            </li>
                                            <li>
                                                <span class="pull-left">Pengiriman </span>
                                                MYR. {{FunctionLib::number_to_text($show_shipment)}}
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Grosir </span>
                                                <span class='text-danger'>
                                                    MYR. {{FunctionLib::number_to_text($show_grosir)}}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Diskon </span>
                                                <span class='text-danger'>
                                                    MYR. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_myr')-$show_harga_total_myr-$show_grosir)}}
                                                </span>
                                            </li>
                                            <li id="voucher-info">
                                            @if(Session::has('voucher'))
                                                <?php 
                                                    $voucher = Session::get('voucher');
                                                ?>
                                                    <span class="pull-left text-danger">Voucher </span>
                                                    <span class='text-danger'>
                                                        MYR. {{FunctionLib::number_to_text($voucher['amount'])}}
                                                        <button id="del_voucher"><i class="fa fa-times"></i></button>
                                                    </span>
                                            @endif
                                            </li>
                                            <h3></h3>
                                            <li>
                                                <span class="pull-left"> Total </span> 
                                                @if(Session::has('voucher'))
                                                    MYR. {{FunctionLib::number_to_text(FunctionLib::minus_to_zero($show_harga_total_myr-$voucher['amount']))}}
                                                @else
                                                    MYR. {{FunctionLib::number_to_text($show_harga_total_myr)}}
                                                @endif
                                            </li>
                                        @elseif($type == 'gln')
                                            <li>
                                                <span class="pull-left">Subtotal </span>
                                                GLN. {{FunctionLib::number_to_text($show_harga_gln+FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_gln')-$show_harga_total_gln)}}
                                            </li>
                                            <li>
                                                <span class="pull-left">Pengiriman </span>
                                                GLN. {{FunctionLib::number_to_text($show_shipment)}}
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Grosir </span>
                                                <span class='text-danger'>
                                                    GLN. {{FunctionLib::number_to_text($show_grosir)}}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Diskon </span>
                                                <span class='text-danger'>
                                                    GLN. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_gln')-$show_harga_total_gln-$show_grosir)}}
                                                </span>
                                            </li>
                                            <li id="voucher-info">
                                            @if(Session::has('voucher'))
                                                <?php 
                                                    $voucher = Session::get('voucher');
                                                ?>
                                                    <span class="pull-left text-danger">Voucher </span>
                                                    <span class='text-danger'>
                                                        GLN. {{FunctionLib::number_to_text($voucher['amount'])}}
                                                        <button id="del_voucher"><i class="fa fa-times"></i></button>
                                                    </span>
                                            @endif
                                            </li>
                                            <h3></h3>
                                            <li>
                                                <span class="pull-left"> Total </span> 
                                                @if(Session::has('voucher'))
                                                    GLN. {{FunctionLib::number_to_text(FunctionLib::minus_to_zero($show_harga_total_gln-$voucher['amount']))}}
                                                @else
                                                    GLN. {{FunctionLib::number_to_text($show_harga_total_gln)}}
                                                @endif
                                            </li>
                                        @else
                                            <li>
                                                <span class="pull-left">Subtotal </span>
                                                Rp. {{FunctionLib::number_to_text($show_harga+FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')-$show_harga_total)}}
                                            </li>
                                            <li>
                                                <span class="pull-left">Pengiriman </span>
                                                Rp. {{FunctionLib::number_to_text($show_shipment)}}
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Grosir </span>
                                                <span class='text-danger'>
                                                    Rp. {{FunctionLib::number_to_text($show_grosir)}}
                                                </span>
                                            </li>
                                            <li>
                                                <span class="pull-left text-danger">Diskon </span>
                                                <span class='text-danger'>
                                                    Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total_gln')-$show_harga_total-$show_grosir)}}
                                                </span>
                                            </li>
                                            <li id="voucher-info">
                                            @if(Session::has('voucher'))
                                                <?php 
                                                    $voucher = Session::get('voucher');
                                                ?>
                                                    <span class="pull-left text-danger">Voucher </span>
                                                    <span class='text-danger'>
                                                        Rp. {{FunctionLib::number_to_text($voucher['amount'])}}
                                                        <button id="del_voucher"><i class="fa fa-times"></i></button>
                                                    </span>
                                            @endif
                                            </li>
                                            <h3></h3>
                                            <li>
                                                <span class="pull-left"> Total </span> 
                                                @if(Session::has('voucher'))
                                                    Rp. {{FunctionLib::number_to_text(FunctionLib::minus_to_zero($show_harga_total-$voucher['amount']))}}
                                                @else
                                                    Rp. {{FunctionLib::number_to_text($show_harga_total)}}
                                                @endif
                                            </li>
                                        @endif
                                    </ul>
                                    <a href="{{route('checkout')}}?type={{$type}}">Memproses ke Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    

@endsection
@section('script')
    <script type="text/javascript">
        $('#voucher').click(function(e){
            swal({
                title: 'Ingin gunakan voucher Masedi?',
                text: "*Voucher hanya untuk 1x/transaksi Sisa dana vocher yang masih ada tidak dapat digunakan lagi.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Gunakan!'
            }).then((isConfirm) => {
                var status;
                var message;
                if (isConfirm.value){
                    $.post($('#voucher').data('href'), {"_token": "{{ csrf_token() }}", "voucher":$('#code_voucher').val()}, function( data ) {
                        if((data.status == 200)){
                            status = 200;
                            message = data.message;
                            $('.form-voucher').hide();
                            console.log(data.data);
                            $.post("{{route('add_voucher')}}", 
                                {"_token": "{{ csrf_token() }}", 
                                "voucher":$('#code_voucher').val(), "amount": data.data.nilai}, 
                                function( data2 ) {
                                    if(data2.status == 200){
                                        $('.form-voucher').hide();
                                        var html = '<span class="pull-left text-danger">Voucher </span>'+
                                            '<span class="text-danger">'+
                                            data.data.nilai+
                                            '<button id="del_voucher"><i class="fa fa-times"></i></button>'+
                                            '</span>';
                                            // '<i class="fa fa-times fa-2x"></i>';
                                        $('#voucher-info').empty().html(html);
                                    }else{
                                        status = 500;
                                        message = 'Voucher sudah digunakan'
                                    }
                                }
                            );
                        }else{
                            status = 500;
                            message = data.message;
                        }
                        var res_status = (status == 200)?'success':'error';
                        swal("notifikasi!", message, res_status).then(() => {
                            location.reload();
                        });
                    });
                } else {
                    swal("Batal", "Batal menggunakan voucher", "error");
                    e.preventDefault();
                }
            });
        });
        $('#del_voucher').click(function(e){
            $.post("{{route('del_voucher')}}", {"_token": "{{ csrf_token() }}"}, function( data ) {
                if(data.status == 200){
                    location.reload();
                }
            });
        });
    </script>
@endsection
