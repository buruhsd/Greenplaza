<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Tambah Bank</h4>
        </div>
        {!! Form::open(['url' => url('member/bank/store'), 'method' => 'POST', 'id' => 'addbank']) !!}
        @csrf
        
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('user_bank_bank_id', 'Bank') !!}
                            <div class="form-group {{ $errors->has('user_bank_bank_id') ? 'has-error' : ''}}">
                                <select name='user_bank_bank_id' class="form-control">
                                    @foreach($cfg_bank as $item)
                                        <option value='{{$item->id}}'>{{$item->bank_name}}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('user_bank_bank_id', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('user_bank_owner', 'Atas Nama') !!}
                            <div class="form-group {{ $errors->has('user_bank_owner') ? 'has-error' : ''}}">
                                {!! Form::text('user_bank_owner', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Atas Nama', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_bank_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('user_bank_no', 'Nomor Rekening') !!}
                            <div class="form-group {{ $errors->has('user_bank_no') ? 'has-error' : ''}}">
                                {!! Form::text('user_bank_no', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Nomor Rekening', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_bank_no', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" value="Close" onclick="$(this).closest('.modal').modal('hide')">
            <input type="submit" class="btn btn-success" value="Simpan">
        </div>
        {!! Form::close() !!}
    </div>
</div>