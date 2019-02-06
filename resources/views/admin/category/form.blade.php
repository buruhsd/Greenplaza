@if(str_contains(Request::url(), ['create']))
<div class="form-group {{ $errors->has('category_parent_id') ? 'has-error' : ''}}">
    {!! Form::label('category_parent_id', 'Parent : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <select name='category_parent_id' class="form-control">
            <option value='0'>No Parent</option>
            @foreach($category_par as $item)
            <option value='{{$item->id}}'>{{$item->category_name}}</option>
            @endforeach
        </select>
        {!! $errors->first('category_parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@elseif(str_contains(Request::url(), ['edit']))
<div class="form-group {{ $errors->has('category_parent_id') ? 'has-error' : ''}}">
    {!! Form::label('category_parent_id', 'Parent : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <select name='category_parent_id' class="form-control">
            <option value='0'>No Parent</option>
            @foreach($category_par as $item)
                <option value='{{$item->id}}' <?php if($category->category_parent_id == $item->id){echo "selected";}?> >{{$item->category_name}}</option>
            @endforeach
        </select>
        {!! $errors->first('category_parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('category_name') ? 'has-error' : ''}}">
    {!! Form::label('category_name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('category_name', null, [
            'class' => 'form-control', 
            'placeholder' => 'Name', 
            'required'
        ])!!}
    {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('position') ? 'has-error' : ''}}" id="containment-wrapper">
    {!! Form::label('position', 'Position : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9" id="draggable3">
        {!! Form::text('position', null, [
            'class' => 'form-control', 
            'placeholder' => 'Position'
        ])!!}
    {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- @if(str_contains(Request::url(), ['create']))
@elseif(str_contains(Request::url(), ['edit']))
<div class="form-group">
    {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <img class="h100" src="{{asset('img_category_icon/'.$category->category_icon) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
    </div>
</div>
@endif
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('category_icon') ? 'has-error' : ''}}">
    {!! Form::label('category_icon', 'Icon : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::file('category_icon', null, [
            'class' => 'form-control', 
            'placeholder' => 'Image', 
            'required'
        ])!!}
        {!! $errors->first('category_icon', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(str_contains(Request::url(), ['create']))
@elseif(str_contains(Request::url(), ['edit']))
<div class="form-group">
    {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        <img class="h100" src="{{asset('assets/images/category_image/'.$category->category_image) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
    </div>
</div>
@endif
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('category_image') ? 'has-error' : ''}}">
    {!! Form::label('category_image', 'Image : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::file('category_image', null, [
            'class' => 'form-control', 
            'placeholder' => 'Image', 
            'required'
        ])!!}
        {!! $errors->first('category_image', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->
<!-- <div class="form-group mx-sm-3 mb-2 {{ $errors->has('category_slug') ? 'has-error' : ''}}">
    {!! Form::label('category_slug', 'Slug : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('category_slug', null, [
            'class' => 'form-control', 
            'placeholder' => 'Slug', 
            'required'
        ])!!}
    {!! $errors->first('category_slug', '<p class="help-block">:message</p>') !!}
    </div>
</div> -->
<div class="form-group mx-sm-3 mb-2 {{ $errors->has('category_note') ? 'has-error' : ''}}">
    {!! Form::label('category_note', 'Note : ', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::textarea('category_note', null, [
          'class' => 'form-control', 
          'placeholder' => 'Note', 
        ])!!}
        {!! $errors->first('category_note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<button type="submit" class="btn btn-primary mb-2">Save</button>


