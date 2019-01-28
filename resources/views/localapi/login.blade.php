<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Login</h4>
        </div>
        {!! Form::open(['url' => route('login'), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('email', 'Email / Username') !!}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                {!! Form::text('email', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Email / Username', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_label', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('password', 'Password') !!}
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                {!! Form::password('password', [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Password', 
                                    'required'
                                ])!!}
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <input type="submit" class="btn btn-success" value="Login">
        </div>
        {!! Form::close() !!}
    </div>
</div>