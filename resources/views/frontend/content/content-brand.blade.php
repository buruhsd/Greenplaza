<!-- brand-area start -->
    <div class="brand-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-active owl-carousel">
                        @if($brand->count() == 0)
                        @else
                            @foreach($brand as $item)
                                <div class="brand-items">
                                    <a href="{{url('brand/'.$item->brand_slug)}}">
                                        <img src="{{ asset('frontend/images/brand/').($item->brand_image)?$item->brand_image:'1.jpg' }}" alt="{{$item->brand_name}}">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/2.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/3.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/4.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/5.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/6.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="brand-items">
                            <a href="#">
                                <img src="{{ asset('frontend/images/brand/7.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area end -->