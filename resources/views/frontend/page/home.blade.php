@extends('frontend.layout.index', ['active' => 'home'])
@section('title', 'Home')
@section('content')

    <div class="slider-area" class="space-header-and-body" style="padding-top: 62px;margin-bottom: 180px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="cetagory-wrap home">
                        <span>Semua kategori</span>
                        <ul class="cetagory-items">
                            <?php $cat = App\Models\Category::whereRaw('category_parent_id = 0')->limit(4)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->get();?>
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
                            <li><a href="{{route('category')}}"><i class="fa fa-chain-broken"></i> Semua Kategori... <i class="fa fa-angle-right pull-right"></i></a>
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

                    {{-- <div class="featured-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-xs-15">
                                    {!!Plugin::view('iklan', [
                                            'id'=>2,
                                            'type'=>'1',
                                            'name'=>'banner1',
                                        ])
                                    !!}
                                </div>
                            </div>
                        </div>                        
                    </div> --}}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 d-none d-lg-block">
                    {{-- @if (\Auth::check())
                        <div class="author-wrap">
                            @if (Auth::user()->user_detail->user_detail_image != null)
                            <img src="{{asset('assets/images/profil/'.Auth::user()->user_detail->user_detail_image)}}" style="width: 110px" onerror="this.src='{{ asset('assets/images/profil/nopic.png') }}'">
                            @else
                            <img src="{{ asset('assets/images/profil/nopic.png') }}" alt="">
                            @endif
                            <h4>{{Auth::user()->name}}</h4>
                        </div>
                    @else
                        <div class="author-wrap">
                            <img src="{{ asset('assets/images/profil/nopic.png') }}" style="height: 
                                130px">
                        </div>
                    @endif --}}
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
                            <table class="table table-bordered">
                              <tbody>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/hotel.png')}}" style="width: 30px;" alt="alt text"> Hotel</td>
                                  <td><img src="{{asset('/frontend/images/icon/game.png')}}" style="width: 30px;" alt="alt text"> Game</td>
                                  <td><img src="{{asset('/frontend/images/icon/kartukredit.png')}}" style="width: 30px;" alt="alt text"> Payment</td>
                                </tr>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/pesawat.png')}}" style="width: 20px;" alt="alt text"> Tiket Pesawat</td>
                                  <td><img src="{{asset('/frontend/images/icon/pay.png')}}" style="width: 20px;" alt="alt text"> Pembayaran</td>
                                  <td><img src="{{asset('/frontend/images/icon/pdam.png')}}" style="width: 20px;" alt="alt text"> Air PDAM</td>
                                </tr>
                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/plnprabayar.png')}}" style="width: 20px;" alt="alt text"> Listrik PLN</td>
                                  <td><img src="{{asset('/frontend/images/icon/tv.png')}}" style="width: 20px;" alt="alt text"> TV Berbayar</td>
                                  <td><img src="{{asset('/frontend/images/icon/ticket.png')}}" style="width: 20px;" alt="alt text"> Ticket Online</td>
                                </tr>

                                <tr>
                                  
                                  <td><img src="{{asset('/frontend/images/icon/topupsaldo.png')}}" style="width: 20px;" alt="alt text"> TopUp Saldo</td>
                                  <td><img src="{{asset('/frontend/images/icon/voucherfisik.png')}}" style="width: 20px;" alt="alt text"> Voucher</td>
                                  <td><img src="{{asset('/frontend/images/icon/voucheronline.png')}}" style="width: 20px;" alt="alt text"> Voucher Online</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="featured-area">
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
                        <h2 class="section-title">Produk populer saat ini</h2>
                        {!!Plugin::p_populer_saat_ini()!!}
                    </div>
                    <div class="product-sidebar" style="width: 100%">
                        <h2 class="section-title">Harga Diskon</h2>
                        {!!Plugin::p_harga_diskon()!!}
                    </div>
                    <div class="tag-wrap">
                        <h2 class="section-title">Kategori Populer</h2>
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
                        <h2 class="section-title">Produk populer saat ini</h2>
                        {!!Plugin::p_populer_saat_ini2()!!}
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Green Production</h2>
                            </div>
                        </div>
                        {!!Plugin::p_green()!!}
                    </div>
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Produk baru saat ini</h2>
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
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-lg-4 col-sm-3 col-12">
                                <h2 class="section-title">Produk Baru</h2>
                            </div><!-- 
                            <div class="col-lg-8 text-right col-sm-9 col-12">
                                <ul class="tab-menu nav">
                                </ul>
                            </div> -->
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
                        <h2 class="section-title">Produk populer saat ini</h2>
                        {!!Plugin::p_populer_saat_ini3()!!}
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Barang barang pilhan saat ini</h2>
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
                        <h2 class="section-title">Kata Konsumen</h2>
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
                                    <h2 class="section-title">Produk Diskon</h2>
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
    <!-- blog-area start -->
    <div class="shop-page-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <h2 class="section-title">Produk populer konsumen</h2>
            </div>
        </div>
    </div>

    <!-- <div class="box-b-l hide" id="a-b-l">
        <img src="{{asset('assets/images/profil/Peileppe_Orc_chibi.png')}}">
    </div>
    <div class="box-b-r hide" id="a-b-r">
        <img src="http://www.gambaranimasi.org/data/media/492/animasi-bergerak-kembang-api-0008.gif">
    </div> -->
    {{-- <div class="blog-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-wrap">
                        <h2 class="section-title">latest News</h2>
                        <div class="blog-active owl-carousel next-prev-style">
                            @foreach ($latestnews as $l)
                            <div class="blog-item">
                                <div class="blog-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $l->produk_slug)}}'">
                                    <img src="{{asset('assets/images/product/'.$l->produk_image)}}" style="width: 400px">
                                </div>
                                <div class="blog-content">
                                    <h3><a href="{{route('detail', $l->produk_slug)}}">{{$l->produk_name}}</a></h3>
                                    <ul class="blog-meta">
                                        <li><a href="#"><i class="fa fa-user"></i>{{$l->user->name}}</a></li>
                                        @if ($l->review)
                                        <li><a href="#"><i class="fa fa-comments"></i>{{$l->review->count()}} Comments</a></li>
                                        @else
                                        <li><a href="#"><i class="fa fa-comments"></i>0 Comments</a></li>
                                        @endif
                                        <li><a href="#"><i class="fa fa-clock-o"></i>{{$l->updated_at}}</a></li>
                                    </ul>
                                    <p>{{$l->produk_note}}</p>
                                    <a class="readmore" href="{{route('detail', $l->produk_slug)}}">read more</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- blog-area end -->
    
    <!-- brand-area start -->
    {{-- <div class="brand-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-active owl-carousel">
                        @foreach ($brandall as $b)
                        <div class="brand-items">
                            <a href="{{route('brand', ['brand' => $b->brand_slug])}}">
                                <img src="{{asset('assets/images/brand/'.$b->brand_image)}}" style="height: 
                            50px" alt="{{asset('assets/images/brand/'.$b->brand_image)}}">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- brand-area end -->
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
<!-- @section('script')
    <script type="text/javascript">
        function myTimer() {
            $("#a-b-l").toggle("slow");
            $("#a-b-r").toggle("slow");
        }
        var myVar = setInterval(myTimer, 2000);
        // call this line to stop the loop:
        // clearInterval(myVar);
    </script>
@endsection -->