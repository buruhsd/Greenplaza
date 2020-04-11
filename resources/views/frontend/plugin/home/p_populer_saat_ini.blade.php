<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_populer_saat_ini as $r)
        <div class="product-sidebar-items fix" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
            <div class="product-sidebar-img black-opacity">
                <a class="lazy" href="{{route('detail', $r->produk_slug)}}"><img class="lazy" src="{{asset('assets/images/load.gif')}}" style="width: 70px" data-src="{{asset('assets/images/product/thumb/'.$r->produk_image)}}"></a>
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
                    <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text_idr($r->produk_price, 0)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{number_format($r->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap" >
        @foreach ($p_populer_saat_ini2 as $r)
        <div class="product-sidebar-items fix" onclick="javascript:window.location.href='{{route('detail', $r->produk_slug)}}'">
            <div class="product-sidebar-img black-opacity">
                <a href="{{route('detail', $r->produk_slug)}}"><img class="lazy" src="{{asset('assets/images/load.gif')}}" style="width: 70px" data-src="{{asset('assets/images/product/thumb/'.$r->produk_image)}}"></a>
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
                    <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text_idr($r->produk_price, 0)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                </p>
                @else
                <p>
                    <span class="style-cost-item-front">Rp.{{number_format($r->produk_price, 0)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
