@extends('frontend.layout.indexall', ['active' => 'home'])
@section('title', 'category')
@section('content')

    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 style="padding: 10px">Green Production</h4>
                </div>
            </div>
        </div>
    </div>

<!-- .shop-page-area start -->
    <div class="shop-page-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <hr/>
                        <ul class="tab-menu nav jabar">
                            <div class="col-12">
                                <h4 style="padding: 10px">Giplaza Production</h4>
                            </div> 
                        </ul>                                                   
                        <hr/>  
                        <div class="row mb-30">
                            <div class="col-lg-3 col-sm-4 col-12">
                            {!! Form::open([
                                'method' => 'GET',
                                'id' => 'form-category',
                                'files' => true
                            ]) !!}
                                <input type="hidden" name="cat" value="{{(isset($_GET['cat'])?$_GET['cat']:'')}}">
                                <input type="hidden" name="src" value="{{(isset($_GET['src'])?$_GET['src']:'')}}">
                                <select name="order" class="select-style" id="order">
                                    <option disabled selected>Order by</option>
                                    <option value="produk_name-ASC">Nama</option>
                                    <option value="created_at-DESC">Terbaru</option>
                                    <option value="populer-DESC">Populer</option>
                                    <option value="ulasan-DESC">Ulasan Terbanyak</option>
                                    <option value="produk_price-DESC">Harga Tertinggi</option>
                                    <option value="produk_price-ASC">Harga Terendah</option>
                                </select>
                            {!! Form::close() !!}
                            </div>
                            <div class=" col-lg-5 col-sm-5 col-12">
                            </div>
                            <div class="col-lg-4 col-12 col-sm-3">
                                <p class="total-product">
                                    {{($produk->currentPage() - 1) * $produk->perPage() + 1}}-
                                    {{$produk->perPage() * $produk->currentPage()}} 
                                    dari {{$produk->count()}} Data
                                </p>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="row">
                                @if($produk->count() == 0)
                                    <div class="col-lg-12 text-center col-md-12 col-sm-12 col-12">
                                        <div class="product-wrap">
                                            <div class="product-content no-border">
                                                <h3>No Result Found.</h3>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                @foreach($produk as $item)
                                    <div class="col-lg-2 col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                                                @if ($item->produk_stock == 0)
                                                    <div class="featured-content text-center">
                                                        <ul>
                                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                        </ul>
                                                    </div>
                                                    @elseif($item->produk_discount == 0)
                                                        <span ></span>
                                                
                                                @else($item->produk_discount == 1)
                                                   <span class="new">sale</span>
                                                @endif
                                                <img class="" src="{{ asset('assets/images/product/'.$item->produk_image) }}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" >
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
                                            <div class="product-content">
                                                <h3><a href="{{route('detail', $item->produk_slug)}}">{{str_limit($item->produk_name, 10)}}</a>
                                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart pull-right"></i></a>
                                                    <a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                                </h3>
                                                @if($item->produk_discount > 0)
                                                    <p>
                                                        <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($item->produk_price, 0)}}</del><span> </span>
                                                        <span class="pull-right" style="color:red">{{number_format($item->produk_discount)}} %</span><br>
                                                        <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($item->produk_price-($item->produk_price * $item->produk_discount / 100))}}</span><br>
                                                        {{-- <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($item->price_myr - ( $item->price_myr * $item->produk_discount/ 100) ) }} </span><br>
                                                        <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text( ($item->produk_price - ( $item->produk_price * $item->produk_discount/ 100) )/$price_gln ) }} </span> --}}
                                                    </p>
                                                @else
                                                    <p>
                                                        <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($item->produk_price, 0)}}</span><br>
                                                        {{-- <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($item->price_MYR, 0)}}</span><br>
                                                        <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text($item->gln_coin ) }} <br> </span> --}}
                                                    </p>
                                                @endif
                                                {{-- <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul> --}}
                                               <!--  @if($item->user->seller_active())
                                                <center><a class="readmore" href="{{route('etalase', $item->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">Toko {{$item->user->user_store}}</button></a></center>
                                                @endif -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                                    <div class="col-12">
                                    {!! $produk->appends(['cat' => Request::get('cat'), 'src' => Request::get('src'), 'order' => Request::get('order')])->render() !!}
                                        <!-- <div class="pagination-wrapper text-center">
                                            <ul class="page-numbers">
                                                <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                <li><a class="page-numbers" href="#">1</a></li>
                                                <li><span class="page-numbers current">2</span></li>
                                                <li><a class="page-numbers" href="#">3</a></li>
                                                <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane" id="list">
                                <div class="product-list">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/1.jpg" alt="">
                                                    <img class="second" src="assets/images/product/2.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/3.jpg" alt="">
                                                    <img class="second" src="assets/images/product/4.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/5.jpg" alt="">
                                                    <img class="second" src="assets/images/product/6.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/7.jpg" alt="">
                                                    <img class="second" src="assets/images/product/8.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/9.jpg" alt="">
                                                    <img class="second" src="assets/images/product/10.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/11.jpg" alt="">
                                                    <img class="second" src="assets/images/product/12.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="pagination-wrapper text-center">
                                                <ul class="page-numbers">
                                                    <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                    <li><a class="page-numbers" href="#">1</a></li>
                                                    <li><span class="page-numbers current">2</span></li>
                                                    <li><a class="page-numbers" href="#">3</a></li>
                                                    <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .shop-page-area enc -->
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#order').change(function(){
            $('#form-category').submit();
        })
    </script>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}