@extends('frontend.layout.indexall')
@section('content')
<!-- header-area end -->
    <!-- contact-area start -->
    <div class="contact-area mb-30 req-all">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="contact-form form-style bg-1 p-10">
                        <div class="cf-msg"></div>
                        <div id="googleMap"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="contact-wrap bg-1 p-10">
                        <ul>
                            <li>
                                <i class="fa fa-home"></i> Alamat:
                                <p>{{FunctionLib::get_config('profil_address')}}</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> Phone:
                                <p>
                                    <span>{{FunctionLib::get_config('profil_phone')}} </span>
                                    
                                </p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i> Alamat Email:
                                <p>
                                    <span>{{FunctionLib::get_config('profil_email')}}</span>
                                   
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1cZtqidvg0m-f8Hd3S6RHx1mY-omuLS4 "></script>
    <script>
    function initialize() {
        var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: new google.maps.LatLng(40.712764, -74.005667),
            styles: [{ "featureType": "all", "elementType": "labels.text.fill", "stylers": [{ "saturation": 36 }, { "color": "#000000" }, { "lightness": 40 }] }, { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [{ "visibility": "on" }, { "color": "#000000" }, { "lightness": 16 }] }, { "featureType": "all", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [{ "color": "#000000" }, { "lightness": 20 }] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{ "color": "#000000" }, { "lightness": 17 }, { "weight": 1.2 }] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 20 }] }, { "featureType": "poi", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 21 }] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{ "color": "#000000" }, { "lightness": 17 }] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{ "color": "#000000" }, { "lightness": 29 }, { "weight": 0.2 }] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 18 }] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 16 }] }, { "featureType": "transit", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 19 }] }, { "featureType": "water", "elementType": "geometry", "stylers": [{ "color": "#000000" }, { "lightness": 17 }] }]
        };

        var map = new google.maps.Map(document.getElementById('googleMap'),
            mapOptions);


        var marker = new google.maps.Marker({
            position: map.getCenter(),
            animation: google.maps.Animation.BOUNCE,
            map: map
        });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection