{{-- <div class="banner-area">
        <div class="container">
            <h2 class="section-title">Kategori</h2>
            <div class="banner-area-new">
                <div class="row " style="background-color: white;">
                
                    @foreach($category as $item)
                    <div class="col-3" style=" ">
                        <img src="{{asset('img_category_icon/'.$item->category_image)}}" alt="" style="width: 30px; "><a href="{{url('category?cat='.$item->category_slug)}}" style="width: 20px;">{{ucfirst(strtolower($item->category_name))}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}


    <div class="banner-area" style="margin-bottom: 50px;margin-top: 20px;">
        <div class="container">
            <h2 class="section-title">Kategori</h2>
            <div class="banner-area-new">
                <div class="row ">
                
                    @foreach($category as $item)
                    <div style="border:solid 1px #ccc; border-radius: 5px 10px; width: 23%;margin: 0.1% 1%; line-height: 3; background-color: #ffffff">
                        <img src="{{asset('img_category_icon/'.$item->category_image)}}" alt="" style="width: 30px;"><a href="{{url('category?cat='.$item->category_slug)}}" style="width: 20px;">{{ucfirst(strtolower($item->category_name))}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>