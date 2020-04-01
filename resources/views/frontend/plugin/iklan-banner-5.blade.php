<div class="featured-wrap">
    <div class="featured-img black-opacity">
        @if($iklan->iklan_link == null || $iklan->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$iklan->iklan_link}}">
        @endif
            <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image) }}" alt="" style="height: 260px">
        </a>
        <div class="featured-content text-center">
            <!-- <h2>Dual Handle Cardio Ball</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore,<span> sunt animi quas architecto repellendus</span></p> -->
            <ul>
                <li><a href="{{url("/comming-soon")}}">{{__('front.coming_soon') }}</a></li>
            </ul>
        </div>
    </div>
</div>