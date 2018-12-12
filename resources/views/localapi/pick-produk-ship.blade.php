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
        {!! Form::open(['id' => 'form-pick-produk']) !!}
            <div class="table-responsive">
                <table class="table table-bordered m-t-xs">
                    <thead>
                        <th class="text-center">Actions</th>
                        <th class="text-center">Code</th>
                        <th class="text-center"></th>
                        <th class="text-center">Produk Detail</th>
                        <th class="text-center">Seller Detail</th>
                        <th class="text-center">Shipment Detail</th>
                        <th class="text-center">Transaction Detail</th>
                    </thead>
                    <tbody>
                    @foreach($trans_detail as $item)
                        <tr>
                            <td>
                                <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_size') ? 'has-error' : ''}}">
                                    <div class="col-md-12">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="checkbox" name="detail_id[]" value="{{$item->id}}" autocomplete="off">
                                                <span class="check glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    {!! $errors->first('produk_size', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </td>
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
                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
                                    <li>Status : <button class="btn btn-info btn-xs">{{$item->trans_detail_status}}</button></li>
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
                                        }}
                                    </li>
                                    <li>To : 
                                        {{
                                            FunctionLib::address_info($item->user_address->id)
                                        }}
                                    </li>
                                    {{-- @if($item->trans_detail_status == 5) --}}
                                    <?php $ship_status = FunctionLib::get_waybill($item->id);?>
                                    <li>Sent Status : 
                                        {{
                                            $ship_status
                                        }}
                                    </li>
                                    {{-- @endif --}}
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                    <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                    <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td class="bg-info" colspan="5">
                                Total Bayar : 
                            </td>
                            <td class="bg-info text-right" colspan="2">
                                <u><b>
                                    Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total'))}}
                                </b></u>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if($trans_status == 'cancel')
                <div class="form-group mx-sm-3 mb-2 {{ $errors->has('note') ? 'has-error' : ''}}">
                    {!! Form::label('note', 'Alasan tidak sanggup : ', ['class' => 'col-md-12 control-label']) !!}
                    <div class="col-md-12 m-b-xs">
                        {!! Form::textarea('note', null, [
                          'class' => 'form-control', 
                          'placeholder' => 'Note', 
                          'required',
                          'rows' => 3
                        ])!!}
                        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            @endif
            <div class="col-md-2">
                <input type="button" onclick='modal_post($(this), $("#form-pick-produk").serialize());' data-toggle='modal' data-method='post' data-href={{route("member.transaction.sending")}} value="Save" class="btn btn-success btn-xs btn-block" />
            </div>
        {!! Form::close() !!}
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>