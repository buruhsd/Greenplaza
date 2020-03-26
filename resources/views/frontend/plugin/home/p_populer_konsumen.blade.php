<div class="propuler-product-active2 owl-carousel next-prev-style">
    @foreach($p_populer_konsumen as $item)
        <div class="product-wrap">
            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                 @if ($item->produk_stock == 0)
                    <div class="featured-content text-center">
                        <ul>
                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                        </ul>
                    </div>
                    @elseif($item->produk_discount > 0)
                       <span class="new">sale</span>
                    @endif
                <img class="" src="{{ asset('assets/images/product/thumb/'.$item->produk_image) }}" onerror="this.src='{!!asset("assets/images/product/nopic.png")!!}'" alt="" >
            </div>
            <div class="product-content2" onclick="javascript:window.location.href='{{route('detail', $item->produk_slug)}}'">
                <h4>
                    <a href="{{route('detail', $item->produk_slug)}}">{{ str_limit($item->produk_name, 15)}}</a>
                    <a href="{{route('detail', $item->id)}}"></a>
                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $item->id)}}><i class="fa fa-heart pull-right"></i></a>
                    <a href="{{route("detail", $item->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                </h4>
                <ul style="color: #999; font-size: 11px">
                    <i class="fa fa-user"></i> {{$item->user->name}}
                </ul>
                <ul style="color: #999; font-size: 11px">
                    @if ($item->review)
                    <i class="fa fa-comments"></i> {{$item->review->count()}} Comments
                    @else
                    <i class="fa fa-comments"></i> 0 Comments
                    @endif
                </ul>
                <ul style="color: #999; font-size: 11px">
                    {{str_limit($item->produk_note, 25)}}
                </ul>
                <div style="width: 72%; bottom: 0; padding-bottom: 40px; position: absolute;">
                <center><a class="readmore" href="{{route('detail', $item->produk_slug)}}"><button class="btn btn-success btn-sm col-12">selengkapnya</button></a></center>
                </div>
            </div>
        </div>
    @endforeach
</div>
