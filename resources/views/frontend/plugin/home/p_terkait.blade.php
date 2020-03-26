<div class="shop-page-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shop-area non-margin">
                    <div class="row">
                        <div class="col-lg-4 col-sm-3 col-12">
                            <h2 class="section-title">Related product</h2>
                        </div>
                        {{-- <div class="col-lg-8 text-right col-sm-9 col-12">
                            <ul class="tab-menu nav">
                                <li><a class="active" data-toggle="tab" href="#chair">Chair</a></li>
                                <li><a data-toggle="tab" href="#table">Table</a></li>
                                <li><a data-toggle="tab" href="#laptop">Laptop</a></li>
                                <li><a data-toggle="tab" href="#dextop">Dextop</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    
                            <div class="row">
                    @foreach($side_related as $n)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                        <div class="product-wrap" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $n->produk_slug)}}'">
                                @if($n->produk_discount > 0)      
                                <span class="new sale">Sale</span>
                                @endif
                                <img class="" src="{{ asset('assets/images/product/'.$n->produk_image) }}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" >
                                {{-- <img class="first" src="{{ asset('assets/images/product/'.$n->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt="">
                                <img class="second" src="{{ asset('assets/images/product/'.$n->produk_image) }}" onerror="{{asset('assets/images/product/nopic.png')}}"alt=""> --}}
                                <!-- <div class="shop-icon">
                                    <ul>
                                        {{-- <li><a href="{{route('detail', $n->produk_category_id)}}"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                        <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $n->id)}}><i class="fa fa-heart"></i></a></li>
                                        <li><a href="{{route("detail", $n->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="product-content tambahan">
                                <h3><a href="{{route('detail', $n->produk_slug)}}">{{str_limit($n->produk_name, 10)}}</a>
                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $n->id)}}><i class="fa fa-heart pull-right"></i></a>
                                    <a href="{{route("detail", $n->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                </h3>
                                @if($n->produk_discount > 0)
                                    <p>
                                        <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($n->produk_price, 0)}}</del><span> </span>
                                        <span class="pull-right" style="color:red">{{number_format($n->produk_discount)}} %</span><br>
                                        <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($n->produk_price-($n->produk_price * $n->produk_discount / 100))}}</span><br>
                                        <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($n->price_myr - ( $n->price_myr * $n->produk_discount/ 100) ) }} </span><br>
                                        <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text( ($n->produk_price - ( $n->produk_price * $n->produk_discount/ 100) )/$price_gln ) }} </span>
                                    </p>
                                @else
                                    <p>
                                        <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($n->produk_price, 0)}}</span><br>
                                        <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($n->price_MYR, 0)}}</span><br>
                                        <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text($n->gln_coin ) }} <br> </span>
                                    </p>
                                @endif
                                {{-- <ul class="rating">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul> --}}
                                <div class="tombol-product add-btn">
                                @if($n->user->seller_active())
                                    <center><a class="readmore" href="{{route('etalase', $n->user->user_slug)}}"><button class="btn btn-success btn-sm col-12" style="font-size: 12px">{{ str_limit($n->user->user_store, 15) }}</button></a></center>
                                @endif
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