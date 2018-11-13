<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    
    @include('layouts.top-header')
    @include('frontend.plugin.slider')
    @include('frontend.plugin.banner-1')
    <!-- .product-area start -->
    @include('frontend.content.content-1')
    <!-- .product-area end -->
    
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                {!! Plugin::populer()!!}
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    {!! Plugin::hot_promo()!!}
    {!! Plugin::recommended()!!}
    {!! Plugin::content_brand()!!}
    {{-- @include('frontend.content.content-brand') --}}

    <!-- footer -->
    {!! Plugin::footer()!!}
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    {!! (isset($footer_script))? $footer_script:'' !!}
    <!-- script -->
</body>

</html>