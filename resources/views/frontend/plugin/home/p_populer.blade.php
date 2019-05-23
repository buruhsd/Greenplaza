<div class="propuler-product-active next-prev-style owl-carousel">
    <div class="slidebar-product-wrap">
        @foreach ($p_populer as $r)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity">
                <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
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
                    <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                    <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                </p>
                @else
                <p>
                    <span>Rp.{{number_format($r->produk_price, 2)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <div class="slidebar-product-wrap">
        @foreach ($p_populer as $r)
        <div class="product-sidebar-items fix">
            <div class="product-sidebar-img black-opacity">
                <a href="{{route('detail', $r->produk_slug)}}"><img src="{{asset('assets/images/product/'.$r->produk_image)}}" style="width: 70px"></a>
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
                    <del>Rp.{{FunctionLib::number_to_text($r->produk_price, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($r->produk_discount)}} %</span><br>
                    <span>Rp.{{FunctionLib::number_to_text($r->produk_price-($r->produk_price * $r->produk_discount / 100))}}</span>
                </p>
                @else
                <p>
                    <span>Rp.{{number_format($r->produk_price, 2)}}</span>
                </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
