<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Transaction Detail</h4>
        </div>
        <div class="modal-body">
            {{-- <div class="row m-t-20">
                <div class="col-12">
                    <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-success btn-sm" name="addAdress" value="Add Address" />
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="table table-bordered m-t-xs">
                    <thead>
                        <th class="text-center">Code</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Produk Detail</th>
                        <th class="text-center">Seller Detail</th>
                        <th class="text-center">Shipment Detail</th>
                        <th class="text-center">Transaction Detail</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @foreach($trans_detail as $item)
                        <tr>
                            <td><b>{{$item->trans_code}}</b></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <img src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" style="max-height: 100px;">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <ul>
                                    <li>Name : {{$item->produk->produk_name}}</li>
                                    <!-- <li>Warna : {{$item->trans_detail_color}}</li> -->
                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
                                @if ($item->trans_detail_is_cancel == 0)
                                    <li>Status : <button class="btn btn-info btn-xs">{{FunctionLib::trans_arr($item->trans_detail_status)}}</button></li>
                                @else
                                    <li>Status : <button class="btn btn-info btn-xs">Cancel</button></li>
                                @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Username : {{$item->produk->user->username}}</li>
                                    <li>Name : {{$item->produk->user->name}}</li>
                                    <li>Email : {{$item->produk->user->email}}</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>From : 
                                        {{
                                            FunctionLib::address_info($item->produk->user->user_address->first()->id)
                                        }}, 
                                        {{
                                            $item->produk->user->user_address->first()->user_address_phone
                                        }}, 
                                        <b>{{
                                            $item->produk->user->user_address->first()->user_address_owner
                                        }}</b>
                                    </li>
                                    <li>To : 
                                        {{
                                            FunctionLib::address_info($item->user_address->id)
                                        }}, 
                                        {{
                                            $item->user_address->user_address_phone
                                        }}, 
                                        <b>{{
                                            $item->user_address->user_address_owner
                                        }}</b>
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
                            <td>
                                <ul>
                                
                                        @if($item->trans->trans_payment_id == 4 && $item->gln !== null )
                                        <li>Fee Gln : {{ $item->gln->trans_gln_amount_fee }} </li>
                                        <li>Jumlah Gln : {{ $item->gln->trans_gln_amount }} </li>
                                        <li>Total Gln : {{ $item->gln->trans_gln_amount_total }} </li>
                                        <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                        <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                        <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                        @if ($item->trans_detail_is_cancel == 1)
                                            <li><button class="btn btn-info btn-xs">Deskripsi </button>: {{$item->trans_detail_note}}</li>
                                        @else
                                        @endif
                                    @else
                                        <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                        <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                        <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                        @if ($item->trans_detail_is_cancel == 1)
                                            <li><button class="btn btn-info btn-xs">Deskripsi </button>: {{$item->trans_detail_note}}</li>
                                        @else
                                        @endif
                                    @endif
                                
                                </ul>
                            </td>
                            <td>
                                {!!Plugin::trans_purchase_btn(['id' => $item->trans->id, 'status' => 'detail', 'type' => $type])!!}
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td class="bg-info" colspan="5">
                                Total Bayar : <br>
                            </td>
                            <td class="bg-info text-right" colspan="2">
                                <u>
                                <b>
                                    Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total'))}}
                                </b></u>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>