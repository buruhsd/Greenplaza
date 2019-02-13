<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Place Order</h4>
        </div>
		{{-- {!! Form::open(['url' => route('localapi.midtrans.process'), 'method' => 'POST', 'id' => 'form-midtrans']) !!} --}}
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="table-responsive">
                        <table class="table"> --}}
                    <div class="col-md-10">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="ptice">Shipment</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($trans_detail)
                                    @foreach($trans_detail as $key => $item)
                                        <?php $produk = App\Models\Produk::where('id', $item['trans_detail_produk_id'])->first(); ?>
                                        <tr>
                                            <td class="images"><img class="h100" src="{{asset('assets/images/product/'.$produk['produk_image'])}}" alt=""></td>
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
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row mt-60">
                            <div class="col-lg-6 col-md-6 col-md-offset-6">
                                <div class="cart-total text-right">
                                    <h3>Order Totals</h3>
                                    <hr/>
                                    <hr/>
                                    <ul>
                                        <li>
                                            <span class="pull-left">Subtotal </span>
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount'))}}
                                        </li>
                                        <li>
                                            <span class="pull-left"> Total </span> 
                                            Rp. {{FunctionLib::number_to_text(FunctionLib::array_sum_key($trans_detail->toArray(), 'trans_detail_amount_total'))}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close" id="close-button">
            <a href="{{route('member.transaction.done_gln', $item->trans->trans_code)}}" class="btn btn-success" id="pay-button">Bayar</a>
        </div>
    </div>
</div>
