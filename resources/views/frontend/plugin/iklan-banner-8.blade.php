<div class="banner-wrap">
    <div class="banner-img">
        @if($iklan->iklan_link == null || $iklan->iklan_link == '')
            <a href="{{route('etalase', 'green-production')}}">
        @else
            <a href="{{$iklan->iklan_link}}">
        @endif
	        <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image)}}" style="height: 210px">
	    </a>
    </div>
</div>
