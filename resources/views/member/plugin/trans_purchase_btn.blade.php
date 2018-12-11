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
			    		<a href="{{route('member.transaction.konfirmasi', $detail->trans->id)}}">
				    		<button class="btn btn-success btn-xs">Konfirmasi</button>
			    		</a>
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
		    	<div class="row">
		    		<div class="col-md-12 text-center">
			    		<a href="{{route('member.transaction.able', $detail->trans->id)}}">
		    				<button class="btn btn-success btn-xs">Move to Packing</button>
			    		</a>
			    	</div>
			    </div>
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
	    		@if($detail->trans_detail_send_date == null || $detail->trans_detail_send_date == "")
			    	<div class="row">
			    		<div class="col-md-12 text-center">
				    		<a href="{{route('member.transaction.packing', $detail->trans->id)}}">
			    				<button class="btn btn-info btn-xs">Wait Shipping</button>
				    		</a>
				    	</div>
				    </div>
	    		@endif
		    	<div class="row">
		    		<div class="col-md-12 text-center">
			    		<a href="{{route('member.transaction.sending', $detail->trans->id)}}">
		    				<button class="btn btn-success btn-xs">Sending</button>
			    		</a>
			    	</div>
			    </div>
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