<div class="propuler-product-active next-prev-style owl-carousel">
    @foreach ($p_harga_diskon as $d)
    <div class="product-wrap">
        <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
            <span class="discount">{{number_format($d->produk_discount)}}% Off</span>
                <a href="{{route('detail', $d->produk_slug)}}"><img src="{{asset('assets/images/product/thumb/'.$d->produk_image)}}" ></a>
        </div>
        <div class="product-content" onclick="javascript:window.location.href='{{route('detail', $d->produk_slug)}}'">
            <h3><a href="{{route('detail', $d->produk_slug)}}">{{$d->produk_name}}</a>
                <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $d->id)}}"><i class="fa fa-heart pull-right"></i></a>
                <a href="{{route('detail', $d->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
            </h3>
            @if ($d->produk_discount != 0)
            <p>
                <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($d->produk_price, 0)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($d->produk_discount)}} %</span><br>
                <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($d->produk_price-($d->produk_price * $d->produk_discount / 100))}}</span>
            </p>
            @else
            <p>
                <span class="style-cost-item-front">Rp.{{number_format($d->produk_price, 0)}}</span>
            </p>
            @endif
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
        </div>
    </div>
    @endforeach
</div>
