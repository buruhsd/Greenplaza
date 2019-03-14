<!-- jquery latest version -->
    <script src="{{ asset('frontend/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- mouse_scroll.js -->
    <script src="{{ asset('frontend/js/mouse_scroll.js') }}"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('frontend/js/scrollup.js') }}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <!-- jquery.countdown.min.js -->
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('frontend/js/metisMenu.min.js') }}"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('frontend/js/mailchimp.js') }}"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
    <script src="{{ asset('js/js.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    @if (Session::has('flash_message'))
    <?php $status = (Session::get('flash_status') == 200)?'success':'error';?>
    <?php $status_type = (Session::get('flash_status') == 200)?'Success':'Failed';?>
    <script type="text/javascript">
        swal({   
            type: "{{ $status }}",
            title: "{{ $status_type }}",   
            text: "{{ Session::get('flash_message') }}",   
            showConfirmButton: false ,
            showCloseButton: true,
            footer: ''
        });
    </script>
    @endif

    <script type="text/javascript">
        // var slideIndex = 1;
        // showDivs(slideIndex);

        // function plusDivs(n) {
        //   showDivs(slideIndex += n);
        // }

        // function currentDiv(n) {
        //   showDivs(slideIndex = n);
        // }

        // function showDivs(n) {
        //   var i;
        //   var x = document.getElementsByClassName("mySlides");
        //   var dots = document.getElementsByClassName("demo");
        //   if (n > x.length) {slideIndex = 1}    
        //   if (n < 1) {slideIndex = x.length}
        //   for (i = 0; i < x.length; i++) {
        //      x[i].style.display = "none";  
        //   }
        //   for (i = 0; i < dots.length; i++) {
        //      dots[i].className = dots[i].className.replace(" w3-white", "");
        //   }
        //   x[slideIndex-1].style.display = "block";  
        //   dots[slideIndex-1].className += " w3-white";
        // }
    </script>
    <script src="{{ asset('js/pusher.js') }}"></script>
    <script src="{{ asset('js/echo.js') }}"></script>
    <script type="text/javascript">
        Pusher.logToConsole = true;
        window.Echo = new Echo({
            "authEndpoint": '{!!env("PUSHER_APP_AUTHPOINT")!!}',
            broadcaster: '{!!env("BROADCAST_DRIVER")!!}',
            key: '{!!env("PUSHER_APP_KEY")!!}',
            cluster: '{!!env("PUSHER_APP_CLUSTER")!!}',
            encrypted: true,
            logToConsole: true
        });
        // showNotifications({}, '#admin');
        console.log('{{Auth::user()->id}}');
        window.Echo.private('App.User.{{Auth::user()->id}}')
            .notification((notification) => {
                var url = '{!!url('member/notification/is_read')!!}/' + notification.id;
                showNotifications(notification.data, '#member', url);
        });
    </script>
