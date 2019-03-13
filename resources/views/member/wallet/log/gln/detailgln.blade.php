@if(isset($gln))
@foreach( $gln as $g )
<div class="modal fade" id="editModal{{$g->id}}" tabindex="-1" role="dialog" aria-labelledby="editFee">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editFee">Detail Transaction</h4>
      </div>
      <div class="modal-body">
          <table class="table">
            <thead>
                <tr>
                    <th>Shipment</th>
                    <td> : {{$g->shipment->shipment_name}}</td>
                </tr>
                <tr>
                    <th>Shipment Service</th>
                    <td> : {{$g->trans_detail_shipment_serice}}</td>
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
                    <th>Size</th>
                    <td> : {{$g->trans_detail_size}}</td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td> : {{$g->trans_detail_amount_total}}</td>
                </tr>
            </thead>
          </table>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif