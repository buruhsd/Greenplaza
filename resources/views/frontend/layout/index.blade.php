<!doctype html>
<html class="no-js" lang="">
@include('frontend.layout.html')
<body>
    <div class="se-pre-con"></div>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    @include('frontend.layout.header')
    @yield('content')
    <!-- Popup Subscribe Form -->
    
    <!-- Popup Subscribe Form -->
    {!! Plugin::footer()!!}
    {{-- @include('frontend.plugin.footer') --}}

    @include('frontend.layout.script')
    @yield('script')
</body>

</html>