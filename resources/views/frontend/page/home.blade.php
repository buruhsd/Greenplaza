@extends('frontend.layout.index', ['active' => 'home'])
@section('title', 'Home')
@section('content')

    <div class="slider-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-4">
                    <div class="slider-active owl-carousel next-prev-btn">
                        <div class="slider-item black-opacity">
                            <img src="{{ asset('frontend/images/slider/1.jpg') }}" alt="" class="slider">
                            <div class="slider-content">
                                <h2>Shop Our <span> DrakShop</span></h2>
                                <h3><span>35% </span> Discount</h3>
                                <ul>
                                    <li><a href="shop.html">shop now</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="slider-item black-opacity">
                            <img src="{{ asset('frontend/images/slider/2.jpg') }}" alt="" class="slider">
                            <div class="slider-content text-right">
                                <h2>Shop Our <span> DrakShop</span></h2>
                                <h3><span>25% </span> Discount</h3>
                                <ul>
                                    <li><a href="shop.html">shop now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="info-wrap">
                        <div class="row">
                            <div class="col-sm-6 col-xs-15">
                                <div class="info-items">
                                    <img src="{{ asset('frontend/images/icon/2.png') }}" alt="">
                                    <h4>MONEY BACK</h4>
                                    <p>30 Days Money Back Guarantee</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info-items">
                                    <img src="{{ asset('frontend/images/icon/1.png') }}" alt="">
                                    <h4>SPECIAL SALE</h4>
                                    <p>Extra $5 off on all items</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="author-wrap">
                        <img src="{{ asset('frontend/images/author.png') }}" alt="">
                        <h4>Alex Smeet</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Maxime</p>
                    </div>
                    <div class="banner-wrap">
                        <div class="banner-img">
                            <span class="discount">%20 Off</span>
                            <img src="{{ asset('frontend/images/banner/1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 d-none d-lg-block">
                    <div class="featured-wrap">
                        <div class="featured-img black-opacity">
                            <img src="{{ asset('frontend/images/featured/1.jpg') }}" alt="">
                            <div class="featured-content">
                                <h2>Minilam Chair</h2>
                                <p>consectetur adipisicing elit to Tempora, similique!</p>
                                <ul>
                                    <li><a href="shop.html">Shop Now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="featured-wrap">
                        <div class="featured-img black-opacity">
                            <img src="{{ asset('frontend/images/featured/2.jpg') }}" alt="">
                            <div class="featured-content text-center">
                                <h2>Dual Handle Cardio Ball</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore,<span> sunt animi quas architecto repellendus</span></p>
                                <ul>
                                    <li><a href="shop.html">Shop Now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="featured-wrap">
                        <div class="featured-img  black-opacity">
                            <img src="{{ asset('frontend/images/featured/3.jpg') }}" alt="">
                            <div class="featured-content text-right">
                                <h2>Minilam Chair</h2>
                                <p>consectetur adipisicing elit to Tempora, similique!</p>
                                <ul>
                                    <li><a href="shop.html">Shop Now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="product-sidebar">
                        <h2 class="section-title">Related Product</h2>
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/1.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Floral Print Buttoned</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/2.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Push It Messenger Bag</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/3.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Sprite Foam Yoga Brick</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/4.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Dual Handle Cardio Ball</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/5.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Floral Print Buttoned</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/4.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Push It Messenger Bag</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/7.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Sprite Foam Yoga Brick</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/8.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Dual Handle Cardio Ball</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-sidebar" style="width: 100%">
                        <h2 class="section-title">Discount Price</h2>
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            @foreach ($discountprice as $d)
                            <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="discount">{{number_format($d->produk_discount)}}% Off</span>
                                        <img src="{{asset('assets/images/product/'.$d->produk_image)}}">
                                    <div class="discount-wrap">
                                        <div data-countdown="2017/10/03"></div>
                                    </div>
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                    <p><span>Rp.{{($d->produk_price * $d->produk_discount) / 100}}</span>
                                        <del>Rp.{{number_format($d->produk_price, 2)}}</del>
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
                            @endforeach
                        </div>
                    </div>
                    <div class="tag-wrap">
                        <h2 class="section-title">Popular Tags</h2>
                        <ul>
                        @foreach ($category as $c)
                            <li><a href="#">{{$c->category->category_name}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="product-sidebar">
                        <h2 class="section-title">Popular Product</h2>
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                @foreach ($popularproduk as $p)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>{{number_format($p->produk_price,2)}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slidebar-product-wrap">
                                @foreach ($popularprodukk as $p)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>{{number_format($p->produk_price,2)}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">New Product</h2>
                            </div>
                        </div>
                        <div class="product-active owl-carousel next-prev-style">
                            @foreach($newproduk as $n)
                            <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="new">New</span>
                                    <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                    <p><span>Rp.{{($n->produk_price * $d->produk_discount) / 100}}</span>
                                        <del>Rp.{{number_format($n->produk_price, 2)}}</del>
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
                            <!-- <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="new sale">Sale</span>
                                    <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                    <p><span>{{$n->produk_price}}</span>
                                        <del>{{$n->product_discount}} %</del>
                                    </p>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div> -->
                            @endforeach
                        </div>
                    </div>
                    <div class="banner-wrap mb-30">
                        <div class="banner-img black-opacity">
                            <img src="{{ asset('frontend/images/banner/2.jpg') }}" alt="">
                            <div class="banner-content">
                                <div class="banner-info">
                                    <h2>Sale <span>20%</span> off</h2>
                                    <h3>This Week Only</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-lg-4 col-sm-3 col-12">
                                <h2 class="section-title">New Arivel</h2>
                            </div><!-- 
                            <div class="col-lg-8 text-right col-sm-9 col-12">
                                <ul class="tab-menu nav">
                                </ul>
                            </div> -->
                        </div>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="chair">
                                <div class="product-active owl-carousel next-prev-style">
                                    @foreach ($category as $n)
                                    @if ($n->produk_discount == 0)
                                    <div class="product-items">
                                        <div class="product-wrap mb-15">
                                            <div class="product-img black-opacity">
                                                <span class="new">New</span>
                                                    <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                                <p>
                                                    <span>Rp.{{number_format($n->produk_price, 2)}}</span>
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
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="chair">
                                <div class="product-active owl-carousel next-prev-style">
                                    @foreach ($category as $n)
                                    @if ($n->produk_discount > 0)
                                    <div class="product-wrap">
                                        <div class="product-img black-opacity">
                                            <span class="new sale">Sale</span>
                                                <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                            <div class="shop-icon">
                                                <ul>
                                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                            <p>
                                                <span>Rp.{{($n->produk_price * $d->produk_discount) / 100}}</span>
                                                <del>Rp.{{number_format($n->produk_price, 2)}}</del>
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
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    <!-- banner-area start -->
    <div class="banner-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="banner-wrap">
                        <div class="banner-img">
                            <img src="{{ asset('frontend/images/banner/5.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-md-6 sm-mb-30 col-12">
                            <div class="banner-wrap">
                                <div class="banner-img">
                                    <img src="{{ asset('frontend/images/banner/3.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="banner-wrap">
                                <div class="banner-img">
                                    <img src="{{ asset('frontend/images/images/banner/4.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="product-sidebar">
                        <h2 class="section-title">Special Product</h2>
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/16.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Floral Print Buttoned</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/15.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Push It Messenger Bag</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/16.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Sprite Foam Yoga Brick</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/13.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Dual Handle Cardio Ball</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/12.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Floral Print Buttoned</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/11.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Push It Messenger Bag</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/10.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Sprite Foam Yoga Brick</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="{{ asset('frontend/images/product/sidebar/9.jpg') }}" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Dual Handle Cardio Ball</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Featured products</h2>
                            </div>
                        </div>
                        <div class="product-active owl-carousel next-prev-style">
                            <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="new">New</span>
                                    <img class="first" src="{{ asset('frontend/images/product/25.jpg') }}" alt="">
                                    <img class="second" src="{{ asset('frontend/images/product/14.jpg') }}" alt="">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                    <img class="first" src="{{ asset('frontend/images/product/18.jpg') }}" alt="">
                                    <img class="second" src="{{ asset('frontend/images/product/19.jpg') }}" alt="">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                    <img class="first" src="{{ asset('frontend/images/roduct/16.jpg') }}" alt="">
                                    <img class="second" src="{{ asset('frontend/images/product/25.jpg') }}" alt="">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                                    <img class="first" src="assets/images/product/16.jpg" alt="">
                                    <img class="second" src="assets/images/product/5.jpg" alt="">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 sm-mb-30">
                    <div class="banner-wrap">
                        <div class="banner-img">
                            <img src="assets/images/banner/6.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="testmonial-wrap">
                        <h2 class="section-title">Our Product Review</h2>
                        <div class="test-active owl-carousel next-prev-style">
                            @foreach ($review as $r)
                            <div class="test-items">
                                <div class="test-img">
                                    <img src="{{asset('assets/images/product/'.$r->userdetail->user_detail_image)}}">
                                </div>
                                <div class="test-content">
                                    <h3>{{$r->user->name}}</h3>
                                    <span>User</span>
                                    <p>{{$r->review_text}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
    <!-- spacial-product-area start-->
    <div class="spacial-product-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="spacial-product-wrap">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12 sm-mb-30">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Trending</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularproduk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>Rp.{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularprodukk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>Rp.{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 sm-mb-30">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Top Rate</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($toprate as $t)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$t->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$t->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>Rp.{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($topratee as $t)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$t->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$t->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>Rp.{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Hot Produk</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularproduk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                                                    <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularprodukk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                                                    <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>{{number_format($p->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Discount Product</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($discountproduk as $d)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$d->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$d->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>{{number_format($d->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($discountprodukk as $d)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity">
                                                    <img src="{{asset('assets/images/product/'.$d->produk_image)}}" style="width: 70px">
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a href="shop.html">{{$d->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <p>{{number_format($d->produk_price,2)}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- spacial-product-area end-->
    <!-- blog-area start -->
    <div class="blog-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-wrap">
                        <h2 class="section-title">latest News</h2>
                        <div class="blog-active owl-carousel next-prev-style">
                            @foreach ($latestnews as $l)
                            <div class="blog-item">
                                <div class="blog-img black-opacity">
                                    <img src="{{asset('assets/images/product/'.$l->produk_image)}}" style="width: 400px">
                                </div>
                                <div class="blog-content">
                                    <h3><a href="blog.html">{{$l->produk_name}}</a></h3>
                                    <ul class="blog-meta">
                                        <li><a href="#"><i class="fa fa-user"></i>{{$l->user->name}}</a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> 05 Comments</a></li>
                                        <li><a href="#"><i class="fa fa-clock-o"></i>{{$l->update_at}}</a></li>
                                    </ul>
                                    <p>{{$l->produk_note}}</p>
                                    <a class="readmore" href="blog-details.html">read more</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area end -->
    <!-- brand-area start -->
    <div class="brand-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-active owl-carousel">
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/1.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/2.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/3.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/4.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/5.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/6.jpg" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="assets/images/brand/7.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area end -->
@endsection