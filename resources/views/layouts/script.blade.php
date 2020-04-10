<!-- Popup Subscribe Form -->
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
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
          showDivs(slideIndex += n);
        }

        function currentDiv(n) {
          showDivs(slideIndex = n);
        }

        function showDivs(n) {
          var i;
          var x = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          if (n > x.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = x.length}
          for (i = 0; i < x.length; i++) {
             x[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
             dots[i].className = dots[i].className.replace(" w3-white", "");
          }
          x[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " w3-white";
        }

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

        // document.addEventListener("DOMContentLoaded", function() {
        //   var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

        //   if ("IntersectionObserver" in window) {
        //     let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
        //       entries.forEach(function(entry) {
        //         if (entry.isIntersecting) {
        //           let lazyImage = entry.target;
        //           lazyImage.src = lazyImage.dataset.src;
        //           lazyImage.srcset = lazyImage.dataset.srcset;
        //           lazyImage.classList.remove("lazy");
        //           lazyImageObserver.unobserve(lazyImage);
        //         }
        //       });
        //     });

        //     lazyImages.forEach(function(lazyImage) {
        //       lazyImageObserver.observe(lazyImage);
        //     });
        //   } else {
        //     // Possibly fall back to a more compatible method here
        //   }
        // });
        document.addEventListener("DOMContentLoaded", function() {
        let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
        let active = false;

        const lazyLoad = function() {
          if (active === false) {
            active = true;

            setTimeout(function() {
              lazyImages.forEach(function(lazyImage) {
                if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                  lazyImage.src = lazyImage.dataset.src;
                  lazyImage.srcset = lazyImage.dataset.srcset;
                  lazyImage.classList.remove("lazy");

                  lazyImages = lazyImages.filter(function(image) {
                    return image !== lazyImage;
                  });

                  if (lazyImages.length === 0) {
                    document.removeEventListener("scroll", lazyLoad);
                    window.removeEventListener("resize", lazyLoad);
                    window.removeEventListener("orientationchange", lazyLoad);
                  }
                }
              });

              active = false;
            }, 200);
          }
        };

        document.addEventListener("scroll", lazyLoad);
        window.addEventListener("resize", lazyLoad);
        window.addEventListener("orientationchange", lazyLoad);
      });
    </script>
