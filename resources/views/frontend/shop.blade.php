@extends('layouts.index')
@section('title', 'Page Title')
@section('content')
<!-- breadcumb-area end -->
    <div class="about-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="p-10 bg-1">
                        <div class="row">
                            <div class="col-lg-6 col-12 order-2">
                                <div class="about-wrap">
                                    <h2>Webcome Our <span>Kinun</span></h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit voluptate quae exercitationem optio id architecto eius laborum adipisci laudantium libero beatae, officiis pariatur fugiat, quo veritatis quisquam totam iure quaerat. id architecto eius laborum adipisci laudantium libero beatae, officiis pariatur fugiat, quo veritatis quisquam totam iure quaerat.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit voluptate quae exercitationem optio id architecto eius laborum adipisci laudantium libero beatae, officiis pariatur fugiat, quo veritatis quisquam totam iure quaerat.</p>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit voluptate quae exercitationem optio id architecto eius laborum adipisci laudantium libero beatae, officiis pariatur fugiat, quo veritatis quisquam totam iure quaerat. laudantium libero beatae, officiis pariatur fugiat, quo veritatis quisquam totam iure quaerat.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 order-0">
                                <div class="about-img black-opacity">
                                    <img src="{{ asset('frontend/images/about.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="col-lg-12 col-md-8 col-12">
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
                                    <img class="first" src="{{ asset('frontend/images/product/16.jpg') }}" alt="">
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
                                    <img class="first" src="{{ asset('frontend/images/product/16.jpg') }}" alt="">
                                    <img class="second" src="{{ asset('frontend/images/product/5.jpg') }}" alt="">
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
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}