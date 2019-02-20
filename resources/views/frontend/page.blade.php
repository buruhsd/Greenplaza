@extends('frontend.layout.indexall')
@section('title', 'Page Title')
@section('content')
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    <!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-5" src="">
                        <div class="breadcumb-content black-opacity" style="background-image: url({{asset("images/header_page/".$page->page_header_image)}});background-size: 100% 100%;">
                            <h2></h2>
                            <ul>
                                <li></li>
                                <li></li>
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
                {!!Plugin::view('side_left', [])!!}
                <div class="col-lg-9 col-12 blog-details-wrap p-10 bg-5 mb-30">
                    <h4>{!!$page->page_judul!!}</h4>
                    <hr/>
                    <br/>
                    {!!$page->page_text!!}
                    {{-- content --}}
                </div>
            </div>
        </div>
    </div>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}