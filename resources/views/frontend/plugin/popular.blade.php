<div class="col-lg-12 col-md-8 col-12">
    <div class="shop-area">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Popular</h2>
            </div>
        </div>
        <div class="product-active owl-carousel next-prev-style">
            @if($populer->count() == 0)
            @else
                @foreach($populer as $item)
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
{{--                             <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new sale">Sale</span>
                    <img class="first" src="{{ asset('frontend/images/product/18.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/19.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Sprite Foam Yoga Brick</a></h3>
                    <p><span>$14.00</span>
                        <del>$45.00</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new">New</span>
                    <img class="first" src="{{ asset('frontend/images/product/28.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/33.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Push It Messenger Bag</a></h3>
                    <p><span>$20.50</span>
                        <del>$21.10</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new sale">Sale</span>
                    <img class="first" src="{{ asset('frontend/images/product/33.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/30.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                    <p><span>$48.00</span>
                        <del>$50.00</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new">New</span>
                    <img class="first" src="{{ asset('frontend/images/product/15.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/16.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Silver Stainless Steel</a></h3>
                    <p><span>$20.00</span>
                        <del>$14.00</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-half-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new sale">Sale</span>
                    <img class="first" src="{{ asset('frontend/images/product/16.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/25.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html"> Retis lapen casen </a></h3>
                    <p><span>$22.00</span>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new">New</span>
                    <img class="first" src="{{ asset('frontend/images/product/17.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/8.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Brone Lamp Glasses</a></h3>
                    <p><span>$15.00</span>
                        <del>$20.00</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                </div>
            </div>
            <div class="product-wrap">
                <div class="product-img black-opacity">
                    <span class="new sale">Sale</span>
                    <img class="first" src="{{ asset('frontend/images/product/16.jpg') }}" alt="">
                    <img class="second" src="{{ asset('frontend/images/product/5.jpg') }}" alt="">
                    <div class="shop-icon">
                        <ul>
                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                    <p><span>$25.00</span>
                        <del>$14.00</del>
                    </p>
                    <ul class="rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                </div>
            </div> --}}
        </div>
    </div>
</div>