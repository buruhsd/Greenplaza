<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    
    @include('frontend.plugin.top-header')
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
    @include('frontend.plugin.banner-2')
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                @include('frontend.content.content-2')
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    @include('frontend.content.content-3')
    @include('frontend.content.content-4')
    @include('frontend.content.content-5')
    @include('frontend.content.content-brand')

    <!-- footer -->
    @include('frontend.plugin.footer')
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    <!-- script -->
</body>

</html>