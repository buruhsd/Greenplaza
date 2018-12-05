@extends('layouts.index')
@section('title', 'Page Title')
@section('content')
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    <!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1" style="background-color: #000">
                        <div class="breadcumb-content black-opacity">
                            <h2>Blog Details</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Blog Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- blog-details-area start-->
    <div class="blog-details-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12 blog-details-wrap p-10 bg-1 mb-30">
                    {!!$page->page_judul!!}
                    {{-- content --}}
                </div>
                <div class="col-lg-3 col-12">
                    <aside class="sidebar-area p-10 bg-1">
                        <div class="widget widget_categories">
                            <h2 class="section-title">Categories</h2>
                            <ul>
                                @foreach($side_cat as $item)
                                    <li><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="product-sidebar">
                            <h2 class="section-title">Related Product</h2>
                            <div class="slidebar-product-wrap">
                                @foreach($side_related as $item)
                                    <div class="product-sidebar-items fix">
                                        <div class="product-sidebar-img black-opacity">
                                            <img src="assets/images/product/sidebar/24.jpg" alt="">
                                        </div>
                                        <div class="product-sedebar-content fix">
                                            <h4><a href="shop.html">{{$item->produk_name}}</a></h4>
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <p>
                                                @if($item->produk_discount > 0)
                                                    Rp. {{FunctionLib::number_to_text($item->produk_price - ($item->produk_price * $item->produk_discount / 100))}}&nbsp;/&nbsp;
                                                    <del class="text-danger">Rp. {{FunctionLib::number_to_text($item->produk_price)}}</del>
                                                @else
                                                    Rp. {{FunctionLib::number_to_text($item->produk_price)}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}