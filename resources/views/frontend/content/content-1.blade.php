 <div class="product-area">
        <div class="container">
            <div class="shop-area">
                        <div class="row">
                            <div class="col-lg-4 col-sm-3 col-12">
                                <h2 class="section-title">New Arivel</h2>
                            </div>
                            {{-- <div class="col-lg-8 text-right col-sm-9 col-12">
                                <ul class="tab-menu nav">
                                    <li><a class="active" data-toggle="tab" href="#chair">Chair</a></li>
                                    <li><a data-toggle="tab" href="#table">Table</a></li>
                                    <li><a data-toggle="tab" href="#laptop">Laptop</a></li>
                                    <li><a data-toggle="tab" href="#dextop">Dextop</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="chair">
                                <div class="product-active owl-carousel next-prev-style">
                                    @if($produk_newest->count() == 0)
                                    @else
                                        @foreach($produk_newest as $item)
                                            <div class="product-items">
                                                <div class="product-wrap mb-15">
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
                                                        <h3><a href="shop.html">{{$item->produk_name}}</a></h3>
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
{{--                                                 <div class="product-wrap">
                                                    <div class="product-img black-opacity">
                                                        <span class="new sale">Sale</span>
                                                        <img class="first" src="{{ asset('frontend/images/product/29.jpg') }}" alt="">
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
                                                </div> --}}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="table">
                                <div class="product-active owl-carousel next-prev-style">
                                    <div class="product-items">
                                        <div class="product-wrap mb-15">
                                            <div class="product-img black-opacity">
                                                <span class="new">New</span>
                                                <img class="first" src="{{ asset('frontend/images/product/21.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/20.jpg') }}" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Dual Handle Cardio Ball</a></h3>
                                                <p><span>$20.00</span>
                                                    <del>$30.00</del>
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
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/images/product/20.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/21.jpg') }}" alt="">
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="laptop">
                                <div class="product-active owl-carousel next-prev-style">
                                    <div class="product-items">
                                        <div class="product-wrap mb-15">
                                            <div class="product-img black-opacity">
                                                <span class="new">New</span>
                                                <img class="first" src="{{ asset('frontend/images/product/13.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/12.jpg') }}" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Dual Handle Cardio Ball</a></h3>
                                                <p><span>$20.00</span>
                                                    <del>$30.00</del>
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
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/images/product/12.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/13.jpg') }}" alt="">
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="dextop">
                                <div class="product-active owl-carousel next-prev-style">
                                    <div class="product-items">
                                        <div class="product-wrap mb-15">
                                            <div class="product-img black-opacity">
                                                <span class="new">New</span>
                                                <img class="first" src="{{ asset('frontend/images/product/20.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/22.jpg') }}" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Dual Handle Cardio Ball</a></h3>
                                                <p><span>$20.00</span>
                                                    <del>$30.00</del>
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
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/images/product/28.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/images/product/21.jpg') }}" alt="">
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
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>