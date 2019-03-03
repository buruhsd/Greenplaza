@if(isset($gln))
@foreach( $gln as $g )
<div class="modal fade" id="editModal{{$g->id}}" tabindex="-1" role="dialog" aria-labelledby="editFee">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editFee">Transaksi Detail</h4>
      </div>
      <div class="modal-body">
          <table class="table">
            <thead>
                <tr>
                    <th>Shipment</th>
                    <td> : {{$g->shipment->shipment_name}}</td>
                </tr>
                <tr>
                    <th>User Address Id</th>
                    <td> : {{$g->trans_detail_user_address_id}}</td>
                </tr>
                <tr>
                    <th>No Resi</th>
                    @if ($g->trans_detail_no_resi != 0)
                    <td> : {{$g->trans_detail_no_resi}}</td>
                    @else
                    <td> : - </td>
                    @endif
                </tr>
                <tr>
                    <th>Amount Total</th>
                    <td> : {{$g->trans_detail_amount_total}}</td>
                </tr>
                <tr>
                    <th>Amount Total Gln</th>
                    @if (App\Models\Trans_gln::where('trans_gln_detail_id', $g->id)->count() > 0)
                    <td> : {{$g->gln->trans_gln_amount_total}}</td>
                    @else
                    <td> : - </td>
                    @endif
                </tr>
                <tr>
                    <th>Note</th>
                    <td> : {{$g->trans_detail_note}}</td>
                </tr>
                <tr>
                    <th>Wallet Member</th>
                    @if (App\Models\Trans_gln::where('trans_gln_detail_id', $g->id)->count() > 0)
                    <td> : {{$g->gln->trans_gln_form}}</td>
                    @else
                    <td> : - </td>
                    @endif
                </tr>
                <tr>
                    <th>Wallet Seller</th>
                    @if (App\Models\Trans_gln::where('trans_gln_detail_id', $g->id)->count() > 0)
                    <td> : {{$g->gln->trans_gln_to}}</td>
                    @else
                    <td> : - </td>
                    @endif
                </tr>
            </thead>
          </table>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif