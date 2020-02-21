<!-- footer-area start -->
    <footer class="footer-area bg-5">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget footer-contact">
                            <h2 class="section-title">Contact us</h2>
                            <ul>
                                <!-- <li><i class="fa fa-map-marker"></i>House No. 09 , Road No.25 Dhaka,Bangladesh </li>
                                <li><i class="fa fa-phone"></i>+1(888)234-56789 <span>+1(888)234-56789</span> </li>
                                <li><i class="fa fa-envelope-o"></i>youremail@gmail.com <span>youremail@gmail.com</span></li>--> 
                               
                                <li>
                                    <i class="fa fa-phone"></i>
                                    {{FunctionLib::get_config('profil_phone')}}
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    {{-- {{FunctionLib::get_config('profil_email')}} --}}
                                    GiPlaza.co.id
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Member</h2>
                            <ul>
                                @foreach(FunctionLib::page('member')->get() as $item)
                                    <li><a href="{{url('page/'.$item->page_slug)}}">{{$item->page_judul}}</a></li>
                                @endforeach
                                <li><a href="#">Bantuan</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Giplaza</h2>
                            <ul>
                                @foreach(FunctionLib::page('greenplaza')->get() as $item)
                                    <li><a href="{{url('page/'.$item->page_slug)}}">{{$item->page_judul}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">About Us</h2>
                            <ul>
                                @foreach(FunctionLib::page('aboutus')->get() as $item)
                                    <li><a href="{{url('page/'.$item->page_slug)}}">{{$item->page_judul}}</a></li>
                                @endforeach
                                <li><a href="{{ url('greenplaza_faq') }}">FAQ</a></li>
                                <li><a href="{{ url('about') }}">About US</a></li>
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
                        <p>&copy; 2020 <span>GiPlaza</span> All Right Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area end -->