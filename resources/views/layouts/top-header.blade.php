<!-- header-area start -->
    <header class="header-area">
        <div class="header-tor-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 col-4">
                        <ul  class="d-flex account-info-social" style="display: inline;">
                                        <li>Ikuti kami :</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                    </div>
                    <div class="col-md-8 col-sm-7 col-12">
                        <ul class="d-flex account-info">
                        <li class="li-cart"><a href="{{route('chart')}}">
                                <i class="fa fa-shopping-cart"></i></a>
                                @if(Session::has('chart') && count(Session::get('chart')) > 0)
                                    <span class="badge-2">{{count(Session::get('chart'))}}</span>
                                @else
                                @endif
                            </li>
                        <li>

                            <a href="javascript:void(0);"><i class="fa fa-bell"></i></a>
                            <span class="badge-1" data-badge="6"></span></li>
                            <li>


                                @guest
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
                                @else
                                    <a href="javascript:void(0);"><i class="fa fa-user"></i> 
                                        {{Auth::user()->name}}
                                    <i class="fa fa-angle-down"></i></a>
                                @endguest
                                @guest
                                @else
                                <ul>
                                    @if(Auth::user()->is_admin())
                                        <li><a href="{{route('admin.config.profil')}}">Profil</a></li>
                                        <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                        <li><a href="{{route('admin.wishlist')}}">Wishlist</a></li>
                                    @elseif(Auth::user()->is_member())
                                        <li><a href="{{route('member.profil')}}">Profil</a></li>
                                        <li><a href="{{route('member.dashboard')}}">Dashboard</a></li>
                                        <li><a href="{{route('member.wishlist')}}">Wishlist</a></li>
                                    @endif
                                    <li>
                                        <a onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                @endguest
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        <div class="header-middle-area bg-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-2">
                        <div class="logo">
                            <a href="{{url("/")}}">
                                <img class="dark-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="" >
                                <img class="light-logo" src="{{ asset('frontend/images/logo-fix.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-8 col-12">
                        <div class="search-wrap">
                            <form action="{{route('category')}}" method="GET">
                                <select name="cat" hidden>
                                    @if(isset($_GET['cat']) && $_GET['cat'] != "")
                                    <option value="{{$_GET['cat']}}" selected>{{$_GET['cat']}}</option>
                                    @else
                                    <option value="" selected>null</option>
                                    @endif
                                </select>
                                <input name="src" type="text" placeholder="Cari Produk...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 d-sm-none d-md-block d-none d-sm-block ">
                        <ul class="cart-wishlist-wrap d-flex">
                            <li><a href="{{route('chart')}}">
                                <i class="fa fa-shopping-cart"></i></a>
                                @if(Session::has('chart') && count(Session::get('chart')) > 0)
                                    <span class="badge">{{count(Session::get('chart'))}}</span>
                                @else
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="header-bottom-area bg-1 header-bottom-area-two">
            <div class="container">
                <div class="row">

                    <div class="col-lg-9 col-md-8 d-none d-md-block">
                        <ul class="mainmenu d-flex">
                            <li><a href="{{route('home')}}">Home </a></li>
                            <li><a href="about.html">About</a></li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Shop <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="shop.html">Shop Page</a></li>
                                    <li><a href="shop-sidebar.html">Shop Sidebar</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="{{route('member.wishlist')}}">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="sidemenu-items"><a href="javascript:void(0);">Pages <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="Single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="{{route('member.wishlist')}}">Wishlist</a></li>
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
