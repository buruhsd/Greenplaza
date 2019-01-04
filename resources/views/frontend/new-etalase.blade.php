<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kinun - Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v3.3.7 css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/bootstrap.min.css') }}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/owl.carousel.min.css') }}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/font-awesome.min.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/animate.css') }}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/metisMenu.min.css') }}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/flaticon.css') }}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/jquery-ui.css') }}">
    <!-- slicknav.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/animate.css') }}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/styles.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/b/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('frontend/b/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-tor-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 col-12">
                        <p>Welcome you to Kinun store!</p>
                    </div>
                    <div class="col-md-8 col-sm-7 col-12">
                        <ul class="d-flex account-info">
                            <li><a href="javascript:void(0);"><i class="fa fa-user"></i> my Account <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="login.html">LogIn</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);"><i class="fa fa-language"></i> Language <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="javascript:void(0);">English <img src="assets/images/language/1.png" alt=""></a></li>
                                    <li><a href="javascript:void(0);">Bangla <img src="assets/images/language/2.png" alt=""></a></li>
                                    <li><a href="javascript:void(0);">Hindi  <img src="assets/images/language/3.png" alt=""></a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);"><i class="fa fa-usd"></i> USD <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="javascript:void(0);">EUR</a></li>
                                    <li><a href="javascript:void(0);">USD </a></li>
                                    <li><a href="javascript:void(0);">BDT </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="logo">
                            <a href="index.html">
                                <img class="dark-logo" src="assets/images/logo.png" alt="">
                                <img class="light-logo" src="assets/images/logo2.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-7 col-12">
                        <div class="search-wrap">
                            <form action="search">
                                <div class="select-menu" tabindex="1">
                                    <span>Categories </span>
                                    <ul class="dropdown">
                                        <li><a href="javascript:void(0);">Man</a></li>
                                        <li><a href="javascript:void(0);">Woman</a></li>
                                        <li><a href="javascript:void(0);">Kids</a></li>
                                        <li><a href="javascript:void(0);">Babys</a></li>
                                    </ul>
                                </div>
                                <input type="text" placeholder="Search Here...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <ul class="cart-wishlist-wrap d-flex">
                            <li><a href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> Cart<span>-$600</span></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-heart"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom-area bg-1 header-bottom-area-two">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-10">
                        <div class="cetagory-wrap">
                            <span>All cetagory</span>
                            <ul class="cetagory-items">
                                <li><a href="#"><i class="fa fa-chain-broken"></i> cetagory One <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-space-shuttle"></i> cetagory Two <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-suitcase"></i> cetagory Three <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-life-ring"></i> cetagory Four <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-taxi"></i> cetagory Five <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-taxi"></i> cetagory Five <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-bolt"></i> cetagory Six <i class="fa fa-angle-right pull-right"></i></a></li>
                                <li><a href="shop.html"><i class="fa fa-birthday-cake"></i> cetagory Seven <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-gg"></i> cetagory Eight <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html"><i class="fa fa-gg"></i> cetagory Eight <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="d-none d-lg-block"><a href="shop.html"><i class="fa fa-gg"></i> cetagory Eight <i class="fa fa-angle-right pull-right"></i></a>
                                    <ul class="sub-cetagory">
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <p>Cetagory Title </p>
                                            <ul>
                                                <li><a href="#">sub Cetagory 1</a></li>
                                                <li><a href="#">sub Cetagory 2</a></li>
                                                <li><a href="#">sub Cetagory 3</a></li>
                                                <li><a href="#">sub Cetagory 4</a></li>
                                                <li><a href="#">sub Cetagory 5</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 d-none d-md-block">
                        <ul class="mainmenu d-flex">
                            <li><a href="index.html">Home</a>
                            <li><a href="about.html">About</a></li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="shop.html">Shop Page</a></li>
                                    <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="Single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Blog <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 d-md-none d-block col-2">
                        <div class="responsive-menu-tigger d-block d-md-none">
                            <a href="javascript:void(0);">
                                <span class="first"></span>
                                <span class="second"></span>
                                <span class="third"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area d-block d-md-none">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="metismenu">
                                <li class="sidemenu-items"><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li class="sidemenu-items"><a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop</a>
                                    <ul aria-expanded="false">
                                        <li><a href="shop.html">Shop Page</a></li>
                                        <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                        <li><a href="Single-product.html">Product Details</a></li>
                                        <li><a href="cart.html">Shopping cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                    </ul>
                                </li>
                                <li class="sidemenu-items"><a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages</a>
                                    <ul aria-expanded="false">
                                        <li><a href="about.html">About Page</a></li>
                                        <li><a href="single-product.html">Product Details</a></li>
                                        <li><a href="cart.html">Shopping cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                    </ul>
                                </li>
                                <li class="sidemenu-items"><a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                    <ul aria-expanded="false">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
    <!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Shop Page</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- .shop-page-area start -->
    <div class="shop-page-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-3 col-sm-4 col-12">
                                <select name="stor" class="select-style">
                                    <option disabled selected>Sort by Defalt</option>
                                    <option>Australia</option>
                                    <option>Brazil</option>
                                    <option>Cambodia</option>
                                    <option>Dominica</option>
                                    <option>France</option>
                                    <option>Guyana</option>
                                    <option>Hong Kong</option>
                                    <option>Ireland</option>
                                    <option>Japan</option>
                                    <option>Malaysia</option>
                                    <option>Nepal</option>
                                    <option>Oman</option>
                                    <option>Peru</option>
                                </select>
                            </div>
                            <div class=" col-lg-5 col-sm-5 col-12">
                                <p class="total-product">Showing 1-12 of 150 Results</p>
                            </div>
                            <div class="col-lg-4 col-12 col-sm-3">
                                <ul class="nav shop-menu">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#grid"><i class="fa fa-th"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#list"><i class="fa fa-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="row">
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/1.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/2.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/3.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/4.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/5.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/6.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/7.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/8.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/9.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/10.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/11.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/12.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/13.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/14.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/15.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/16.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/17.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/18.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/19.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/20.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/21.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/22.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="{{ asset('frontend/b/images/product/23.jpg') }}" alt="">
                                                <img class="second" src="{{ asset('frontend/b/images/product/24.jpg') }}" alt="">
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
                                    </div>
                                    <div class="col-12">
                                        <div class="pagination-wrapper text-center">
                                            <ul class="page-numbers">
                                                <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                <li><a class="page-numbers" href="#">1</a></li>
                                                <li><span class="page-numbers current">2</span></li>
                                                <li><a class="page-numbers" href="#">3</a></li>
                                                <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="list">
                                <div class="product-list">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/1.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/2.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/3.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/4.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/5.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/6.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/7.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/8.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/9.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/10.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="{{ asset('frontend/b/images/product/11.jpg') }}" alt="">
                                                    <img class="second" src="{{ asset('frontend/b/images/product/12.jpg') }}" alt="">
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
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
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
                                        </div>
                                        <div class="col-12">
                                            <div class="pagination-wrapper text-center">
                                                <ul class="page-numbers">
                                                    <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                    <li><a class="page-numbers" href="#">1</a></li>
                                                    <li><span class="page-numbers current">2</span></li>
                                                    <li><a class="page-numbers" href="#">3</a></li>
                                                    <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                                </ul>
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
    </div>
    <!-- .shop-page-area enc -->
    <!-- footer-area start -->
    <footer class="footer-area bg-1">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer-widget footer-contact">
                            <h2 class="section-title">Contact us</h2>
                            <ul>
                                <li><i class="fa fa-map-marker"></i>House No. 09 , Road No.25 Dhaka,Bangladesh </li>
                                <li><i class="fa fa-phone"></i>+1(888)234-56789 <span>+1(888)234-56789</span> </li>
                                <li><i class="fa fa-envelope-o"></i>youremail@gmail.com <span>youremail@gmail.com</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Customer Service</h2>
                            <ul>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Order History</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Specials</a></li>
                                <li><a href="#">Help Center</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Corporation</h2>
                            <ul>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Company</a></li>
                                <li><a href="#">Investor Relations</a></li>
                                <li><a href="#">Advanced Search</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Why Choose us</h2>
                            <ul>
                                <li><a href="#">Shopping Guide</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="#">Company</a></li>
                                <li><a href="#">Investor Relations</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; 2018 <span>Kinun</span> All Right Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('frontend/b/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/b/js/bootstrap.min.js') }}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('frontend/b/js/owl.carousel.min.js') }}"></script>
    <!-- mouse_scroll.js -->
    <script src="{{ asset('frontend/b/js/mouse_scroll.js') }}"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('frontend/b/js/scrollup.js') }}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('frontend/b/js/jquery.zoom.min.js') }}"></script>
    <!-- jquery.countdown.min.js -->
    <script src="{{ asset('frontend/b/js/jquery.countdown.min.js') }}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('frontend/b/js/metisMenu.min.js') }}"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('frontend/b/js/mailchimp.js') }}"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('frontend/b/js/jquery-ui.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('frontend/b/js/scripts.js') }}"></script>
</body>

</html>