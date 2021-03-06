<div class="product-active owl-carousel next-prev-style">
    @foreach ($p_pilihan_saat_ini as $f)
    <div class="product-wrap">
        <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $f->produk_slug)}}'">
             @if ($f->produk_stock == 0)
            <div class="featured-content text-center">
                <ul>
                    <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                </ul>
            </div>
            @elseif($f->produk_discount == 0)
            <span ></span>
                        
            @else($f->produk_discount == 1)
               <span class="new">sale</span>
            @endif
            <img class="lazy first2" src="{{asset('assets/images/load.gif')}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" data-src="{{asset('assets/images/product/thumb/'.$f->produk_image)}}">
            {{-- <img class="second second2" src="{{asset('assets/images/product/thumb/'.$f->produk_image)}}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" > --}}
            <!-- <div class="shop-icon">
                <ul>
                    <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $f->id)}}"><i class="fa fa-heart"></i></a></li>
                    <li><a href="{{route('detail', $f->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                </ul>
            </div> -->
        </div>
        <div class="product-content" onclick="javascript:window.location.href='{{route('detail', $f->produk_slug)}}'">
            <h3><a href="{{route('detail', $f->produk_slug)}}">{{ str_limit($f->produk_name, 15)}}</a>
                <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href="{{route('localapi.modal.addwishlist', $f->id)}}"><i class="fa fa-heart pull-right"></i></a>
                <a href="{{route('detail', $f->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
            </h3>
            <ul class="rating">
                @if($f->avg_star())
                    @for($i=1;$i<=5;$i++)
                        <?php $star = ($i <= $f->avg_star())?'fa fa-star':'fa fa-star-o'; ?>
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
            @if ($f->produk_discount != 0)
                    <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($f->produk_price, 0)}}</del><span> </span>
                    <span class="pull-right" style="color:red">{{number_format($f->produk_discount)}} %</span><br>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($f->produk_price-($f->produk_price * $f->produk_discount / 100))}}</span><br>
                    {{-- <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($f->price_myr - ( $f->price_myr * $f->produk_discount/ 100) ) }} </span><br>
                    <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text( ($f->produk_price - ( $f->produk_price * $f->produk_discount/ 100) )/$price_gln ) }} </span> --}}
                </p>
            @else
                <p>
                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text_idr($f->produk_price, 0)}}</span><br>
                    {{-- <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($f->price_myr, 0)}}</span><br>
                    <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text($f->gln_coin, 2)}}</span><br> --}}
                </p>
            @endif

            <div class="tombol-product">
            @if($f->user->seller_active())
            <center><a class="readmore" href="{{route('etalase', $f->user->user_slug)}}"><button class="btn btn-success btn-sm col-12">{{$f->user->user_store}}</button></a></center>
            @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
