@extends('frontend.layout.indexall')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1 ">
                        <div class="breadcumb-content black-opacity" style="background-image: url('../frontend/images/wishlist1.jpg')">
                            <h2>{{__('dashboard.wishlist') }}</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{__('front.shop') }}</li>
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
                    <div class="wishlist-wrap p-10 bg-1">
                        <form action="cart">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">{{__('dashboard.gambar') }}</th>
                                        <th class="product">{{__('dashboard.barang') }}</th>
                                        <th class="ptice">{{__('dashboard.harga') }}</th>
                                        <th class="stock">{{__('dashboard.stock') }} </th>
                                        <th class="stock">{{__('dashboard.pengingat') }} </th>
                                        <th class="addcart">{{__('front.tambah_ke_keranjang') }}</th>
                                        <th class="remove">{{__('dashboard.hapus') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $l)
                                    <tr>
                                        <td class="images"><img src="{{ asset('assets/images/product/'.$l->produk->produk_image) }}" alt=""></td>
                                        <td class="product"><a href="{{route('detail', $l->produk->produk_slug)}}">{{$l->produk->produk_name}}</a></td>
                                        <td class="ptice">Rp. {{FunctionLib::number_to_text($l->produk->produk_price)}}</td>
                                        @if ($l->produk->produk_stock != 0)
                                            <td class="stock">{{__('dashboard.in_stock') }}</td>
                                        @else
                                            <td class="stock">{{__('dashboard.out_stock') }}</td>
                                        @endif
                                        <td>{{$l->wishlist_note}}</td>
                                        <td class="addcart">
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.add_to_chart", $l->wishlist_produk_id)}} value="{{__('front.tambah_ke_keranjang') }}" class="btn btn-danger btn-sm col-12" id="btn-pick-address" />
                                        <td class="remove"><a href="{{route('member.wishlist.delete', $l->id)}}"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection