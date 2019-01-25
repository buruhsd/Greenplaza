@if($status == 'trans')
	@if($detail->trans_detail_is_cancel == 1)
		@if($detail->has('komplain'))
		    @if($type == 'buyer')
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<a href="{{route('member.komplain.buyer')}}">
				    		<button class="btn btn-info btn-xs">Resolusi Komplain</button>
			    		</a>
			    	</div>
			    </div>
			@else
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<a href="{{route('member.komplain.index')}}">
				    		<button class="btn btn-info btn-xs">Resolusi Komplain</button>
			    		</a>
			    	</div>
			    </div>
			@endif
		@else
    		<div class="row">
		    	<div class="col-md-12 text-center">
		    		<a href="{{route('member.transaction.konfirmasi', $detail->trans->id)}}">
			    		<button class="btn btn-success btn-xs">Racun</button>
		    		</a>
		    	</div>
		    </div>
		@endif
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
			                {!! Form::open(['id' => 'form-pick-approve', 'class' => 'col-md-6']) !!}
			                    <input type="button" onclick='modal_post($(this), $("#form-pick-approve").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.pick_produk_ship", $detail->trans->id)}} value="Sending" class="btn btn-success btn-xs btn-block" />
			                {!! Form::close() !!}
			                {!! Form::open(['id' => 'form-pick-cancel', 'class' => 'col-md-6']) !!}
			                	<input type="hidden" name="status" value="cancel"/>
			                    <input type="button" onclick='modal_post($(this), $("#form-pick-cancel").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.pick_produk_ship", $detail->trans->id)}} value="Cancel" class="btn btn-danger btn-xs btn-block" />
			                {!! Form::close() !!}
				    		{{-- <a href="{{route('member.transaction.sending', $detail->trans->id)}}">
			    				<button class="btn btn-success btn-xs">Sending</button>
				    		</a> --}}
				    	</div>
				    </div>
		    	@endif
		    @break
			{{-- Shipment --}}
		    @case(5)
		    	@if($type == 'buyer')
		    		<div class="col-md-12 text-center"><i>{{$status_shipment}}</i></div>
			    	<div class="row">
			    		<div class="col-md-12 text-center">
							<button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.transaction.dropping", $detail->trans->id)}} class='btn btn-success btn-xs'>
	                                Barang diterima
	                        </button>
				    	</div>
				    </div>
			    	<div class="row">
			    		<div class="col-md-12 text-center">
							<button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.add_komplain", $detail->trans->id)}} class='btn btn-info btn-xs'>
	                                Komplain
	                        </button>
				    	</div>
				    </div>
		    	@elseif($type == 'seller')
		    		@if($detail->trans->trans_detail()->where('trans_detail_no_resi', 0)->exists())
				    	<div class="row">
				    		<div class="col-md-12 text-center">
								<button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.transaction.add_resi", $detail->trans->id)}} class='btn btn-info btn-xs'>
		                                Shipment
		                        </button>
					    	</div>
					    </div>
					@endif
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
@else
	@if($detail->trans_detail_is_cancel == 1)
		@if($detail->has('komplain'))
		    @if($type == 'buyer')
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<a href="{{route('member.komplain.buyer')}}">
				    		<button class="btn btn-info btn-xs">Resolusi Komplain</button>
			    		</a>
			    	</div>
			    </div>
			@else
	    		<div class="row">
			    	<div class="col-md-12 text-center">
			    		<a href="{{route('member.komplain.index')}}">
				    		<button class="btn btn-info btn-xs">Resolusi Komplain</button>
			    		</a>
			    	</div>
			    </div>
			@endif
		@else
		@endif
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
		    		<div class="col-md-12 text-center"><i>{{$status_shipment}}</i></div>
			    	<div class="row">
			    		<div class="col-md-12 text-center">
							<button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.transaction.dropping", $detail->trans->id)}} class='btn btn-success btn-xs'>
	                                Barang diterima
	                        </button>
				    	</div>
				    </div>
			    	<div class="row">
			    		<div class="col-md-12 text-center">
			    			<button class="btn btn-danger btn-xs">Komplain</button>
				    	</div>
				    </div>
		    	@elseif($type == 'seller')
		    		@if($detail->trans_detail_send == 0)
				    	<div class="row">
				    		<div class="col-md-12 text-center">
								<button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.transaction.add_resi", $detail->trans->id)}} class='btn btn-info btn-xs'>
		                                Shipment
		                        </button>
					    	</div>
					    </div>
			    	@endif
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
@endif