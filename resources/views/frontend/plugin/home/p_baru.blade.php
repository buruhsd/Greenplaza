<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="chair">
        <div class="product-active owl-carousel next-prev-style">
            @foreach ($p_baru as $n)
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
                            <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" >
                            {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" > --}}
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
                            @if($n->avg_star())
                                @for($i=1;$i<=5;$i++)
                                    <?php $star = ($i <= $n->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
                                    <li><i class="{{$star}}"></i></li>
                                @endfor
                            @else
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            @endif
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
            @foreach ($p_baru_diskon as $n)
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
                        <img class="first2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" >
                        {{-- <img class="second second2" src="{{asset('assets/images/product/'.$n->produk_image)}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" > --}}
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
                        @if($n->avg_star())
                            @for($i=1;$i<=5;$i++)
                                <?php $star = ($i <= $n->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
                                <li><i class="{{$star}}"></i></li>
                            @endfor
                        @else
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        @endif
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