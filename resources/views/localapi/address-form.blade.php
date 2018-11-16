<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Reminder</h4>
        </div>
        {!! Form::open(['url' => url('member/addwishlist/'.$id), 'method' => 'POST', 'id' => 'addwishlist']) !!}
        @csrf
        
        <div class="modal-body">
                <label>Note</label>
                <div class="form-group">
                    <input type="text" name="qty" value="1" placeholder="" />
                    <textarea class="form-control" id="note" name="note" placeholder="Note..."></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Save">
        </div>
        {!! Form::close() !!}
    </div>
</div>