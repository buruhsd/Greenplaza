<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_top_rate as $t)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $t->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $t->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$t->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a class="readmore" href="{{route('detail', $t->produk_slug)}}">{{$t->produk_name}}</a></h4>
                <ul class="rating">
                    @if($t->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $t->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($t->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price-($t->produk_price * $t->produk_discount / 100))}}</span>
                    <del class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price, 0)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap">
        @foreach ($p_top_rate2 as $t)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $t->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $t->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$t->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a class="readmore" href="{{route('detail', $t->produk_slug)}}">{{$t->produk_name}}</a></h4>
                <ul class="rating">
                    @if($t->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $t->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($t->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price-($t->produk_price * $t->produk_discount / 100))}}</span>
                    <del class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($t->produk_price, 2)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
