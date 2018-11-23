@if(str_contains(Request::url(), ['create']))
<div class="form-group {{ $errors->has('shipment_parent_id') ? 'has-error' : ''}}">
    {!! Form::label('shipment_parent_id', 'Parent : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <select name='shipment_parent_id' class="form-control">
            <option value='0'>No Parent</option>
            @foreach($shipment_par as $item)
            <option value='{{$item->id}}'>{{$item->shipment_name}}</option>
            @endforeach
        </select>
        {!! $errors->first('shipment_parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@elseif(str_contains(Request::url(), ['edit']))
<div class="form-group {{ $errors->has('shipment_parent_id') ? 'has-error' : ''}}">
    {!! Form::label('shipment_parent_id', 'Parent : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <select name='shipment_parent_id' class="form-control">
            <option value='0'>No Parent</option>
            @foreach($shipment_par as $item)
                <option value='{{$item->id}}' <?php if($shipment->shipment_parent_id == $item->id){echo "selected";}?> >{{$item->shipment_name}}</option>
            @endforeach
        </select>
        {!! $errors->first('shipment_parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('shipment_name') ? 'has-error' : ''}}">
    {!! Form::label('shipment_name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('shipment_name', null, [
            'class' => 'form-control', 
            'placeholder' => 'Name', 
            'required'
        ])!!}
    {!! $errors->first('shipment_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('shipment_note') ? 'has-error' : ''}}">
    {!! Form::label('shipment_note', 'Note : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('shipment_note', null, [
          'class' => 'form-control', 
          'placeholder' => 'Note', 
        ])!!}
        {!! $errors->first('shipment_note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<button type="submit" class="btn btn-primary mb-2">Save</button>
