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
        document.addEventListener("DOMContentLoaded", function() {
          var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

          if ("IntersectionObserver" in window && "IntersectionObserverEntry" in window && "intersectionRatio" in window.IntersectionObserverEntry.prototype) {
            let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
              entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                  entry.target.classList.add("visible");
                  lazyBackgroundObserver.unobserve(entry.target);
                }
              });
            });

            lazyBackgrounds.forEach(function(lazyBackground) {
              lazyBackgroundObserver.observe(lazyBackground);
            });
          }
        });
        
        $("#initialIdSelectorMouseMove1" ).hover(
            function() {
             $(".pop-sending span").popover({
                 placement : 'right',
                 html : true,
             });
             $(".pop-target span").popover('show');
             }, 
            function() {
             $(".pop-target span").popover('hide');
            }
        );

        function showPopover(id){
            $(".popo").popover('hide');
            $("#pop"+id).popover('show');
            setTimeout(function(){ 
                $(".popo").popover('hide');
            }, 3000);
        }
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
    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5cbe8a7ad6e05b735b43c9e3/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script> --}}
    <!--End of Tawk.to Script-->
    {{-- pre loader --}}
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    {{-- end pre loader --}}
    @guest
    @else
        <script src="{{ asset('js/pusher.js') }}"></script>
        <script src="{{ asset('js/echo.js') }}"></script>
        <script type="text/javascript">
            console.log('{!!env("PUSHER_APP_AUTHPOINT")!!}');
            // var pusher = new Pusher('{!!env("PUSHER_APP_KEY")!!}', {
            //     cluster: '{!!env("PUSHER_APP_CLUSTER")!!}',
            //     forceTLS: true
            // });

            // var channel = pusher.subscribe('App.User.{{Auth::id()}}');
            // channel.bind('pusher:subscription_error', function(data) {
            //     console.log(data);
            //     var url = '{!!url('member/notification/is_read')!!}/' + data.id;
            //     showNotifications(data.data, '#member', url);
            // });
            // Pusher.logToConsole = true;
            // window.Echo = new Echo({

            //     "authEndpoint": '{!!env("PUSHER_APP_AUTHPOINT")!!}',
            //     host: '{!!env("APP_URL")!!}',
            //     broadcaster: '{!!env("BROADCAST_DRIVER")!!}',
            //     key: '{!!env("PUSHER_APP_KEY")!!}',
            //     cluster: '{!!env("PUSHER_APP_CLUSTER")!!}',
            //     forceTLS: true,
            //     // encrypted: true,
            //     logToConsole: true
            // });
            // console.log(window.Echo);
            // // showNotifications({}, '#admin');
            // window.Echo.private('App.User.{{Auth::id()}}')
            //     .notification((notification) => {
            //         var url = '{!!url('member/notification/is_read')!!}/' + notification.id;
            //         showNotifications(notification.data, '#member', url);
            // });
        </script>
    @endguest
    {!! (isset($footer_script))? $footer_script:'' !!}
