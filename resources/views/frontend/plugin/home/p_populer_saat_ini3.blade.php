<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_populer_saat_ini3 as $r)
        <div class="product-sidebar-items fix" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
                <a href="{{route('detail', $r->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$r->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                <ul class="rating">
                    @if($r->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $r->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($r->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                    <del class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price, 0)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap">
        @foreach ($p_populer_saat_ini32 as $r)
        <div class="product-sidebar-items fix" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
                <a href="{{route('detail', $r->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$r->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a href="{{route('detail', $r->produk_slug)}}">{{$r->produk_name}}</a></h4>
                <ul class="rating">
                    @if($r->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $r->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($r->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                    <del class="style-costt-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price, 0)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($r->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
