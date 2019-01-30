<div class="panel panel-white col-md-6 no-border">
    <div class="panel-body">
        @if(str_contains(Request::url(), ['create']))
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group">
            {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <img class="h100" src="{{asset('assets/images/product/'.$transaction->produk_image) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
            </div>
        </div>
        @endif
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_image') ? 'has-error' : ''}}">
            {!! Form::label('produk_image', 'Image : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::file('produk_image', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Image', 
                    'required'
                ])!!}
                {!! $errors->first('produk_image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_user_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_user_status', 'User Level : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_user_status' class="form-control">
                    @foreach($role as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_user_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_user_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_user_status', 'User Level : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_user_status' class="form-control">
                    @foreach($role as $item)
                        <option value='{{$item->id}}' <?php if($transaction->produk_user_status == $item->id){echo "selected";}?> >{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_user_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_seller_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_seller_id', 'Seller : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_seller_id' class="form-control">
                    @foreach($user as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_seller_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_seller_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_seller_id', 'Seller : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_seller_id' class="form-control">
                    @foreach($user as $item)
                        <option value='{{$item->id}}' <?php if($transaction->produk_seller_id == $item->id){echo "selected";}?> >{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_seller_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Category : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_category_id' class="form-control">
                    @foreach($category as $item)
                    <option value='{{$item->id}}'>{{$item->category_name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Category : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_seller_id' class="form-control">
                    @foreach($category as $item)
                        <option value='{{$item->id}}' <?php if($transaction->produk_category_id == $item->id){echo "selected";}?> >{{$item->category_name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_brand_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_brand_id', 'Brand : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_brand_id' class="form-control">
                    @foreach($brand as $item)
                    <option value='{{$item->id}}'>{{$item->brand_name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_brand_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_brand_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_brand_id', 'Brand : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_brand_id' class="form-control">
                    @foreach($brand as $item)
                        <option value='{{$item->id}}' <?php if($transaction->produk_brand_id == $item->id){echo "selected";}?> >{{$item->brand_name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_brand_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_name') ? 'has-error' : ''}}">
            {!! Form::label('produk_name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_name', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Name', 
                    'required'
                ])!!}
            {!! $errors->first('produk_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_slug') ? 'has-error' : ''}}">
            {!! Form::label('produk_slug', 'Slug : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_slug', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Slug', 
                    'required'
                ])!!}
            {!! $errors->first('produk_slug', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_unit') ? 'has-error' : ''}}">
            {!! Form::label('produk_unit', 'Unit : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_unit', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Unit', 
                    'required'
                ])!!}
            {!! $errors->first('produk_unit', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_price') ? 'has-error' : ''}}">
            {!! Form::label('produk_price', 'Price : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_price', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Price', 
                    'required'
                ])!!}
            {!! $errors->first('produk_price', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_size') ? 'has-error' : ''}}">
            {!! Form::label('produk_size', 'Size : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_size', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Size', 
                    'required'
                ])!!}
            {!! $errors->first('produk_size', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_length') ? 'has-error' : ''}}">
            {!! Form::label('produk_length', 'Length : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_length', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Length', 
                    'required'
                ])!!}
            {!! $errors->first('produk_length', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_wide') ? 'has-error' : ''}}">
            {!! Form::label('produk_wide', 'Wide : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_wide', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Wide', 
                    'required'
                ])!!}
            {!! $errors->first('produk_wide', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_color') ? 'has-error' : ''}}">
            {!! Form::label('produk_color', 'Color : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_color', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Color', 
                    'required'
                ])!!}
            {!! $errors->first('produk_color', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="panel panel-white col-md-6 no-border">
    <div class="panel-body">
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_stock') ? 'has-error' : ''}}">
            {!! Form::label('produk_stock', 'Stock : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_stock', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Stock', 
                    'required'
                ])!!}
            {!! $errors->first('produk_stock', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_weight') ? 'has-error' : ''}}">
            {!! Form::label('produk_weight', 'Weight : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_weight', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Weight', 
                    'required'
                ])!!}
            {!! $errors->first('produk_weight', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_discount') ? 'has-error' : ''}}">
            {!! Form::label('produk_wide', 'Discount : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_discount', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Discount', 
                    'required'
                ])!!}
            {!! $errors->first('produk_discount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_location') ? 'has-error' : ''}}">
            {!! Form::label('produk_location', 'Location : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_location', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Location', 
                    'required'
                ])!!}
            {!! $errors->first('produk_location', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_viewer') ? 'has-error' : ''}}">
            {!! Form::label('produk_viewer', 'Viewer : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_viewer', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Viewer', 
                    'required'
                ])!!}
            {!! $errors->first('produk_viewer', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_status', 'Status : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_status', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Status', 
                    'required'
                ])!!}
            {!! $errors->first('produk_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_is_best') ? 'has-error' : ''}}">
            {!! Form::label('produk_is_best', 'Best Seller : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9 text-left">
                {!! Form::radio('produk_is_best', 0, true, [])!!}
                {!! Form::label('produk_is_best', 'No', []) !!}
                {!! Form::radio('produk_is_best', 1, false, [])!!}
                {!! Form::label('produk_is_best', 'Yes', []) !!}
            {!! $errors->first('produk_is_best', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_is_hot') ? 'has-error' : ''}}">
            {!! Form::label('produk_is_hot', 'Hot List : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9 text-left">
                {!! Form::radio('produk_is_hot', 0, true, [])!!}
                {!! Form::label('produk_is_hot', 'No', []) !!}
                {!! Form::radio('produk_is_hot', 1, false, [])!!}
                {!! Form::label('produk_is_hot', 'Yes', []) !!}
            {!! $errors->first('produk_is_hot', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_note') ? 'has-error' : ''}}">
            {!! Form::label('produk_note', 'Note : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::textarea('produk_note', null, [
                  'class' => 'form-control', 
                  'placeholder' => 'Note', 
                ])!!}
                {!! $errors->first('produk_note', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="panel panel-white col-md-12 no-border">
    <div class="panel-body">
        <button type="submit" class="btn btn-primary mb-2">Save</button>
    </div>
</div>
