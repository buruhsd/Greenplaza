<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    
    @include('layouts.top-header')
    @include('frontend.plugin.slider')
    @include('frontend.plugin.banner-1')
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
                    @include('frontend.content.content-1')
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                @include('frontend.popular')
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    @include('frontend.hot-promo')
    @include('frontend.recommended-items')
    @include('frontend.content.content-brand')

    <!-- footer -->
    @include('frontend.plugin.footer')
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    {!! (isset($footer_script))? $footer_script:'' !!}
    <!-- script -->
</body>

</html>