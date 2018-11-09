<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    @include('layouts.top-header')
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
            <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        
                    </div>
            </div>
            </div>
        </div>
    </div>
    <!-- .shop-page-area start -->
    
                        <!-- @include('layouts.content-1') -->
                        @yield('content')
                   
    <!-- .shop-page-area enc -->
    <!-- footer -->
    @include('frontend.plugin.footer')
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    {!! (isset($footer_script))? $footer_script: !!}
    <!-- script -->
</body>

</html>