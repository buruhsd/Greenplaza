@if(isset($with))
@foreach( $with as $w )
<div class="modal fade" id="editModal{{$w->id}}" tabindex="-1" role="dialog" aria-labelledby="editFee">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editFee">Transaksi Detail</h4>
      </div>
      <div class="modal-body">
          <table class="table">
            <thead>
                <tr>
                    <th>Member</th>
                    <td> : {{$w->user->username}}</td>
                </tr>
                <tr>
                    <th>Transaksi</th>
                    <td> : {{$w->type->wallet_type_name}}</td>
                </tr>
                <tr>
                    <th>No Resi</th>
                    @if($w->withdrawal_ref != 0)
                    <td> : {{$w->withdrawal_ref}}</td>
                    @else
                    <td> : - </td>
                    @endif
                </tr>
                <tr>
                    <th>Status</th>
                    <td> : @if($w->withdrawal_status == 0)
                          Belum Approve
                          @elseif($w->withdrawal_status == 1)
                          Approve
                          
                          @endif
                    </td>
                </tr>
                <tr>
                    <th>Waktu Approve</th>
                    <td> : {{$w->updated_at}}
                          
                    </td>
                </tr>
                <tr>
                    <!-- <th>Note</th>
                    <td> : {{$w->trans_detail_note}}</td> -->
                </tr>
            </thead>
          </table>
      </div>
    </div>
  </div>
</div>
@endforeach
@endif