<!-- header-area start -->
    <header class="header-area">
        <div class="header-tor-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 col-12">
                        <p>Welcome you to GreenPlaza store!</p>
                    </div>
                    <div class="col-md-8 col-sm-7 col-12">
                        <ul class="d-flex account-info">
                            <li><a href="javascript:void(0);"><i class="fa fa-user"></i> my Account <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="{{route('login')}}">LogIn</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                    <li><a href="{{route('checkout')}}">Checkout</a></li>
                                    <li><a href="">Wishlist</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0);"><i class="fa fa-language"></i> Language <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="javascript:void(0);">English <img src="{{ asset('frontend/images/language/1.png') }}" alt=""></a></li>
                                    <li><a href="javascript:void(0);">Bangla <img src="{{ asset('frontend/images/language/2.png') }}" alt=""></a></li>
                                    <li><a href="javascript:void(0);">Hindi  <img src="{{ asset('frontend/images/language/3.png') }}" alt=""></a></li>
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
                                <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="">
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
        <div class="header-bottom-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-10">
                        <div class="cetagory-wrap">
                            <span>All Category</span>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 d-none d-md-block">
                        <ul class="mainmenu d-flex">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="shop.html">Shop Page</a></li>
                                    <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                    <li><a href="Single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
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
    <!-- slider-area start -->