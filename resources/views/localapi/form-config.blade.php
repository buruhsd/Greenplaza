<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Add Config</h4>
        </div>
        {!! Form::open(['url' => url('member/address/store'), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 m-b-xs">
                            <div class="form-group {{ $errors->has('configs_name') ? 'has-error' : ''}}">
                                {!! Form::label('configs_name', 'Name', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::text('configs_name', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Name', 
                                        'required'
                                    ])!!}
                                    {!! $errors->first('configs_name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('configs_value') ? 'has-error' : ''}}">
                            {!! Form::label('configs_value', 'Value', ['class' => 'col-md-3 control-label']) !!}
                                <div class="col-md-9">
                                    {!! Form::textarea('configs_value', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Value', 
                                        'required'
                                    ])!!}
                                    {!! $errors->first('configs_value', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            <a onclick="store_config(this)" class="btn btn-success">Add</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
</script>