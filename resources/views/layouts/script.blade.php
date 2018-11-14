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
