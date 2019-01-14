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
                                    <th class="product">Paket</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($trans_hotlist)
                                    <tr>
                                        <td class="product"><a href="single-product.html">{{$trans_hotlist->paket->paket_hotlist_name}}</a></td>
                                        <td class="quantity ">{{$trans_hotlist['trans_hotlist_jml']}}</td>
                                        {{-- <td class="quantity ">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" />
                                            </div>
                                        </td> --}}
                                        <td class="total">{{$trans_hotlist['trans_hotlist_amount']}}</td>
                                    </tr>
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
                                            <span class="pull-left"> Total </span> 
                                            Rp. {{FunctionLib::number_to_text($trans_hotlist['trans_hotlist_amount'])}}
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
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Pay" id="pay-button">
            {{-- <input type="button" onclick='modal_post($(this), $("#form-midtrans").serialize());' data-toggle='modal' data-method='post' data-href={{route('localapi.midtrans.re_process', $trans_detail->first()->trans->trans_code)}} value="Save" class="btn btn-success" id="btn-pick-address" /> --}}
            {{-- <input type="submit" class="btn btn-success" value="Save"> --}}
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key=""></script>
<script type="text/javascript">
    // <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
            // Optional
            onSuccess: function(result){
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            },
            // Optional
            onPending: function(result){
                console.log(result);
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ 
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                // parse to form_data
                var form_data = new FormData();
                for ( var key in result ) {
                    form_data.append(key, result[key]);
                }
                console.log(form_data);
            }
        });
    };
</script>
