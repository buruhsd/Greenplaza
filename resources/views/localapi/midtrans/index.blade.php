<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Place Order</h4>
        </div>
		{{-- {!! Form::open(['url' => route('localapi.midtrans.process'), 'method' => 'POST', 'id' => 'form-midtrans']) !!} --}}
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="cart-wrapper bg-1 p-10">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="ptice">Shipment</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::has('chart'))
                                    @foreach(Session::get('chart') as $key => $item)
                                        <?php $produk = App\Models\Produk::where('id', $item['trans_detail_produk_id'])->first(); ?>
                                        <tr>
                                            <td class="images"><img src="assets/images/product/{{$produk['produk_image']}}" alt=""></td>
                                            <td class="product"><a href="single-product.html">{{$produk['produk_name']}}</a></td>
                                            <td class="ptice">Rp. {{FunctionLib::number_to_text($item['trans_detail_amount'])}}</td>
                                            <td class="ptice">Rp. {{FunctionLib::number_to_text($item['trans_detail_amount_ship'])}}</td>
                                            <td class="quantity ">{{$item['trans_detail_qty']}}</td>
                                            {{-- <td class="quantity ">
                                                <div class="cart-plus-minus">
                                                    <input type="text" value="1" />
                                                </div>
                                            </td> --}}
                                            <td class="total">{{$item['trans_detail_amount_total']}}</td>
                                            <td class="remove">
                                                {!! Form::open([
                                                    'method'=>'GET',
                                                    'url' => url('/chart/destroy/'.$key),
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                    {!! Form::submit('x', array(
                                                            'class' => 'btn btn-danger btn-xs',
                                                            'title' => 'Delete blog',
                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                    )) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                </div>
                            </div>
                            <div class=" col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Order Totals</h3>
                                    <ul>
                                        <li>
                                            <span class="pull-left">Subtotal </span>
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount'))}}
                                        </li>
                                        <li>
                                            <span class="pull-left"> Total </span> 
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'))}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		{!! Form::open(['id' => 'form-midtrans']) !!}
        <div class="modal-footer">
			<input type="hidden" name="amount" value="{{FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')}}"/>
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="button" onclick='modal_post($(this), $("#form-midtrans").serialize());' data-toggle='modal' data-method='post' data-href={{route('localapi.midtrans.process')}} value="Save" class="btn btn-success" id="btn-pick-address" />
            {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        </div>
        {!! Form::close() !!}
    </div>
</div>
