<div class="banner-wrap">
    <div class="banner-img">
        @if($iklan->iklan_link == null || $iklan->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$iklan->iklan_link}}">
        @endif
        <!-- <span class="discount">50% Off</span> -->
	        <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image)}}" style="height: 100px">
	    </a>
    </div>
</div>