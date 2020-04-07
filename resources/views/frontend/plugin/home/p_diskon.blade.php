<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_diskon as $d)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                <a href="{{route('detail', $d->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$d->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                <h4><a class="readmore" href="{{route('detail', $d->produk_slug)}}">{{ str_limit($d->produk_name, 15)}}</a></h4>
                <ul class="rating">
                    @if($d->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $d->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($d->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
                    <del class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($d->produk_price, 0)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
        @foreach ($p_diskon2 as $d)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                <a class="readmore" href="{{route('detail', $d->produk_slug)}}">
                    <img src="{{asset('assets/images/product/thumb/'.$d->produk_image)}}" style="width: 70px" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" />
                </a>
            </div>
            <div class="product-sedebar-content fix" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
                <h4><a class="readmore" href="{{route('detail', $d->produk_slug)}}">{{ str_limit($d->produk_name, 15)}}</a></h4>
                <ul class="rating">
                    @if($d->avg_star())
                        @for($i=1;$i<=5;$i++)
                            <?php $star = ($i <= $d->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
                @if ($d->produk_discount != 0)
                <p>
                    <span class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
                    <del class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price, 0)}}</del>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
