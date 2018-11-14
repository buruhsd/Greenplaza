<!-- ============================================================== -->
<!-- modal box -->
<!-- <div class="modal fade" id="modal-buy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"> -->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Reminder</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {!! Form::open(['url' => route('member.addwishlist', $id), 'method' => 'POST']) !!}
            <div class="modal-body">
                    <label>Note</label>
                    <div class="form-group">
                        <textarea class="form-control" id="note" name="note" placeholder="Keterangan..."></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="send-buy">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
<!-- </div> -->
<!-- end modal box -->