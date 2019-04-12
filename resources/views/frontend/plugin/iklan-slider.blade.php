@foreach($iklan as $item)
    <div class="slider-item black-opacity">
        @if($item->iklan_link == null || $item->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$item->iklan_link}}">
        @endif
        <img src="{{asset('assets/images/iklan/'.$item->iklan_image)}}" style="height: 
            310px">
        <div class="slider-content text-right">
            <!-- <h2>Shop Our <span> DrakShop</span></h2>
            <h3><span>35% </span> Discount</h3>
            <ul>
                <li><a href="shop.html">Comming Soon</a></li>
            </ul> -->
        </div>
        </a>
    </div>
@endforeach
