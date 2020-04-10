@extends('frontend.layout.index', ['active' => 'home'])
@section('title', 'Home')
@section('content')

    <div class="slider-area" class="space-header-and-body" style="padding-top: 62px;margin-bottom: 180px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="cetagory-wrap home">
                        <span>{{__('front.all-cat') }}</span>
                        <ul class="cetagory-items">
                            <?php $cat = App\Models\Category::whereRaw('category_parent_id = 0')->limit(5)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->get();?>
                            {{-- {{dd($cat)}} --}}
                            @foreach($cat as $item)
                                <li><a href="{{route('category', ['cat'=>$item->category_slug])}}"><i class="fa fa-chain-broken"></i> {{ucfirst(strtolower($item->category_name))}} <i class="fa fa-angle-right pull-right"></i></a>
                                    <?php $sub_cat = App\Models\Category::whereRaw('category_parent_id = '.$item->id)->limit(10)->get();?>
                                    @if($sub_cat->count() > 0)
                                        <ul class="sub-cetagory col-md-12 col-sm-12">
                                            <li>
                                                <p>{{ucfirst(strtolower($item->category_name))}}</p>
                                                <ul>
                                                    @foreach($sub_cat as $item2)
                                                        <li><a href="{{route('category', ['cat'=>$item2->category_slug])}}">
                                                            {{ucfirst(strtolower($item2->category_name))}}</a>
                                                            <?php $sub_cat = App\Models\Category::whereRaw('category_parent_id = '.$item2->id)->limit(10)->get();?>
                                                            @if($sub_cat->count() > 0)
                                                                <ul class="sub-cetagory col-md-12 col-sm-12">
                                                                    <li>
                                                                        <p>{{ucfirst(strtolower($item2->category_name))}}</p>
                                                                        <ul>
                                                                            @foreach($sub_cat as $item3)
                                                                                <li><a href="{{route('category', ['cat'=>$item3->category_slug])}}">
                                                                                    {{ucfirst(strtolower($item3->category_name))}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                            <li><a href="{{route('category', ['cat'=>$item2->category_slug])}}">Lainya...</a>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                    <li><a href="{{route('category', ['cat'=>$item->category_slug])}}">Lainya...</a>
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            <li><a href="{{route('category')}}"><i class="fa fa-chain-broken"></i> {{__('front.all-cat') }}... <i class="fa fa-angle-right pull-right"></i></a>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="slider-active owl-carousel next-prev-btn">
                        {!!Plugin::view('iklan', [
                                'id'=>1,
                                'type'=>'2',
                                'name'=>'slider',
                            ])
                        !!}
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 d-none d-lg-block">
                    {!!Plugin::view('iklan', [
                            'id'=>4,
                            'type'=>'1',
                            'name'=>'banner3',
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 d-none d-lg-block">
                    <div class="featured2-wrap">
                        <div class="featured-img ">
                            <table class="table table-borderless" >
                              <tbody>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/hotel.png')}}" style="width: 30px;" alt="alt text">{{-- <div class="lazy-background four"></div> --}} {{__('front.hotel') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/game.png')}}" style="width: 30px;" alt="alt text">{{-- <div class="lazy-background five"></div> --}} {{__('front.game') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/kartukredit.png')}}" style="width: 30px;" alt="alt text"> {{-- <div class="lazy-background six"></div> --}}{{__('front.pay') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/voucheronline.png')}}" style="width: 20px;" alt="alt text"> {{-- <div class="lazy-background seven"></div> --}}{{__('front.vou') }}</td>

                                </tr>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/pesawat.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background eight"></div> --}} {{__('front.tiket_pesawat') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/pay.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background nine"></div> --}} {{__('front.pembayaran') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/pdam.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background ten"></div> --}} {{__('front.pdam') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/voucherfisik.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background eleven"></div> --}} {{__('front.voucher') }}</td>

                                </tr>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/plnprabayar.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background twelve"></div> --}}{{__('front.pln') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/tv.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background thirteen"></div> --}} {{__('front.tv') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/ticket.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background fourteen"></div> --}} {{__('front.ticket_ol') }}</td>
                                  <td><img src="{{asset('/frontend/images/icon/topupsaldo.png')}}" style="width: 20px;" alt="alt text">{{-- <div class="lazy-background fiveteen"></div> --}} {{__('front.topup') }}</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featured-area3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 d-none d-lg-block">
                    {!!Plugin::view('iklan', [
                            'id'=>5,
                            'type'=>'1',
                            'name'=>'banner4',
                        ])
                    !!}
                </div>
                <div class="col-lg-6 col-md-6">
                    {!!Plugin::view('iklan', [
                            'id'=>6,
                            'type'=>'1',
                            'name'=>'banner5',
                        ])
                    !!}
                </div>
                <div class="col-lg-3 col-md-3">
                    {!!Plugin::view('iklan', [
                            'id'=>7,
                            'type'=>'1',
                            'name'=>'banner6',
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="product-sidebar">
                        <h2 class="section-title">{{__('front.populer_saat') }}</h2>
                        {!!Plugin::p_populer_saat_ini()!!}
                    </div>
                    <div class="product-sidebar" style="width: 100%">
                        <h2 class="section-title">{{__('front.harga_diskon') }}</h2>
                        {!!Plugin::p_harga_diskon()!!}
                    </div>
                    <div class="tag-wrap">
                        <h2 class="section-title">{{__('front.k_populer') }}</h2>
                        <ul>
                        <?php $cat = App\Models\Category::whereRaw('category_parent_id = 0')->limit(8)->get();?>
                                {{-- {{dd($cat)}} --}}
                                @foreach($cat as $item)
                                    <li>
                                        <a href="{{route('category', ['cat'=>$item->category_slug])}}">
                                            {{ucfirst(strtolower($item->category_name))}}
                                        </a>
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                    <div class="product-sidebar">
                        <h2 class="section-title">{{__('front.populer_saat') }}</h2>
                        {!!Plugin::p_populer_saat_ini2()!!}
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="shop-area non-margin">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Green Production</h2>
                            </div>
                        </div>
                        {!!Plugin::p_green()!!}
                    </div>
                    <div class="shop-area non-margin">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">{{__('front.baru_saat') }}</h2>
                            </div>
                        </div>
                        {!!Plugin::p_baru_saat_ini()!!}
                    </div>
                    <div class="banner-wrap mb-30">
                        {!!Plugin::view('iklan', [
                                'id'=>8,
                                'type'=>'1',
                                'name'=>'banner7',
                            ])
                        !!}
                    </div>
                    <div class="shop-area non-margin">
                        <div class="row">
                            <div class="col-lg-4 col-sm-3 col-12">
                                <h2 class="section-title">{{__('front.p_baru') }}</h2>
                            </div>
                        </div>
                        {!!Plugin::p_baru()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    <!-- banner-area start -->
    <div class="banner-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    {!!Plugin::view('iklan', [
                            'id'=>9,
                            'type'=>'1',
                            'name'=>'banner8',
                        ])
                    !!}
                </div>
                <div class="col-lg-9 col-12">
                    <div class="row">
                        <div class="col-md-6 sm-mb-30 col-12">
                            {!!Plugin::view('iklan', [
                                    'id'=>10,
                                    'type'=>'1',
                                    'name'=>'banner9',
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 col-12">
                            {!!Plugin::view('iklan', [
                                    'id'=>11,
                                    'type'=>'1',
                                    'name'=>'banner10',
                                ])
                            !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-area end -->
    <!-- .product-area start -->
    <div class="product-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="product-sidebar">
                        <h2 class="section-title">{{__('front.populer_saat') }}</h2>
                        {!!Plugin::p_populer_saat_ini3()!!}
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">{{__('front.pilihan_saat') }}</h2>
                            </div>
                        </div>
                        {!!Plugin::p_pilihan_saat_ini()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12 sm-mb-30">
                    {!!Plugin::view('iklan', [
                            'id'=>12,
                            'type'=>'1',
                            'name'=>'banner11',
                        ])
                    !!}
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="testmonial-wrap">
                        <h2 class="section-title">{{__('front.kata_konsumen') }}</h2>
                        <div class="test-active owl-carousel next-prev-style">
                            @foreach ($review as $r)
                            <div class="test-items">
                                <div class="test-img">
                                    <img src="{{asset('assets/images/profil/'.$r->userdetail->user_detail_image)}}" onerror="this.src='{!!asset("assets/images/profil/nopic.png")!!}'" alt="" />
                                </div>
                                <div class="test-content">
                                    <h3>{{$r->user->name}}</h3>
                                    <span>User</span>
                                    <p>{{$r->review_text}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
    <!-- spacial-product-area start-->
    <div class="spacial-product-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="spacial-product-wrap">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12 sm-mb-30">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Trending</h2>
                                    {!!Plugin::p_trending()!!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 sm-mb-30">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Top Rate</h2>
                                    {!!Plugin::p_top_rate()!!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Hot Produk</h2>
                                    {!!Plugin::p_hot()!!}
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">{{__('front.harga_diskon') }}</h2>
                                    {!!Plugin::p_diskon()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- spacial-product-area end-->
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
@section('script')
    {{-- <script type="text/javascript">
        function myTimer() {
            $("#a-b-l").toggle("slow");
            $("#a-b-r").toggle("slow");
        }
        var myVar = setInterval(myTimer, 2000);
        // call this line to stop the loop:
        // clearInterval(myVar);
    </script> --}}

    
@endsection