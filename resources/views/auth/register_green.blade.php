<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="breadcumb-wrap bg-1">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="account-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="account-form form-style bg-1">
                        <p>Sponsor</p>
                        <input type="text">
                        <p>Username</p>
                        <input type="text">
                        <p>Nama Lengkap</p>
                        <input type="text">
                        <p>Jenis Kelamin</p>
                        <label class="radio-inline"><input type="radio" name="optradio" checked>Laki-Laki</label>
                        <label class="radio-inline"><input type="radio" name="optradio">Perempuan</label>
                        <p>Password</p>
                        <input type="Password">
                        <p>Re-Password</p>
                        <input type="Password">
                        <input type="text" placeholder="Name" id="fname" name="fname">
                        <input type="text" placeholder="Email" id="email" name="email">
                        <input type="text" placeholder="Subject" id="subject" name="subject">
                        <textarea class="contact-textarea" placeholder="Message" id="msg" name="msg"></textarea>
                                
                        <button>Register</button>
                        <div class="text-center">
                            <a href="login.html">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->
   
    @include('layouts.script')
</body>

</html>