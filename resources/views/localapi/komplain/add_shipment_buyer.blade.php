<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Tambah no resi</h4>
        </div>
        {!! Form::open(['url' => route('member.solusi.add_shipment_buyer', $item->solusi->id), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-6 col-md-6">
                                <div class="form-group {{ $errors->has('solusi_buyer_resi') ? 'has-error' : ''}}">
                                    {!! Form::text('solusi_buyer_resi', $item->solusi_buyer_resi, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'No.Resi', 
                                        'required'
                                    ])!!}
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                {{-- {!! Form::label('solusi_buyer_date', 'Label') !!} --}}
                                <div class="form-group {{ $errors->has('solusi_buyer_shipment') ? 'has-error' : ''}}">
                                    {!! Form::text('solusi_buyer_shipment', $item->solusi_buyer_shipment, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Jasa pengiriman', 
                                        'required'
                                    ])!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>
        {!! Form::close() !!}
    </div>
</div>