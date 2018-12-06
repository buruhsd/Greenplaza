@extends('layouts.index', ['active' => 'etalase'])
@section('title', 'Etalase')
@section('content')
<!-- breadcumb-area end -->
    <div class="about-area mb-30">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 ">
        <div class="author-wrap">
            <img src="{{ asset('frontend/images/author.png') }}" alt="">
            <h4>Alex Smeet</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit Maxime</p>
            <ul>
            <a href=""><li class="btn-chat"> Chat </li></a>
            </ul>
        </div>  
    </div>
    
        <hr>
    <div class="col-lg-12 ">
        <div class="author-wrap" style="position: relative;">
            <!-- <p style="position: absolute; color: blue; margin-top: 10%">jajajjajaa</p> -->
           <ul>
            <a href=""><li class="btn-chat"> Produk </li></a>
            <a href=""><li class="btn-chat"> Diskusi Produk </li></a>
            </ul>
        </div>
    </div>
    
    <div class="col-lg-12 col-md-8 col-12">
        <div class="shop-area">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Featured products</h2>
                </div>
            </div>
            
            <div class="product-active owl-carousel next-prev-style">
                @foreach ($produk as $p)
                <div class="product-wrap">
                    <div class="product-img black-opacity">
                        <span class="new">New</span>
                        <img class="first" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                        <img class="second" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                        <div class="shop-icon">
                            <ul>
                                <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{action('member\\FrontController@detail', $p->produk_category_id)}}"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="product-content">
                        <h3><a href="shop.html">{{$p->produk_name}}</a></h3>
                        <p><span><?php echo ($p->produk_price * $p->produk_discount);?></span>
                            <del>{{$p->produk_price}}</del>
                        </p>
                        <ul class="rating">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}