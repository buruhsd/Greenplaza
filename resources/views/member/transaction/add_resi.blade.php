@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Konfirmasi Pengiriman</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-body">
                    <div class="large-6 medium-6 small-12 columns">
                        <label>Buyer : <b>{{$trans_detail->first()->trans->pembeli->name}}</b></label><br/>
                        <label>Date : <b>{{FunctionLib::datetime_indo($trans_detail->first()->trans->created_at, true, 'full')}}</b></label>
                    </div>
                    <div class="large-6 medium-6 small-12 columns">
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
			                        <th class="text-center"></th>
			                        <th class="text-center">Shipment Detail</th>
			                        <th class="text-center">Transaction Detail</th>
			                        <th class="text-center">No. Resi dan Tanggal Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($trans_detail as $item)
			                        <tr>
			                            <td>
			                                <div class="row">
			                                    <div class="col-lg-4 col-md-6 col-sm-12">
			                                        <img src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" style="max-height: 100px;">
			                                    </div>
			                                </div>
			                            </td>
			                            <td>
			                                <ul>
			                                    <li>From : 
			                                        {{
			                                            FunctionLib::address_info($item->produk->user->user_address->first()->id)
			                                        }}, 
			                                        {{
			                                            $item->produk->user->user_address->first()->user_address_phone
			                                        }}
			                                    </li>
			                                    <li>To : 
			                                        {{
			                                            FunctionLib::address_info($item->user_address->id)
			                                        }}, 
			                                        {{
			                                            $item->user_address->user_address_phone
			                                        }}
			                                    </li>
			                                    {{-- @if($item->trans_detail_status == 5) --}}
			                                    <?php $ship_status = FunctionLib::get_waybill($item->id);?>
			                                    <li>Sent Status : 
			                                        {{
			                                            $ship_status
			                                        }}
			                                    </li>
			                                    <li>Jasa Pengiriman : {{$item->shipment->shipment_name}}</li>
			                                    <li><b>&nbsp;&nbsp;-> {{$item->trans_detail_shipment_service}}</b></li>
			                                    {{-- @endif --}}
			                                </ul>
			                            </td>
			                            <td width="25%">
			                                <ul>
			                                    <li>Code : <b>{{$item->trans_code}}</b></li>
			                                    <li>Produk Price : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
			                                    <li>Qty : {{$item->trans_detail_qty}}</li>
			                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
			                                    <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
			                                    <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
			                                </ul>
			                            </td>
			                            <td width="40%">
									        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_name') ? 'has-error' : ''}}">
									            <div class="col-md-12">
								                	{!! Form::open(['url' => '/member/transaction/add_resi/'.$item->id, 'class' => 'input-group', 'files' => true, 'method' => 'POST']) !!}
									                    {!! Form::text('trans_detail_no_resi', $item->trans_detail_no_resi, [
									                        'class' => 'form-control', 
									                        'placeholder' => 'No.Resi', 
									                        'required'
									                    ])!!}
									                    <span class="input-group-btn" style="width:0px;"></span>
										                {!! Form::text('trans_detail_send_date', $item->trans_detail_send_date, [
										                    'class' => 'form-control datepicker', 
										                    'placeholder' => 'Date', 
										                    'required'
										                ])!!}
								                        <span class="input-group-btn">
								                            <button type="submit" class="btn btn-success image-preview-clear">
								                                Save
								                            </button>
								                        </span>
								                    {!! Form::close() !!}
									            </div>
									        </div>
			                            </td>
			                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    	<hr/>
                    </div>
                </div>
            </div>
	        </div>
	        </div>
	    </div><!-- Row -->
	</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
        