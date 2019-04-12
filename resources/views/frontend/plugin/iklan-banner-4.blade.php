<div class="featured-wrap">
    <div class="featured-img black-opacity">
        @if($iklan->iklan_link == null || $iklan->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$iklan->iklan_link}}">
        @endif
            <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image) }}" alt="" style="height: 260px">
        </a>
        <div class="featured-content">
            <!-- <h2>Minilam Chair</h2>
            <p>consectetur adipisicing elit to Tempora, similique!</p> -->
            <ul>
                <li><a href="{{url("/comming-soon")}}">Comming Soon</a></li>
            </ul>
        </div>
    </div>
</div>