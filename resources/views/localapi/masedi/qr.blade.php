<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Pembayaran</h4>
        </div>
		{{-- {!! Form::open(['url' => route('localapi.midtrans.process'), 'method' => 'POST', 'id' => 'form-midtrans']) !!} --}}
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="cart-wrapper bg-1 p-10">
                        <div class="col-md-12">
                            {!! Form::label('label', 'Barcode Scanner : ') !!}
                            <div class="form-group">
                                {!! DNS2D::getBarcodeHTML($qr, "QRCODE") !!}
                            </div>
                            <pre>{{$qr}}</pre>
                        </div>
                        <div class="col-md-12 text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" value="Close" onclick="$(this).closest('.modal').modal('hide')">
        </div>
    </div>
</div>
<div id="ajax-modal2" class="modal" tabindex="-1" style="display: none;"></div>