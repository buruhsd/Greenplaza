@extends('frontend.layout.indexall')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Wishlist</h2>
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
                    <div class="wishlist-wrap p-10 bg-1">
                        <form action="cart">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">Image</th>
                                        <th class="product">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="stock">Stock Stutus </th>
                                        <th class="addcart">Add to Cart</th>
                                        <th class="remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $l)
                                    <tr>
                                        <td class="images"><img src="{{ asset('assets/images/product/'.$l->produk->produk_image) }}" alt=""></td>
                                        <td class="product"><a href="single-product.html">{{$l->produk->produk_name}}</a></td>
                                        <td class="ptice">{{$l->produk->produk_price}}</td>
                                        @if ($l->produk->stock != 0)
                                            <td class="stock">In Stock</td>
                                        @else
                                            <td class="stock">Out Stock</td>
                                        @endif
                                        <td class="addcart">
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.add_to_chart", $l->wishlist_produk_id)}} value="Add to Cart" class="btn btn-danger btn-sm col-12" id="btn-pick-address" />
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