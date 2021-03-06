<div class="slider-area-new">
    <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-4">
        <div class="header-middle-area-new">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-3 .d-lg-none .d-xl-block .d-xl-none">
                        <ul class="d-flex account-info1">
                            <li style="color: #121212;"><a href="{{ url('/') }}"><i class="fa fa-arrow-left"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-7 col-md-6 .d-lg-none .d-xl-block .d-xl-none">
                        <div class="search-wrap">
                            <form action="{{route('category')}}" method="GET">
                                <select name="cat" hidden>
                                    @if(isset($_GET['cat']) && $_GET['cat'] != "")
                                    <option value="{{$_GET['cat']}}" selected>{{$_GET['cat']}}</option>
                                    @else
                                    <option value="" selected>null</option>
                                    @endif
                                </select>
                                <input class=" d-md-none d-lg-none d-xl-none" name="src" type="text" placeholder="Cari Produk...">
                                <button class=" d-md-none d-lg-none d-xl-none"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-3 col-md-3 .d-lg-none .d-xl-block .d-xl-none">
                        <ul class="d-flex account-info1">
                            <li>
                                @guest
                                    <li><a href="{{route('login')}}"><i class="fa fa-user"></i></a></li>
                                    <li><a href="{{route('register')}}"><i class="fa fa-user"></i></a></li>
                                @else
                                    <a href="javascript:void(0);"><i class="fa fa-user" style="color: #121212;"></i> 
                                        <!-- {{Auth::user()->name}} -->
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
                                        <li><a href="">{{Auth::user()->name}}</a></li>
                                        <li><a href="{{route('member.profil')}}">Profil</a></li>
                                        <li><a href="{{route('member.dashboard')}}">Dashboard</a></li>
                                        <li><a href="{{route('member.wishlist')}}">Wishlist</a></li>
                                        <li><a href="{{route('chart')}}">
                                        <i class="fa fa-shopping-cart"></i></a>
                                        @if(Session::has('chart') && count(Session::get('chart')) > 0)
                                            <span class="badge-2">{{count(Session::get('chart'))}}</span>
                                        @else
                                        @endif
                                        </li>
                                    @endif
                                    <li>
                                        <a onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" style="color: #121212;">
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
    </div>
</div>
            

               
