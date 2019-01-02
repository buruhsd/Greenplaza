<div class="banner-area">
        <div class="container">
            <h2 class="section-title">Kategori</h2>
            <div class="row">
            
                @foreach($category as $item)
                <div class="col-3" style="">
                    <img src="{{asset('img_category_icon/'.$item->category_image)}}" alt="" style="width: 30px; "><a href="{{url('category?cat='.$item->category_slug)}}" style="width: 20px; "><br>{{ucfirst(strtolower($item->category_name))}}</br></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>