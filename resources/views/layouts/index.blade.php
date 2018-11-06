<!doctype html>
<html class="no-js" lang="">

@include('layouts.header')

<body>
    
    @include('layouts.top-header')
    @include('layouts.slider')
    @include('layouts.banner-1')
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
                    @include('content.content-1')
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    @include('layouts.banner-2')
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                @include('content.content-2')
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    @include('content.content-3')
    @include('content.content-4')
    @include('content.content-5')
    @include('content.content-brand')

    <!-- footer -->
    @include('layouts.footer')
    <!-- footer -->
    
    <!-- script -->
    @include('layouts.script')
    <!-- script -->
</body>

</html>