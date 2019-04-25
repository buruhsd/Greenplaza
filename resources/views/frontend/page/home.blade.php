@extends('frontend.layout.index', ['active' => 'home'])
@section('title', 'Home')
@section('content')

    <div class="slider-area" style="padding-top: 150px;margin-bottom: 180px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 col-10">
                    <div class="cetagory-wrap">
                        <span>Semua kategori</span>
                        <ul class="cetagory-items">
                            <?php $cat = App\Models\Category::whereRaw('category_parent_id = 0')->limit(12)->orderBy('position', 'ASC')->orderBy('updated_at', 'DESC')->get();?>
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
                <div class="col-lg-6 offset-lg-0 col-md-8 offset-md-4">
                    <div class="slider-active owl-carousel next-prev-btn">
                        {!!Plugin::view('iklan', [
                                'id'=>1,
                                'type'=>'2',
                                'name'=>'slider',
                            ])
                        !!}
                    </div>
                    <div class="info-wrap">
                        <div class="row">
                            <div class="col-sm-6 col-xs-15">
                                {!!Plugin::view('iklan', [
                                        'id'=>2,
                                        'type'=>'1',
                                        'name'=>'banner1',
                                    ])
                                !!}
                            </div>
                            <div class="col-sm-6">
                                {!!Plugin::view('iklan', [
                                        'id'=>3,
                                        'type'=>'1',
                                        'name'=>'banner2',
                                    ])
                                !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    @if (\Auth::check())
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
                    @endif
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
                <div class="col-lg-3 col-md-4 d-none d-lg-block">
                    {!!Plugin::view('iklan', [
                            'id'=>5,
                            'type'=>'1',
                            'name'=>'banner4',
                        ])
                    !!}
                </div>
                <div class="col-lg-6 col-md-8">
                    {!!Plugin::view('iklan', [
                            'id'=>6,
                            'type'=>'1',
                            'name'=>'banner5',
                        ])
                    !!}
                </div>
                <div class="col-lg-3 col-md-4">
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
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                @foreach ($relatedproduk as $r)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        @if ($r->produk_discount != 0)
                                        <p>
                                            <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                                        </p>
                                        @else
                                        <p>
                                            <span>Rp.{{number_format($r->produk_price, 2)}}</span>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slidebar-product-wrap">
                                @foreach ($relatedprodukk as $r)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        @if ($r->produk_discount != 0)
                                        <p>
                                            <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                                        </p>
                                        @else
                                        <p>
                                            <span>Rp.{{number_format($r->produk_price, 2)}}</span>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="product-sidebar" style="width: 100%">
                        <h2 class="section-title">Harga Diskon</h2>
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            @foreach ($discountprice as $d)
                            <div class="product-wrap">
                                <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                                    <span class="discount">{{number_format($d->produk_discount)}}% Off</span>
                                        <a href="{{route('detail', $d->produk_slug)}}"><img src="{{asset('assets/images/product/'.$d->produk_image)}}" ></a>
                                    <!-- <div class="discount-wrap">
                                        <div data-countdown="2017/10/03"></div>
                                    </div> -->
                                    <!-- <div class="shop-icon">
                                        <ul>
                                            <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $d->id)}}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('detail', $d->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('detail', $d->produk_slug)}}">{{$d->produk_name}}</a>
                                        <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $d->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                        <a href="{{route('detail', $d->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                    </h3>
                                    @if ($d->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($d->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($d->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{number_format($d->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                @foreach ($popularproduk as $p)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                        <a class="readmore" href="{{route('detail', $p->produk_slug)}}"><img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    @if ($p->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{number_format($p->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slidebar-product-wrap">
                                @foreach ($popularprodukk as $p)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                                        <a href="{{route('detail', $p->produk_slug)}}"><img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                    @if ($p->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{number_format($p->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Green Production</h2>
                            </div>
                        </div>
                        <div class="product-active owl-carousel next-prev-style">
                            @foreach($product_asdf as $n)
                            <div class="product-wrap">
                                <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                                    @if ($n->produk_stock == 0)
                                    <div class="featured-content text-center">
                                        <ul>
                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                        </ul>
                                    </div>
                                    @elseif($n->produk_discount == 0)
                                    <span ></span>
                                    @else($n->produk_discount == 1)
                                    <span class="new">sale</span>
                                    @endif
                                    <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt="" >
                                    {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt=""> --}}
                                    <div class="shop-icon">
                                        <!-- <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('detail_asdf', $n->produk_slug)}}">{{ str_limit($n->produk_name, 15)}}</a>
                                        <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                        <a href="{{route('detail_asdf', $n->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                    </h3>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    @if ($n->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($n->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price-($n->produk_price * $n->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    <div class="tombol-product">
                                    @if($n->user->seller_active())
                                        <center><a class="readmore" href="{{route('etalase', $n->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$n->user->user_store}}</button></a></center>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="new sale">Sale</span>
                                    <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                    <p><span>{{$n->produk_price}}</span>
                                        <del>{{$n->product_discount}} %</del>
                                    </p>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div> -->
                            @endforeach
                        </div>
                    </div>
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Produk baru saat ini</h2>
                            </div>
                        </div>
                        <div class="product-active owl-carousel next-prev-style">
                            @foreach($newproduk as $n)
                            <div class="product-wrap">
                                <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                                   @if ($n->produk_stock == 0)
                                    <div class="featured-content text-center">
                                        <ul>
                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                        </ul></div>
                                    @elseif($n->produk_discount == 0)
                                        <span ></span>            
                                    @else($n->produk_discount == 1)
                                        <span class="new">sale</span>
                                    @endif
                                    <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt="" >
                                    {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt=""> --}}
                                    <div class="shop-icon">
                                        <!-- <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('detail', $n->produk_slug)}}">{{ str_limit($n->produk_name, 15)}}</a>
                                        <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                        <a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                    </h3>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    @if ($n->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($n->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price-($n->produk_price * $n->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    <div class="tombol-product">
                                    @if($n->user->seller_active())
                                        <center><a class="readmore" href="{{route('etalase', $n->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$n->user->user_store}}</button></a></center>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="product-wrap">
                                <div class="product-img black-opacity">
                                    <span class="new sale">Sale</span>
                                    <img src="{{asset('assets/images/product/'.$n->produk_image)}}">
                                    <div class="shop-icon">
                                        <ul>
                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="shop.html">{{$n->produk_name}}</a></h3>
                                    <p><span>{{$n->produk_price}}</span>
                                        <del>{{$n->product_discount}} %</del>
                                    </p>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div> -->
                            @endforeach
                        </div>
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
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="chair">
                                <div class="product-active owl-carousel next-prev-style">
                                    @foreach ($category as $n)
                                    @if ($n->produk_discount == 0)
                                    <div class="product-items">
                                        <div class="product-wrap mb-15">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                                                @if ($n->produk_stock == 0)
                                                    <div class="featured-content text-center">
                                                        <ul>
                                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                        </ul>
                                                    </div>
                                                    @elseif($n->produk_discount == 0)
                                                    <span ></span>
                                                
                                                @else($n->produk_discount == 1)
                                                   <span class="new">sale</span>
                                                @endif
                                                    <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt="">
                                                    {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt=""> --}}
                                                <!-- <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="product-content tambahan">
                                                <h3><a href="{{route('detail', $n->produk_slug)}}">{{ str_limit($n->produk_name, 15)}}</a>
                                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                                    <a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                                </h3>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                </ul>
                                                   @if ($n->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price-($n->produk_price * $n->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($n->produk_discount)}} %</span>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                @if($n->user->seller_active())
                                                <center><a class="readmore" href="{{route('etalase', $n->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$n->user->user_store}}</button></a></center>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="chair">
                                <div class="product-active owl-carousel next-prev-style">
                                    @foreach ($category as $n)
                                    @if ($n->produk_discount > 0)
                                    <div class="product-wrap">
                                        <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                                            @if ($n->produk_stock == 0)
                                            <div class="featured-content text-center">
                                                <ul>
                                                    <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                </ul>
                                            </div>
                                            @elseif($n->produk_discount == 0)
                                            <span ></span>
                                                        
                                            @else($n->produk_discount == 1)
                                               <span class="new">sale</span>
                                            @endif
                                                <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt="">
                                                {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt=""> --}}
                                            <!-- <div class="shop-icon">
                                                <ul>
                                                    <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{route('detail', $n->produk_slug)}}">{{ str_limit($n->produk_name, 15)}}</a>
                                                <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $n->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                                <a href="{{route('detail', $n->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                            </h3>
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
                                            @if ($n->produk_discount != 0)
                                                <p>
                                                    <del>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($n->produk_discount)}} %</span><br>
                                                    <span>Rp.{{FunctionLib::number_to_text($n->produk_price-($n->produk_price * $n->produk_discount / 100))}}</span>
                                                </p>
                                                @else
                                                <p>
                                                    <span>Rp.{{FunctionLib::number_to_text($n->produk_price, 2)}}</span>
                                                </p>
                                                @endif
                                            
                                            @if($n->user->seller_active())
                                            <center><a class="readmore" href="{{route('etalase', $n->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$n->user->user_store}}</button></a></center>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
                        <div class="propuler-product-active next-prev-style owl-carousel">
                            <div class="slidebar-product-wrap">
                                @foreach ($relatedproduk as $r)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
                                        <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        @if ($r->produk_discount != 0)
                                        <p>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                                            <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del>
                                        </p>
                                        @else
                                        <p>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</span>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="slidebar-product-wrap">
                                @foreach ($relatedprodukk as $r)
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
                                        <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        @if ($r->produk_discount != 0)
                                        <p>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                                            <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del>
                                        </p>
                                        @else
                                        <p>
                                            <span>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</span>
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="section-title">Barang barang pilhan saat ini</h2>
                            </div>
                        </div>
                        <div class="product-active owl-carousel next-prev-style">
                            @foreach ($featured as $f)
                            <div class="product-wrap">
                                <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $f->produk_slug)}}'">
                                     @if ($f->produk_stock == 0)
                                    <div class="featured-content text-center">
                                        <ul>
                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                        </ul>
                                    </div>
                                    @elseif($f->produk_discount == 0)
                                    <span ></span>
                                                
                                    @else($f->produk_discount == 1)
                                       <span class="new">sale</span>
                                    @endif
                                    <img class="first2" src="{{asset('assets/images/product/'.$f->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt="">
                                    {{-- <img class="second second2" src="{{asset('assets/images/product/'.$f->produk_image)}}" onerror="{{asset('assets/images/product/nopic.png')}}" alt=""> --}}
                                    <!-- <div class="shop-icon">
                                        <ul>
                                            <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $f->id)}}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="{{route('detail', $f->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('detail', $f->produk_slug)}}">{{ str_limit($f->produk_name, 15)}}</a>
                                        <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $f->id)}}"><i class="fa fa-heart pull-right"></i></a>
                                        <a href="{{route('detail', $f->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                    </h3>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    @if ($f->produk_discount != 0)
                                    <p>
                                        <del>Rp.{{FunctionLib::number_to_text($f->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($f->produk_discount)}} %</span><br>
                                        <span>Rp.{{FunctionLib::number_to_text($f->produk_price-($f->produk_price * $f->produk_discount / 100))}}</span>
                                    </p>
                                    @else
                                    <p>
                                        <span>Rp.{{FunctionLib::number_to_text($f->produk_price, 2)}}</span>
                                    </p>
                                    @endif
                                    <div class="tombol-product">
                                    @if($f->user->seller_active())
                                    <center><a class="readmore" href="{{route('etalase', $f->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$f->user->user_store}}</button></a></center>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                                    <img src="{{asset('assets/images/profil/'.$r->userdetail->user_detail_image)}}">
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
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularproduk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($p->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularprodukk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($p->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12 sm-mb-30">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Top Rate</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($toprate as $t)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $t->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $t->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$t->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $t->produk_slug)}}">{{$t->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($t->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($t->produk_price-($t->produk_price * $t->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($topratee as $t)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $t->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $t->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$t->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $t->produk_slug)}}">{{$t->produk_name}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($t->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($t->produk_price-($t->produk_price * $t->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Hot Produk</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularproduk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{ str_limit($p->produk_name, 15)}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($p->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($popularprodukk as $p)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$p->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{ str_limit($p->produk_name, 15)}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($p->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="product-sidebar">
                                    <h2 class="section-title">Produk Diskon</h2>
                                    <div class="propuler-product-active next-prev-style owl-carousel">
                                        <div class="slidebar-product-wrap">
                                            @foreach ($discountproduk as $d)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                                                    <a href="{{route('detail', $d->produk_slug)}}">
                                                        <img src="{{asset('assets/images/product/'.$d->produk_image)}}" style="width: 70px">
                                                    </a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $d->produk_slug)}}">{{ str_limit($d->produk_name, 15)}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($d->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($d->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($d->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="slidebar-product-wrap">
                                            @foreach ($discountprodukk as $d)
                                            <div class="product-sidebar-items fix">
                                                <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                                                    <a class="readmore" href="{{route('detail', $d->produk_slug)}}"><img src="{{asset('assets/images/product/'.$d->produk_image)}}" style="width: 70px"></a>
                                                </div>
                                                <div class="product-sedebar-content fix">
                                                    <h4><a class="readmore" href="{{route('detail', $d->produk_slug)}}">{{ str_limit($d->produk_name, 15)}}</a></h4>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    @if ($d->produk_discount != 0)
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
                                                        <del>Rp.{{FunctionLib::number_to_text($d->produk_price, 2)}}</del>
                                                    </p>
                                                    @else
                                                    <p>
                                                        <span>Rp.{{FunctionLib::number_to_text($d->produk_price, 2)}}</span>
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
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
                        <div class="propuler-product-active next-prev-style owl-carousel">
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="row">
                                @foreach($latestnews as $item)
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                                                 @if ($item->produk_stock == 0)
                                                    <div class="featured-content text-center">
                                                        <ul>
                                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                        </ul>
                                                    </div>
                                                    @elseif($item->produk_discount > 0)
                                                       <span class="new">sale</span>
                                                    @endif
                                                <img class="" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="">
                                                <!-- <div class="shop-icon">
                                                    <ul>
                                                        {{-- <li><a href="{{route('detail', $item->produk_category_id)}}"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                                        <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="product-content2">
                                                <h4>
                                                    <a href="{{route('detail', $item->produk_slug)}}">{{ str_limit($item->produk_name, 15)}}</a>
                                                    <a href="{{route('detail', $item->id)}}"></a>
                                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart pull-right"></i></a>
                                                    <a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                                </h4>
                                                <ul style="color: #999; font-size: 11px">
                                                    <i class="fa fa-user"></i> {{$item->user->name}}
                                                </ul>
                                                <ul style="color: #999; font-size: 11px">
                                                    @if ($item->review)
                                                    <i class="fa fa-comments"></i> {{$item->review->count()}} Comments
                                                    @else
                                                    <i class="fa fa-comments"></i> 0 Comments
                                                    @endif
                                                </ul>
                                                <ul style="color: #999; font-size: 11px">
                                                    {{str_limit($item->produk_note, 25)}}
                                                </ul>
                                                <div style="width: 72%; bottom: 0; padding-bottom: 40px; position: absolute;">
                                                <center><a class="readmore" href="{{route('detail', $item->produk_slug)}}"><button class="btn btn-success btn-sm col-12">selengkapnya</button></a></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="row">
                                @foreach($latestnewss as $item)
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                                                 @if ($item->produk_stock == 0)
                                                <div class="featured-content text-center">
                                                    <ul>
                                                        <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                    </ul>
                                                </div>
                                                @elseif($item->produk_discount > 0)
                                                   <span class="new sale">Sale</span>
                                                @endif
                                                <img class="" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="" >
                                                {{-- <img class="first" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="">
                                                <img class="second" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt=""> --}}
                                                <!-- <div class="shop-icon">
                                                    <ul>
                                                        {{-- <li><a href="{{route('detail', $item->produk_category_id)}}"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                                        <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="product-content2">
                                                <h3>
                                                    <a href="{{route('detail', $item->produk_slug)}}">{{ str_limit($item->produk_name, 10)}}</a>
                                                    <a href="{{route('detail', $item->id)}}"></a>
                                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart pull-right"></i></a>
                                                    <a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                                </h3>
                                                <ul style="color: #999; font-size: 11px">
                                                    <i class="fa fa-user"></i> {{$item->user->name}}
                                                </ul>
                                                <ul style="color: #999; font-size: 11px">
                                                    
                                                    <i class="fa fa-comments"></i> {{ $item->count_discuss($item)}} Comments
                                                   
                                                </ul>
                                                <ul style="color: #999; font-size: 11px">
                                                    {{str_limit($item->produk_note, 25)}}
                                                </ul>
                                                <div style="width: 72%; bottom: 0; padding-bottom: 40px; position: absolute;">
                                                    <center><a class="readmore" href="{{route('detail', $item->produk_slug)}}"><button class="btn btn-success btn-sm col-12">selengkapnya</button></a></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="blog-area mb-30">
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
    </div> -->
    <!-- blog-area end -->
    
    <!-- brand-area start -->
    <!-- <div class="brand-area mb-30">
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
    </div> -->
    <!-- brand-area end -->
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection