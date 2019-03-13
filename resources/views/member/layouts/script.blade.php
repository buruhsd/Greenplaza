	<!-- Javascripts -->
	<script src="{{ asset('admin/plugins/jquery/jquery-3.1.0.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/uniform/js/jquery.uniform.standalone.js') }}"></script>
	<script src="{{ asset('admin/plugins/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/d3/d3.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/nvd3/nv.d3.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.time.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/chartjs/chart.min.js') }}"></script>
	<script src="{{ asset('admin/js/space.min.js') }}"></script>
	<script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
	<script src="{{ asset('js/pusher.js') }}"></script>
	<script src="{{ asset('js/echo.js') }}"></script>
	<script src="{{ asset('js/js.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
	<script src="{{asset('/plugin/ckeditor_standar/ckeditor.js')}}"></script>
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
    @if(Auth::user()->is_gln())
    <script type="text/javascript">
	    function get_gln(address) {
	        $.ajax({
	            type: 'get', // or post?
	            url: '{{url('localapi/content/ballance_gln')}}/'+address, // change as needed
	            success: function(data) {
	                $('#saldo_gln').html(parseFloat(data).toFixed(8).toString().replace(".", ","));
	                // $('#produk_hotlist').val(data);
	            }
	        });
		}
        function run_gln(address){
        	var fungsi = function(){get_gln(address);};
			var interval = setInterval(fungsi, 60*100);
        }
        run_gln('{{Auth::user()->wallet()->where('wallet_type', 7)->first()->wallet_address}}');
    </script>
    @endif
    <script type="text/javascript">
    	$(function () {
		  $('[data-toggle="popover"]').popover()
		})
	    Pusher.logToConsole = true;
	    window.Echo = new Echo({
	    	"authEndpoint": "/greenplaza/public/broadcasting/auth",
	        broadcaster: '{!!env("BROADCAST_DRIVER")!!}',
	        key: '{!!env("PUSHER_APP_KEY")!!}',
	        cluster: '{!!env("PUSHER_APP_CLUSTER")!!}',
	        encrypted: true,
	        logToConsole: true
	    });
		showNotifications({}, '#admin');
	    window.Echo.private('App.User.{{Auth::user()->id}}')
	        .notification((notification) => {
			    showNotifications(notification.data, '#admin');
	    });
    </script>
