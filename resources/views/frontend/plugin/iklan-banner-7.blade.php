<div class="banner-img black-opacity">
    @if($iklan->iklan_link == null || $iklan->iklan_link == '')
        <a href="{{route('etalase', 'green-production')}}">
    @else
        <a href="{{$iklan->iklan_link}}">
    @endif
	    <img src="{{asset('assets/images/iklan/'.$iklan->iklan_image)}}" style="height: 410px">
	</a>
    <div class="banner-content">
        <div class="banner-info">
            <!-- <h2>Sale <span>50%</span> off</h2> -->
            <h3><a href="{{url("/comming-soon")}}">{{__('front.coming_soon') }}</a></h3>
        </div>
    </div>
</div>
