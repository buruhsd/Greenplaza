<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="editFee">Transaksi Detail</h4>
        </div>
        <div class="modal-body">
            <table class="table ">
                <thead>
                    @foreach($trans->trans_detail()->get() as $item)
                        <tr>
                            <th>Shipment</th>
                            <th>User Address Id</th>
                            <th>No Resi</th>
                            <th>Amount Total</th>
                        </tr>
                        <tr class="active">
                            <td>{{$item->shipment->shipment_name}}</td>
                            <td>{{$item->trans_detail_user_address_id}}</td>
                            @if ($item->trans_detail_no_resi != 0)
                                <td>{{$item->trans_detail_no_resi}}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>Rp. {{$item->trans_detail_amount_total}}</td>
                        </tr>
                    @endforeach
                </thead>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>Amount Total Gln</th>
                        @if ($trans->trans_gln())
                            <td> : {{$trans->trans_gln->first()->trans_gln_amount_total}} Gln</td>
                        @else
                            <td> : - </td>
                        @endif
                    </tr>
                    <tr>
                        <th>Fee</th>
                        @if ($trans->trans_gln())
                            <td> : {{$trans->trans_gln->first()->trans_gln_amount_fee}} Gln</td>
                        @else
                            <td> : - </td>
                        @endif   
                    </tr>
                    <tr>
                        <th>Harga 1 Gln</th>
                        @if ($trans->trans_gln())
                            <td> : {{$trans->trans_gln->first()->trans_gln_compare}}</td>
                        @else
                            <td> : - </td>
                        @endif 
                    </tr>
                    <tr>
                        <th>Saldo Member</th>
                        <td> : 
                            <?php
                                $response = FunctionLib::gln('ballance', ['address'=>$trans->trans_gln->first()->trans_gln_form]);
                                if($response['status'] == 200){
                                    echo FunctionLib::number_to_text($response['data']['balance'], 8);
                                }else{
                                    echo "0,00";
                                }
                            ?> Gln 
                        </td>
                    </tr>
                    <tr>
                        <th>Saldo Seller</th>
                        <td> : <?php
                            $response = FunctionLib::gln('ballance', ['address'=>$trans->trans_gln->first()->trans_gln_to]);
                            if($response['status'] == 200){
                                echo FunctionLib::number_to_text($response['data']['balance'], 8);
                            }else{
                                echo "0,00";
                            }
                            ?> Gln
                        </td>
                    </tr>
                    <tr>
                        <th>Wallet Member</th>
                        @if ($trans->trans_gln())
                            <td> : {{$trans->trans_gln->first()->trans_gln_form}}</td>
                        @else
                            <td> : - </td>
                        @endif
                        </tr>
                        <tr>
                            <th>Wallet Seller</th>
                        @if ($trans->trans_gln())
                            <td> : {{$trans->trans_gln->first()->trans_gln_to}}</td>
                        @else
                            <td> : - </td>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
    </div>
</div>
