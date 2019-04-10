<div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="editFee">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editFee">Pesan</h4>
      </div>
      <div class="modal-body">
      <form action="{{ URL('/note_seller') }}" method="POST">
      {{csrf_field() }}
        <textarea class="form-control" name="note_seller" style="min-width: 100%"></textarea>
      </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-default">Kirim</button>
        
        </form>
    </div>
    </div>
  </div>
</div>