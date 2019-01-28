@extends('frontend.layout.indexall')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1 ">
                        <div class="breadcumb-content black-opacity" style="background-image: url('frontend/images/chart.jpg')">
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
                <div class="col-12">
                    <div class="cart-wrapper bg-5 p-10">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Gambar</th>
                                    <th class="product">Barang</th>
                                    <th class="ptice">Harga</th>
                                    <th class="ptice">Pengiriman</th>
                                    <th class="quantity">Jumlah</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::has('chart'))
                                    @foreach(Session::get('chart') as $key => $item)
                                        <?php $produk = App\Models\Produk::where('id', $item['trans_detail_produk_id'])->first(); ?>
                                        <tr>
                                            <td class="images"><img src="assets/images/product/{{$produk['produk_image']}}" alt=""></td>
                                            <td class="product"><a href="single-product.html">{{$produk['produk_name']}}</a></td>
                                            <td class="ptice">Rp. {{FunctionLib::number_to_text($item['trans_detail_amount'])}}</td>
                                            <td class="ptice">Rp. {{FunctionLib::number_to_text($item['trans_detail_amount_ship'])}}</td>
                                            <td class="quantity ">{{$item['trans_detail_qty']}}</td>
                                            {{-- <td class="quantity ">
                                                <div class="cart-plus-minus">
                                                    <input type="text" value="1" />
                                                </div>
                                            </td> --}}
                                            <td class="total">{{$item['trans_detail_amount_total']}}</td>
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
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        {{-- <li>
                                            <button>Update Cart</button>
                                        </li> --}}
                                        <li><a href="{{route('category')}}">Lanjutkan Belanja</a></li>
                                    </ul>
                                    <h3>Kupon</h3>
                                    <p>Masukkan kode kupon jika punya</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Menggunakan Kupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Total Belanjaan</h3>
                                    <ul>
                                        <li>
                                            <span class="pull-left">Subtotal </span>
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount'))}}
                                        </li>
                                        <li>
                                            <span class="pull-left"> Total </span> 
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'))}}
                                        </li>
                                    </ul>
                                    <a href="{{route('checkout')}}">Memproses ke Checkout</a>
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