<style type="text/css">
#myloading {
  display: inline-block;
  width: 50px;
  height: 50px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: blue;
  animation: spin 0.8s ease-in-out infinite;
  -webkit-animation: spin 0.5s ease-in-out infinite;
}
#myloading2 {
  display: inline-block;
  width: 15px;
  height: 15px;
  border: 1px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: blue;
  animation: spin 0.8s ease-in-out infinite;
  -webkit-animation: spin 0.5s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
</style>
<div class="panel panel-white col-md-12">
    <div class="panel-body">
        <div class="row">
            @if(str_contains(Request::url(), ['create']))
            <div class="col-xs-10 col-md-8 col-sm-10 col-sm-offset-3">
                <span class="text-danger">Size : <b>300 pixel</b> x <b>320 pixel</b></span>
            </div><br/><br/>
            {!! Form::label('produk_user_status', 'Image: ', ['class' => 'col-md-3 col-md-12 col-md-12 control-label']) !!}
            <div class="col-xs-10 col-md-8 col-sm-10 append-img">
                <div class="parent-img">
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled" placeholder="Main Image">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <div class="btn btn-default image-preview-input" >
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input type="file" class="input_file_preview" accept="image/png, image/jpeg, image/gif" name="input_file_preview[]"/ placeholder="asdadas">
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            <div id="maxlimaw">
             <button type="button" class="btn btn-success col-sm-1 col-xs-1 clickkurang" id="add-file-field" onclick="asdfkurang()">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
            </div>
            <script type="text/javascript">
                function asdfkurang(){
              
                var counter = 0;
                $(".clickkurang").click(function() {
                counter++;
                if(counter == 4){
                    alert('max 5 image');
                    $("#maxlimaw").html("");
                }
            });
            }
            </script>
            @elseif(str_contains(Request::url(), ['edit']))
            {!! Form::label('produk_user_status', 'Choose main Image : ', ['class' => 'col-md-3 col-md-12 col-md-12 control-label']) !!}
            <div class="col-xs-10 col-md-8 col-sm-10">
                <div class="roup">
                @foreach($produk->images->all() as $item)
              
                
                
                        <div class="col-md-2">
                         
                            <label class="btn btn-primary">
                               <a onclick="removeasdf('{{$item['id']}}')"><img src="{{asset('assets/images/product/'.$item['produk_image_image'])}}" alt="..." class="img-thumbnail img-check"></a>
                                <input type="radio" name="input_file_choose" value="{{$item['produk_image_image']}}" class="hidden" autocomplete="off">
                            </label>
                        </div>

                @endforeach   
                </div>
            </div>
            @if($asdfku < 5)
            <div class="col-xs-10 col-md-8 col-sm-10 col-sm-offset-3">
            <span class="text-danger">Width not too long from height.</span>
            </div><br/><br/>
            {!! Form::label('produk_user_status', 'Image : ', ['class' => 'col-md-3 col-md-12 col-md-12 control-label']) !!}
            <div class="col-xs-10 col-md-8 col-sm-10 append-img">
                <div class="parent-img">
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <div class="btn btn-default image-preview-input">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input type="file" class="input_file_preview" accept="image/png, image/jpeg, image/gif" name="input_file_preview[]"/>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
            @if($asdfku < 4)
            <div id="maxlima">
            <button type="button" class="btn btn-success col-sm-1 col-xs-1 clickkurang" id="add-file-field" onclick="asdfkurang()">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
            </div>
            @else

            @endif
            @else
            <br/><br/><div class="col-xs-10 col-md-8 col-sm-10 col-sm-offset-3">
                <span class="text-danger">Please remove one of images to upload picture</span>
            </div>
            @endif
            <script type="text/javascript">
                function asdfkurang(){
                var eee = 4 - <?php echo $asdfku ?>;
                var counter = 0;
                $(".clickkurang").click(function() {
                counter++;
                if(counter == eee){
                    alert('max gambar lima');
                    $("#maxlima").html("");
                }
            });
            }
            </script>
            @endif
        </div>
    </div>
