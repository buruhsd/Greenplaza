<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    @include('layouts.top-header')
    @include('frontend.plugin.slider-new')
    
    <!-- .shop-page-area start -->
    
    <!-- @include('layouts.content-1') -->
    @yield('content')
                   
    <!-- .shop-page-area enc -->
    <!-- footer -->
    {!! Plugin::footer()!!}
    {{-- @include('frontend.plugin.footer') --}}
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    {!! (isset($footer_script))? $footer_script:'' !!}
    <!-- script -->
</body>

</html>