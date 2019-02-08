<div class="col-lg-3 col-sm-6 col-12">
    <aside class="sidebar-area bg-1">
        <div class="widget widget_search">
            <h2 class="section-title">Cari Produk</h2>
            <form action="#" class="searchform">
                <input type="text" name="s" placeholder="Search Product...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="widget widget_categories">
            <h2 class="section-title">Categories</h2>
            <ul>
                @foreach($side_cat as $item)
                    <li><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="product-sidebar">
            <h2 class="section-title">Produk Terkait</h2>
            <div class="slidebar-product-wrap">
                @foreach($side_related as $item)
                    <div class="product-sidebar-items fix">
                        <div class="product-sidebar-img">
                            <a href="{{route('detail', $item->produk_slug)}}"><img class="h100 w100" style="border-radius: 50%;" src="{{ asset('assets/images/product/'.$item->produk_image) }}" alt="" /></a>
                        </div>
                        <div class="product-sedebar-content fix">
                            <h4><a href="{{route('detail', $item->produk_slug)}}">{{$item->produk_name}}</a></h4>
                            <!-- <ul class="rating">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul> -->
                            <p>
                                @if($item->produk_discount > 0)
                                    Rp. {{FunctionLib::number_to_text($item->produk_price - ($item->produk_price * $item->produk_discount / 100))}}&nbsp;/&nbsp;
                                    <del class="text-danger">Rp. {{FunctionLib::number_to_text($item->produk_price)}}</del>
                                @else
                                    Rp. {{FunctionLib::number_to_text($item->produk_price)}}
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>
</div>
