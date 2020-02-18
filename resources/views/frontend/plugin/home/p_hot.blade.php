<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_hot as $p)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$p->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{ str_limit($p->produk_name, 15)}}</a></h4>
                <ul class="rating">
                    @if($p->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $p->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($p->produk_discount != 0)
                <p>
                    <span>MYR.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                    <del>MYR.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                </p>
                @else
                <p>
                    <span>MYR.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap">
        @foreach ($p_hot2 as $p)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $p->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$p->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{ str_limit($p->produk_name, 15)}}</a></h4>
                <ul class="rating">
                    @if($p->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $p->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($p->produk_discount != 0)
                <p>
                    <span>MYR.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
                    <del>MYR.{{FunctionLib::number_to_text($p->produk_price, 2)}}</del>
                </p>
                @else
                <p>
                    <span>MYR.{{FunctionLib::number_to_text($p->produk_price, 2)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
