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
	<script src="{{ asset('js/js.js') }}"></script>
    <script src="{{ asset('plugin/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
	<script src="{{asset('/plugin/ckeditor_standar/ckeditor.js')}}"></script>
	<script type="text/javascript">
        $('textarea.ckeditor').each(function () {
            var $textarea = $(this);
			CKEDITOR.replace($textarea.attr('name'));
            CKEDITOR.instances[$textarea.attr('name')].on('change', function(){
                $textarea[0].value = CKEDITOR.instances[$textarea.attr('name')].getData();
            });
            $textarea[0].value = CKEDITOR.instances[$textarea.attr('name')].getData();
        });
	</script>
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
