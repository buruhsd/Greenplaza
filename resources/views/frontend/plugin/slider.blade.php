<!-- slider-area start -->
    <div class="slider-area">
        
            
            <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-4">
                <div class="header-middle-area">
                    <div class="col-9 .d-lg-none .d-xl-block .d-xl-none">
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
                <div class=" col-3">
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
                <div class="slider-active owl-carousel next-prev-btn">
                    <div class="slider-item black-opacity">
                                      
                        <img src="{{ asset('frontend/images/banner/BANNER1.png') }}" alt="" class="slider">
                        <div class="slider-content">
                            
                        </div>
                    </div>
                    <div class="slider-item black-opacity">
                        <img src="{{ asset('frontend/images/banner/BANNER2.png') }}" alt="" class="slider">
                    </div>
                </div>                                            
            </div>
            
        
    </div>
    <!-- slider-area end -->