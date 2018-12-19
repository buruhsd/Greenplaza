<div class="slider-area">
        <div class="container">
            <h2 class="section-title">Kategori</h2>
            <div class="row">
            
                @foreach($category as $item)
                <div class="col-3" style="">
                    <img src="{{asset('img_category_icon/'.$item->category_image)}}" alt="" style="width: 50px; padding-left: -100px;"><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>