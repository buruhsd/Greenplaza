<div class="slider-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wishlist-wrap ">
                        <table class="table-responsive cart-wrap">
                            <tbody>
                                <tr>
                            
                                    @foreach($category as $item)
                                    <td class="images">
                                    <img src="{{asset('img_category_icon/'.$item->category_image)}}" alt=""><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a></td>
                            @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>