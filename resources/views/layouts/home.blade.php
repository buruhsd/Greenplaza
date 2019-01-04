<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body style="background-color: #eeefff">
    
    @include('layouts.top-header')
    @include('frontend.plugin.slider')

    {!! Plugin::category2()!!}
   
    <!-- .product-area start -->
    {{-- @include('frontend.content.content-1') --}}
    {!! Plugin::produk_newest()!!}
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
    <!-- {!! Plugin::hot_promo()!!} -->
    {!! Plugin::recommended()!!}
    {!! Plugin::content_brand()!!}
    {{-- @include('frontend.content.content-brand') --}}
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>

    <!-- footer -->
    {!! Plugin::footer()!!}
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    {!! (isset($footer_script))? $footer_script:'' !!}
    <!-- script -->
</body>

</html>