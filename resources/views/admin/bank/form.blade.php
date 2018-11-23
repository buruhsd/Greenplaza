                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('bank_kode') ? 'has-error' : ''}}">
                        {!! Form::label('bank_kode', 'Code : ', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('bank_kode', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Code', 
                                'required'
                            ])!!}
                        {!! $errors->first('bank_kode', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('bank_status') ? 'has-error' : ''}}">
                        {!! Form::label('bank_status', 'Status : ', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('bank_status', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Status', 
                                'required'
                            ])!!}
                        {!! $errors->first('bank_status', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('bank_name') ? 'has-error' : ''}}">
                        {!! Form::label('bank_name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::text('bank_name', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Name', 
                                'required'
                            ])!!}
                        {!! $errors->first('bank_name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 {{ $errors->has('bank_note') ? 'has-error' : ''}}">
                        {!! Form::label('bank_note', 'Note : ', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('bank_note', null, [
                              'class' => 'form-control', 
                              'placeholder' => 'Note', 
                            ])!!}
                            {!! $errors->first('bank_note', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Save</button>
