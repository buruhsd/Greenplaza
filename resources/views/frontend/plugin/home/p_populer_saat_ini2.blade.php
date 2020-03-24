<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_populer_saat_ini2 as $p)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $p->produk_slug)}}"><img src="{{asset('assets/images/product/thumb/'.$p->produk_image)}}" style="width: 70px"></a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a class="readmore" href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
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
                <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
            </p>
            @else
            <p>
                <span class="style-cost-item-front">Rp.{{number_format($p->produk_price, 0)}}</span>
            </p>
            @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap">
        @foreach ($p_populer_saat_ini22 as $p)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" style="margin-bottom: 1%">
                <a href="{{route('detail', $p->produk_slug)}}"><img src="{{asset('assets/images/product/thumb/'.$p->produk_image)}}" style="width: 70px"></a>
            </div>
            <div class="product-sedebar-content fix">
                <h4><a href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h4>
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
                <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span>
            </p>
            @else
            <p>
                <span class="style-cost-item-front">Rp.{{number_format($p->produk_price, 0)}}</span>
            </p>
            @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
