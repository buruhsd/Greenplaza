<!-- brand-area start -->
    <div class="brand-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-active owl-carousel" style="height: auto;">
                        @if($brand->count() == 0)
                        @else
                            @foreach($brand as $item)
                                <div class="brand-items">
                                    <a href="{{url('brand/'.$item->brand_slug)}}">
                                        <img src="{{ asset('assets/images/brand/'.(($item->brand_image)?$item->brand_image:'1.jpg')) }}" alt="{{asset('assets/images/brand/'.$item->brand_name)}}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area end -->