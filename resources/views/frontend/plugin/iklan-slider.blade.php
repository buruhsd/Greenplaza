@foreach($iklan as $item)
    <div class="slider-item black-opacity">
        @if($item->iklan_link == null || $item->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$item->iklan_link}}">
        @endif
        <img class="lazy" src="{{asset('assets/images/load.gif')}}" data-src="{{asset('gi_image/iklan/'.$item->iklan_image)}}" style="height: 
            310px">
        {{-- <img src="{{asset('gi_image/iklan/poster1.png')}}" style="height: 
            310px">
            <div class="lazy-background one"></div>
        <img src="{{asset('gi_image/iklan/poster2.png')}}" style="height: 
            310px">
        <img src="{{asset('gi_image/iklan/poster3.png')}}" style="height: 
            310px">
        <div class="slider-content text-right"> --}}
            {{-- <h2>Shop Our <span> DrakShop</span></h2>
            <h3><span>35% </span> Discount</h3>
            <ul>
                <li><a href="shop.html">Comming Soon</a></li>
            </ul> --}}
        {{-- </div> --}}
        </a>
    </div>
@endforeach
