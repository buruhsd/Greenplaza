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
                <table class="table m-t-20 respon">
                    <thead>
                        <th class="text-center">Code</th>
                        <th class="text-center">Produk Detail</th>
                        <th class="text-center">Seller Detail</th>
                        <th class="text-center">Shipment Detail</th>
                        <th class="text-center">Transaction Detail</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    @foreach($trans->trans_detail as $item)
                        <tbody>
                            <td><b>{{$item->trans_code}}</b></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <img src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" style="max-height: 100px;">
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                        <ul>
                                            <li>Name : {{$item->produk->produk_name}}</li>
                                            <li>Amount : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
                                        </ul>
                                    </div>
                                </div>
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
                                            $item->user_address->user_address_province
                                            .'-'
                                            .$item->user_address->user_address_city
                                            .'-'
                                            .$item->user_address->user_address_subdist
                                        }}
                                    </li>
                                    <li>To :                                         {{
                                            $item->user_address->user_address_province
                                            .'-'
                                            .$item->user_address->user_address_city
                                            .'-'
                                            .$item->user_address->user_address_subdist
                                        }}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Amount : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount)}}</li>
                                    <li>Amount Ship : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_ship)}}</li>
                                    <li>Amount Total : Rp. {{FunctionLib::number_to_text($item->trans_detail_amount_total)}}</li>
                                </ul>
                            </td>
                            <td>{{$item->trans_code}}</td>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>