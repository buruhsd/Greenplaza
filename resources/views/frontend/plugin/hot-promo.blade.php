<div class="product-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-8 col-12">
                <div class="shop-area">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="section-title">Hot Promo</h2>
                        </div>
                    </div>
                    <div class="product-active owl-carousel next-prev-style">
                        @if($hot_promo->count() == 0)
                        @else
                            @foreach($hot_promo as $item)
                                <div class="product-wrap">
                                    <div class="product-img black-opacity">
                                        <span class="new">New</span>
                                        <img class="first" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="">
                                        <img class="second" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="">
                                        <div class="shop-icon">
                                            <ul>
                                                <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart"></i></a></li>
                                                <li><a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{route('detail', $item->produk_slug)}}">{{$item->produk_name}}</a></h3>
                                        @if($item->produk_discount > 0)
                                            <p>
                                                <span>{{FunctionLib::number_to_text($item->produk_price - ($item->produk_price * $item->produk_discount / 100))}}</span>
                                                <del>{{FunctionLib::number_to_text($item->produk_price)}}</del>
                                            </p>
                                        @else
                                            <p><span>{{FunctionLib::number_to_text($item->produk_price)}}</span></p>
                                        @endif
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