</div>
<div class="panel panel-white col-md-12">
    <div class="panel-body">
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Category : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_category_id' class="form-control">
                    <option value=''>-- Choose Category --</option>
                    @foreach($category as $item)
                    @if ($item->category_name != 'Green Productions')
                    <option value='{{$item->id}}'>{{ucfirst(strtolower($item->category_name))}}</option>
                    @endif
                    @endforeach
                </select>
                {!! $errors->first('produk_category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Category : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_category_id' class="form-control">
                    <!-- <option selected>{{$produk->category->category_name}} </option> -->
                    @foreach($category as $item)
                        <option value='{{$item->id}}' <?php if($produk->produk_category_id == $item->id){echo "selected";}?> >{{ucfirst(strtolower($item->category_name))}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endif
        @if(str_contains(Request::url(), ['create']))
        <div class="hidden form-group {{ $errors->has('produk_brand_id') ? 'has-error' : ''}}">
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
        <div class="hidden form-group {{ $errors->has('produk_brand_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_brand_id', 'Brand : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_brand_id' class="form-control">
                    @foreach($brand as $item)
                        <option value='{{$item->id}}' <?php if($produk->produk_brand_id == $item->id){echo "selected";}?> >{{$item->brand_name}}</option>
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
        
        <!-- <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_status', 'Status : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_status', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Status', 
                    'required'
                ])!!}
            {!! $errors->first('produk_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
    </div>
</div>
<div class="panel panel-white col-md-6 no-border">
    <div class="panel-body">
        @if(str_contains(Request::url(), ['create']))
        <!-- <div class="form-group {{ $errors->has('produk_user_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_user_status', 'User Level : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_user_status' class="form-control">
                    @foreach($role as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_user_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
        @elseif(str_contains(Request::url(), ['edit']))
        <!-- <div class="form-group {{ $errors->has('produk_user_status') ? 'has-error' : ''}}">
            {!! Form::label('produk_user_status', 'User Level : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_user_status' class="form-control">
                    @foreach($role as $item)
                        <option value='{{$item->id}}' <?php if($produk->produk_user_status == $item->id){echo "selected";}?> >{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_user_status', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
        @endif
        @if(str_contains(Request::url(), ['create']))
        <!-- <div class="form-group {{ $errors->has('produk_seller_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_seller_id', 'Seller : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_seller_id' class="form-control">
                    @foreach($user as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_seller_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
        @elseif(str_contains(Request::url(), ['edit']))
        <!-- <div class="form-group {{ $errors->has('produk_seller_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_seller_id', 'Seller : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_seller_id' class="form-control">
                    @foreach($user as $item)
                        <option value='{{$item->id}}' <?php if($produk->produk_seller_id == $item->id){echo "selected";}?> >{{$item->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_seller_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div> -->
        @endif
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_stock') ? 'has-error' : ''}}">
            {!! Form::label('produk_stock', 'Stock : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                     @if(str_contains(Request::url(), ['create']))
                        {!! Form::number('produk_stock', 1, [
                        'min' => '1',
                        'class' => 'form-control', 
                        'placeholder' => 'Stok', 
                        'required'
                    ])!!}
                    @elseif(str_contains(Request::url(), ['edit']))
                     {!! Form::number('produk_stock', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Stok', 
                        'required'
                     ])!!}
                    @endif
                    <span class="input-group-btn">
                        @if(str_contains(Request::url(), ['create']))
                            <select name='produk_unit' class="btn btn-info">
                                @foreach($produk_unit as $item)
                                <option value='{{$item->id}}'>{{ucfirst(strtolower($item->produk_unit_name))}}</option>
                                @endforeach
                            </select>
                        @elseif(str_contains(Request::url(), ['edit']))
                            <select name='produk_unit' class="btn btn-info">
                                @foreach($produk_unit as $item)
                                    <option value='{{$item->id}}' <?php if($produk->produk_unit == $item->id){echo "selected";}?> >{{$item->produk_unit_name}}</option>
                                @endforeach
                            </select>
                        @endif
                    </span>
                </div>
            {!! $errors->first('produk_stock', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_location') ? 'has-error' : ''}}">
            {!! Form::label('produk_location', 'Currency : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                @if(str_contains(Request::url(), ['create']))
                    <select name='produk_location' class="form-control">
                        @foreach($produk_location as $item)
                        <option value='{{$item->id}}'>{{ucfirst(strtolower($item->produk_location_name))}}</option>
                        @endforeach
                    </select>
                @elseif(str_contains(Request::url(), ['edit']))
                    <select name='produk_location' class="form-control">
                        @foreach($produk_location as $item)
                            <option value='{{$item->id}}' <?php if($produk->produk_location == $item->id){echo "selected";}?> >{{$item->produk_location_name}}</option>
                        @endforeach
                    </select>
                @endif
            {!! $errors->first('produk_location', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_price') ? 'has-error' : ''}}">
            {!! Form::label('produk_price', 'Price (MYR) : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                 @if(str_contains(Request::url(), ['create']))
                   {!! Form::number('produk_price', null, [
                                'min' => '0',
                                'class' => 'form-control', 
                                'placeholder' => 'Price', 
                                'step' => "any",
                                'id'    => "price_myr",
                                'onkeyup' => "price_()",
                                'required'
                            ])!!}
                    @elseif(str_contains(Request::url(), ['edit']))
                    {!! Form::number('produk_price', number_format($produk->produk_price, 0, ',', ''), [
                                'min' => '0',
                                'class' => 'form-control', 
                                'placeholder' => 'Price', 
                                'step' => "any",
                                'id'    => "price_myr",
                                'required'
                            ])!!}
                 @endif
            {!! $errors->first('produk_price', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('price_idr') ? 'has-error' : ''}}">
            {!! Form::label('price_idr', 'Price (IDR) : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                 @if(str_contains(Request::url(), ['create']))
                   {!! Form::number('price_idr', null, [
                                'min' => '0',
                                'class' => 'form-control', 
                                'placeholder' => 'Price (IDR)', 
                                'step' => "any",
                                'id' => "price_idr",
                                'disabled' => 'disabled',
                                'required'
                            ])!!}
                    @elseif(str_contains(Request::url(), ['edit']))
                    {!! Form::number('price_idr', number_format($produk->produk_price, 0, ',', ''), [
                                'min' => '0',
                                'class' => 'form-control', 
                                'placeholder' => 'Price (IDR)', 
                                'step' => "any",
                                'id' => "price_idr",
                                'disabled' => 'disabled',
                                'required'
                            ])!!}
                 @endif
            {!! $errors->first('price_idr', '<p class="help-block">:message</p>') !!}
            </div>
        </div>        
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_size') ? 'has-error' : ''}}">
            {!! Form::label('produk_size', 'Size : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="btn-group" data-toggle="buttons">
                    @if(str_contains(Request::url(), ['create']))
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="xs" autocomplete="off">
                            XS <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="s" autocomplete="off">
                            S <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="m" autocomplete="off">
                            M <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="l" autocomplete="off">
                            L <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="xl" autocomplete="off">
                            XL <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="xxl" autocomplete="off">
                            XXL <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <br/>
                        <hr/>
                        @for($i=35;$i<=45;$i++)
                        <label class="btn btn-default btn-xs">
                            <input type="checkbox" name="produk_size[]" value="{{$i}}" autocomplete="off">
                            {{$i}} <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        @endfor
                    @elseif(str_contains(Request::url(), ['edit']))
                        <?php 
                            $array = explode (",", $produk->produk_size);
                        ?>
                        <label class="btn btn-default btn-xs {{(in_array("xs", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="s" autocomplete="off" {{(in_array("s", $array))?"checked":""}}>
                            XS <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs {{(in_array("s", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="s" autocomplete="off" {{(in_array("s", $array))?"checked":""}}>
                            S <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs {{(in_array("m", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="m" autocomplete="off" {{(in_array("m", $array))?"checked":""}}>
                            M <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs {{(in_array("l", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="l" autocomplete="off" {{(in_array("l", $array))?"checked":""}}>
                            L <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs {{(in_array("xl", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="xl" autocomplete="off" {{(in_array("xl", $array))?"checked":""}}>
                            XL <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <label class="btn btn-default btn-xs {{(in_array("Xxl", $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="xl" autocomplete="off" {{(in_array("xl", $array))?"checked":""}}>
                            XXL <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        <br/>
                        <hr/>
                        @for($i=35;$i<=45;$i++)
                        <label class="btn btn-default btn-xs {{(in_array($i, $array))?'active':''}}">
                            <input type="checkbox" name="produk_size[]" value="{{$i}}" autocomplete="off" {{(in_array($i, $array))?"checked":""}}>
                            {{$i}} <span class="check glyphicon glyphicon-ok"></span>
                        </label>
                        @endfor
                    @endif
                    {{-- <label class="btn btn-default">
                        <input type="checkbox" name="produk_size[]" value="other" autocomplete="off">
                        ETC <span class="check glyphicon glyphicon-ok"></span>
                    </label> --}}
                </div>
                <!-- {!! Form::text('produk_size', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Size', 
                    'required'
                ])!!} -->
            {!! $errors->first('produk_size', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_length') ? 'has-error' : ''}}">
            {!! Form::label('produk_length', 'Length : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_length', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Length', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_length', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_wide') ? 'has-error' : ''}}">
            {!! Form::label('produk_wide', 'Width : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_wide', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Width', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_wide', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_height') ? 'has-error' : ''}}">
            {!! Form::label('produk_height', 'Height : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_height', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Height', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_height', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_color') ? 'has-error' : ''}}">
            {!! Form::label('produk_color', 'Color : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="" data-toggle="buttons">
                    {{-- <label class="btn btn-primary btn-block">
                        <input type="checkbox" name="produk_color[]" value="blue" autocomplete="off">
                        BlUE <span class="check glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-warning btn-block">
                        <input type="checkbox" name="produk_color[]" value="orange" autocomplete="off">
                        ORANGE <span class="check glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-danger btn-block">
                        <input type="checkbox" name="produk_color[]" value="red" autocomplete="off">
                        RED <span class="check glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-success btn-block">
                        <input type="checkbox" name="produk_color[]" value="green" autocomplete="off">
                        GREEN <span class="check glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-default btn-block">
                        <input type="checkbox" name="produk_color[]" value="white" autocomplete="off">
                        WHITE <span class="check glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-block">
                        <input type="checkbox" name="produk_color[]" value="other" autocomplete="off">
                        other <span class="check glyphicon glyphicon-ok"></span>
                    </label> --}}
                    @if(str_contains(Request::url(), ['create']))
                        <div class="input-group col-md-12 multiple-form-group" data-max="5">
                            <div class="form-group">
                                <div class="cp input-group colorpicker-component">
                                    <input type="text" name="produk_color[]" value="#00AABB" class="form-control" />
                                    <span class="input-group-addon"><i></i></span>
                                    <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>
                                </div>
                            </div>
                        </div>
                    @elseif(str_contains(Request::url(), ['edit']))
                        <?php 
                            $array = explode (",", $produk->produk_color);
                        ?>
                        <div class="input-group col-md-12 multiple-form-group" data-max="5">
                            @foreach($array as $item)
                                @if($loop->last)
                                    <div class="form-group">
                                        <div class="cp input-group colorpicker-component">
                                            <input type="text" name="produk_color[]" value="{{$item}}" class="form-control" />
                                            <span class="input-group-addon"><i></i></span>
                                            <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <div class="cp input-group colorpicker-component">
                                            <input type="text" name="produk_color[]" value="{{$item}}" class="form-control" />
                                            <span class="input-group-addon"><i></i></span>
                                            <span class="input-group-btn"><button type="button" class="btn btn-danger btn-remove">–</button></span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- {!! Form::text('produk_color', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Color', 
                    'required'
                ])!!} -->
            {!! $errors->first('produk_color', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="panel panel-white col-md-6 no-border">
    <div class="panel-body">
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_weight') ? 'has-error' : ''}}">
            {!! Form::label('produk_weight', 'Weight : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::text('produk_weight', (isset($produk->produk_discount))?$produk->produk_weight:0.00, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Weight', 
                        'onkeyup' => 'checkDecimal(this);',
                        'required'
                    ])!!}
                    <span class="input-group-addon">g</span>
                </div>
            {!! $errors->first('produk_weight', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_discount') ? 'has-error' : ''}}">
            {!! Form::label('produk_wide', 'Discount : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::text('produk_discount', (isset($produk->produk_discount))?$produk->produk_discount:0.00, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Discount', 
                        'onkeyup' => 'checkDecimal(this);',
                        'required'
                    ])!!}
                    <span class="input-group-addon">%</span>
                </div>
            {!! $errors->first('produk_discount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_location') ? 'has-error' : ''}}">
            {!! Form::label('produk_location', 'Location : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                @if(str_contains(Request::url(), ['create']))
                    <select name='produk_location' class="form-control">
                        @foreach($produk_location as $item)
                        <option value='{{$item->id}}'>{{ucfirst(strtolower($item->produk_location_name))}}</option>
                        @endforeach
                    </select>
                @elseif(str_contains(Request::url(), ['edit']))
                    <select name='produk_location' class="form-control">
                        @foreach($produk_location as $item)
                            <option value='{{$item->id}}' <?php if($produk->produk_location == $item->id){echo "selected";}?> >{{$item->produk_location_name}}</option>
                        @endforeach
                    </select>
                @endif
            {!! $errors->first('produk_location', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        {{-- <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_viewer') ? 'has-error' : ''}}">
            {!! Form::label('produk_viewer', 'Viewer : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::number('produk_viewer', null, [
                    'min' => '0',
                    'class' => 'form-control', 
                    'placeholder' => 'Viewer', 
                    'required'
                ])!!}
            {!! $errors->first('produk_viewer', '<p class="help-block">:message</p>') !!}
            </div>
        </div> --}}
        {{-- <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_is_best') ? 'has-error' : ''}}">
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
        </div> --}}
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_note') ? 'has-error' : ''}}">
            {!! Form::label('produk_note', 'Description : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::textarea('produk_note', null, [
                  'class' => 'form-control', 
                  'placeholder' => 'Description', 
                ])!!}
                {!! $errors->first('produk_note', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
{{-- grosir --}}

<div class="panel panel-white col-md-12 border-success">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 columns">
                    <ul class="list-group">
                        <li class="list-group-item no-border">
                            <a class="btn btn-info btn-block" data-toggle="collapse" href="#grosir" role="button" aria-expanded="false" aria-controls="grosir"><b>Distributor Price</b></a>
                            <div id="grosir" class="collapse">
                                <table class="table table-bordered table-striped table-highlight m-t-xs">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product Total (Unit)</th>
                                            <th width="200">Price / Unit</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="grosir_row">
                                        @if(str_contains(Request::url(), ['edit']))
                                            @if($produk->is_grosir())
                                                @foreach($produk->grosir as $item_grosir)
                                                    <tr>
                                                        <td style="width: 20%">
                                                            <input class="form-control hidden" type="number" name="produk_grosir_id[]" placeholder="id" value="{{$item_grosir->id}}">
                                                            <input class="form-control" type="number" name="produk_grosir_start[]" placeholder="start" value="{{$item_grosir->produk_grosir_start}}">
                                                            <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                                        </td>
                                                        <td style="width: 20%">
                                                            <input class="form-control" type="number" name="produk_grosir_end[]" placeholder="end" value="{{$item_grosir->produk_grosir_end}}">
                                                            <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                                        </td>
                                                        <td style="width: 50%">
                                                            <input class="form-control" type="number" name="produk_grosir_price[]" value="{{$item_grosir->produk_grosir_price}}">
                                                            <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                                        </td>
                                                        <td class="text-center">
                                                            <!-- <a class="btn btn-xs btn-success" onclick="add_grosir_row();">
                                                                <i class="fa fa-plus"></i>
                                                            </a> -->
                                                            <a class="btn btn-xs btn-danger remove_grosir">
                                                                <i class="fa fa-minus"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endif
                                        <tr>
                                            <td style="width: 20%">
                                                <input class="form-control" type="number" name="produk_grosir_start[]" placeholder="start" >
                                                <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                            </td>
                                            <td style="width: 20%">
                                                <input class="form-control" type="number" name="produk_grosir_end[]" placeholder="end" >
                                                <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                            </td>
                                            <td style="width: 50%">
                                                <input class="form-control" type="number" name="produk_grosir_price[]" >
                                                <i class='btn-block bg-danger m-t-xs'>Must be numeric</i>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-xs btn-success" onclick="add_grosir_row();">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table width="100%" style="margin-bottom: 0">
                                    <tbody>
                                        <tr>
                                            <td style="font-size: 13px;" colspan="4">
                                                Total and price without commas(,) and dot(.) <br>
                                                Example:<br>
                                                Group Total: 1 - 10, Price: 15000<br>
                                                Group Total: 11 - 20, Price: 10000<br>
                                                etc...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-white col-md-12 no-border">
    <div class="panel-body">
        <button type="submit" class="btn btn-primary mb-2">Save</button>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-body">
<center><div class="getimage uloader"></div></center>
</div>
 <form action="#" id="formUpdate" class="form-horizontal">
               @csrf
             <!--  <input  name="_token"> -->
              <input value="" type="hidden" name="id_image"/>
            </form>
<div class="modal-footer">
      <button type="button" id="btnSave" onclick="save()" class="btn m-btn--pill m-btn--air btn-danger uloader2">delete</button>
<button type="button" class="btn btn-metal btn-sm" data-dismiss="modal">batal</button>
</div>
</div>
</div>
@if(str_contains(Request::url(), ['member']))


<script type="text/javascript">
function price_(){
    var kurs_myr = {!! FunctionLib::cekKurs() !!};
    var myr = kurs_myr.Data.MYR.Beli;
   var price_myr = document.getElementById('price_myr').value;
   var price_idr = parseFloat((price_myr * myr)).toFixed(2);
   document.getElementById('price_idr').value=price_idr;
}

function removeasdf(id){
     $('.bs-example-modal-sm').modal('show');
     $('.getimage').html('');
     $('.uloader').html('<br><br><br><br><div id="myloading"></div>');
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('[name="_token"]').val(CSRF_TOKEN);
    $.ajax({
        url : '{{ url('member/produk/edit_get') }}' + '/' + id,
        type: "GET",
        dataType: "JSON",
         success: function(data){
            setTimeout(function(){ 
              $('.uloader').html('');
               $("[name='id_image']").val(data.produk_image_image);
              $('.getimage').html('<br><br><image style="min-height: 100px;max-height: 200px;height: 100%; min-width:100; max-width:200px; width:100%" src="/assets/images/product/'+data.produk_image_image+'"/>')
             }, 500);

        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}


function save(){
   $('.uloader2').html('&nbsp;&nbsp;<div id="myloading2"></div>&nbsp;&nbsp;');
   $('#btnSave').removeClass('btn-danger').addClass('btn-metal');
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url : "{{ url('member/produk/edit_get/post') }}",
        type: "POST",
        data: {_token: CSRF_TOKEN, message:$("[name='id_image']").val()},
        dataType: "JSON",
        success: function(data){
            setTimeout(function(){

             window.location.reload();
            }, 500)
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
               $('#btnSave').removeClass('btn-metal').addClass('btn-danger');
               $('.uloader2').html('delete');
        }
    });
}

</script>

@elseif(str_contains(Request::url(), ['admin']))

<script type="text/javascript">

   function removeasdf(id){
     $('.bs-example-modal-sm').modal('show');
     $('.getimage').html('');
     $('.uloader').html('<br><br><br><br><div id="myloading"></div>');
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('[name="_token"]').val(CSRF_TOKEN);
    $.ajax({
        url : '{{ url('admin/produk/edit_get') }}' + '/' + id,
        type: "GET",
        dataType: "JSON",
         success: function(data){
            setTimeout(function(){ 
              $('.uloader').html('');
               $("[name='id_image']").val(data.produk_image_image);
              $('.getimage').html('<br><br><image style="min-height: 100px;max-height: 200px;height: 100%; min-width:100; max-width:200px; width:100%" src="/assets/images/product/'+data.produk_image_image+'"/>')
             }, 500);

        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}


function save(){
   $('.uloader2').html('&nbsp;&nbsp;<div id="myloading2"></div>&nbsp;&nbsp;');
   $('#btnSave').removeClass('btn-danger').addClass('btn-metal');
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url : "{{ url('admin/produk/edit_get/post') }}",
        type: "POST",
        data: {_token: CSRF_TOKEN, message:$("[name='id_image']").val()},
        dataType: "JSON",
        success: function(data){
            setTimeout(function(){

             window.location.reload();
            }, 500)
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
               $('#btnSave').removeClass('btn-metal').addClass('btn-danger');
               $('.uloader2').html('delete');
        }
    });
}

</script>
    



@endif


