@if(str_contains(Request::url(), ['create']))
@elseif(str_contains(Request::url(), ['edit']))
<div class="form-group">
    {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <img class="h100" src="{{asset('assets/images/brand/'.$brand->brand_image) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
    </div>
</div>
@endif
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('brand_image') ? 'has-error' : ''}}">
    {!! Form::label('brand_image', 'Image : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::file('brand_image', null, [
            'class' => 'form-control', 
            'placeholder' => 'Image', 
            'required'
        ])!!}
        {!! $errors->first('brand_image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('brand_name') ? 'has-error' : ''}}">
    {!! Form::label('brand_name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('brand_name', null, [
            'class' => 'form-control', 
            'placeholder' => 'Name', 
            'required'
        ])!!}
    {!! $errors->first('brand_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('brand_note') ? 'has-error' : ''}}">
    {!! Form::label('brand_note', 'Note : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('brand_note', null, [
          'class' => 'form-control', 
          'placeholder' => 'Note', 
        ])!!}
        {!! $errors->first('brand_note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<button type="submit" class="btn btn-primary mb-2">Save</button>
