@if(isset($masedi))
@foreach( $masedi as $g )
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
                    <td> : Rp.{{$g->trans_detail_amount_total}}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td> : {{$g->trans_detail_note}}</td>
                </tr>
            </thead>
          </table>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif