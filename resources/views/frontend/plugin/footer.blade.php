<!-- footer-area start -->
    <footer class="footer-area bg-5">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-widget footer-contact">
                            <h2 class="section-title">Contact us</h2>
                            <ul>
                                <!-- <li><i class="fa fa-map-marker"></i>House No. 09 , Road No.25 Dhaka,Bangladesh </li>
                                <li><i class="fa fa-phone"></i>+1(888)234-56789 <span>+1(888)234-56789</span> </li>
                                <li><i class="fa fa-envelope-o"></i>youremail@gmail.com <span>youremail@gmail.com</span></li>--> 
                                <li>
                                    <i class="fa fa-map-marker"></i>
                                    {{FunctionLib::get_config('profil_address')}}
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    {{FunctionLib::get_config('profil_phone')}}
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    {{FunctionLib::get_config('profil_email')}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
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
                    <!-- <div class="col-lg-3 col-sm-6 col-12">
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
                    </div> -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="footer-widget footer-menu">
                            <h2 class="section-title">Greenplaza</h2>
                            <ul>
                                <li><a href="#">Tentang Greenplaza</a></li>
                                @foreach(FunctionLib::page('greenplaza')->get() as $item)
                                    <li><a href="{{url('page/'.$item->page_slug)}}">{{$item->page_judul}}</a></li>
                                @endforeach
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
                        <p>&copy; 2018 <span>Greenpalza</span> All Right Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area end -->