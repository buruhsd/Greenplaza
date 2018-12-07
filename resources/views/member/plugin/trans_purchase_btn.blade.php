@if($status == 'trans')
	@switch($detail->trans_detail_status)
		{{-- order --}}
	    @case(0)
	    @break
		{{-- order --}}
	    @case(1)
	    	@if($type == 'buyer')
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<button class="btn btn-success btn-xs">Konfirmasi</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Transfer --}}
	    @case(2)
	    	@if($type == 'buyer')
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Seller --}}
	    @case(3)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Packing</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Packing --}}
	    @case(4)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Packing</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Shipment --}}
	    @case(5)
	    	@if($type == 'buyer')
	    		<div class="col-md-12">{{$status_shipment}}</div>
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Barang diterima</button>
			    	</div>
			    </div>
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-danger btn-xs">Komplain</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Dropping --}}
	    @case(6)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-info btn-xs">Sampai</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
	    @default
	        Default case...
	@endswitch
@else
	@switch($detail->trans_detail_status)
		{{-- order --}}
	    @case(0)
	    @break
		{{-- order --}}
	    @case(1)
	    	@if($type == 'buyer')
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<button class="btn btn-success btn-xs">Konfirmasi</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<button class="btn btn-success btn-xs">Konfirmasi</button>
			    	</div>
			    </div>
	    	@endif
	    @break
		{{-- Transfer --}}
	    @case(2)
	    	@if($type == 'buyer')
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Seller --}}
	    @case(3)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Packing</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Packing --}}
	    @case(4)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Packing</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Shipment --}}
	    @case(5)
	    	@if($type == 'buyer')
	    		<div class="col-md-12">{{$status_shipment}}</div>
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-success btn-xs">Barang diterima</button>
			    	</div>
			    </div>
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-danger btn-xs">Komplain</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
		{{-- Dropping --}}
	    @case(6)
	    	@if($type == 'buyer')
		    	<div class="row">
		    		<div class="col-md-12 text-center">
		    			<button class="btn btn-info btn-xs">Sampai</button>
			    	</div>
			    </div>
	    	@elseif($type == 'seller')
	    	@endif
	    @break
	    @default
	        Default case...
	@endswitch
@endif