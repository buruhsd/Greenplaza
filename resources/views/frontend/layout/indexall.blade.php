<!doctype html>
<html class="no-js" lang="">
@include('frontend.layout.html')
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    @include('frontend.layout.headerall')
    @yield('content')
    @include('frontend.layout.footer')
    <!-- Popup Subscribe Form -->
    <div id="popup-subscribe" class="modal fade">
        <div class="modal-dialog subscribe-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="modal-close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <div class="d-flex">
                    <div class="modal-img d-none d-md-block black-opacity">
                        <img src="{{ asset('frontend/assets/images/modal.jpg') }}" alt="">
                    </div>
                    <div class="modal-subscribe flex-style">
                        <div class="subscribe-box">
                            <h2>Subscribe to Our Newsletter</h2>
                            <p>Received 10% Discount on Your Next Purchase!</p>
                            <form id="mc-form" class="sform">
                                <div class="form_msg">
                                    <label class="mt10" for="mc-email"></label>
                                </div>
                                <div class="subscribe-form">
                                    <input type="email" name="email" id="mc-email" placeholder="Enter Your Email" required>
                                    <input type="submit" name="submit" value="subscribe">
                                </div>
                            </form>
                            <p class="no-padding fz-12">By submitting your email you will accept our privacy policy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popup Subscribe Form -->
    @include('frontend.layout.script')
    @yield('script')
</body>

</html>