<div class="panel panel-white col-md-12">
    <div class="panel-body">
        <div class="row">
            @if(str_contains(Request::url(), ['create']))
            <div class="col-xs-10 col-md-8 col-sm-10 col-sm-offset-3">
                <span class="text-danger">Lebar jangan lebih panjang dari tinggi.</span>
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
            @elseif(str_contains(Request::url(), ['edit']))
            {!! Form::label('produk_user_status', 'Pilih Gambar Utama : ', ['class' => 'col-md-3 col-md-12 col-md-12 control-label']) !!}
            <div class="col-xs-10 col-md-8 col-sm-10">
                <div class="roup">
                @foreach($produk->images->all() as $item)
                    @if ($loop->first)
                        <div class="col-md-2">
                            <label class="btn btn-primary">
                                <img src="{{asset('assets/images/product/'.$item['produk_image_image'])}}" alt="..." class="img-thumbnail img-check img-checked">

                                <input type="radio" name="input_file_choose" value="{{$item['produk_image_image']}}" class="hidden" autocomplete="off">
                            </label>
                        </div>
                    @else
                        <div class="col-md-2">
                         
                            <label class="btn btn-primary">
                               <a onclick="removeasdf(3)"><img src="{{asset('assets/images/product/'.$item['produk_image_image'])}}" alt="..." class="img-thumbnail img-check"></a>
                                <input type="radio" name="input_file_choose" value="{{$item['produk_image_image']}}" class="hidden" autocomplete="off">
                            </label>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
            <div class="col-xs-10 col-md-8 col-sm-10 col-sm-offset-3">
                <span class="text-danger">Lebar jangan lebih panjang dari tinggi.</span>
            </div><br/><br/>
            {!! Form::label('produk_user_status', 'Gambar : ', ['class' => 'col-md-3 col-md-12 col-md-12 control-label']) !!}
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
            @endif
            <button type="button" class="btn btn-success col-sm-1 col-xs-1" id="add-file-field">
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
    </div>
</div>
<div class="panel panel-white col-md-12">
    <div class="panel-body">
        @if(str_contains(Request::url(), ['create']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Kategori : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_category_id' class="form-control">
                    @foreach($category as $item)
                    <option value='{{$item->id}}'>{{ucfirst(strtolower($item->category_name))}}</option>
                    @endforeach
                </select>
                {!! $errors->first('produk_category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @elseif(str_contains(Request::url(), ['edit']))
        <div class="form-group {{ $errors->has('produk_category_id') ? 'has-error' : ''}}">
            {!! Form::label('produk_category_id', 'Kategori : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='produk_category_id' class="form-control">
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
            {!! Form::label('produk_name', 'Nama : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('produk_name', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Nama', 
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
            {!! Form::label('produk_stock', 'Stok : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_stock', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Stok', 
                        'required'
                    ])!!}
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
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_price') ? 'has-error' : ''}}">
            {!! Form::label('produk_price', 'Harga : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::number('produk_price', null, [
                    'min' => '0',
                    'class' => 'form-control', 
                    'placeholder' => 'Harga', 
                    'step' => "any",
                    'required'
                ])!!}
            {!! $errors->first('produk_price', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_size') ? 'has-error' : ''}}">
            {!! Form::label('produk_size', 'Ukuran : ', ['class' => 'col-md-3 control-label']) !!}
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
            {!! Form::label('produk_length', 'Panjang : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_length', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Panjang', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_length', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_wide') ? 'has-error' : ''}}">
            {!! Form::label('produk_wide', 'Lebar : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_wide', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Lebar', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_wide', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_height') ? 'has-error' : ''}}">
            {!! Form::label('produk_height', 'Tinggi : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::number('produk_height', null, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Tinggi', 
                        'required'
                    ])!!}
                    <span class="input-group-addon">mm</span>
                </div>
            {!! $errors->first('produk_height', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('produk_color') ? 'has-error' : ''}}">
            {!! Form::label('produk_color', 'Warna : ', ['class' => 'col-md-3 control-label']) !!}
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
                        <div class="input-group col-md-12 multiple-form-group" data-max="3">
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
                        <div class="input-group col-md-12 multiple-form-group" data-max="3">
                            @foreach($array as $item)
                                <div class="form-group">
                                    <div class="cp input-group colorpicker-component">
                                        <input type="text" name="produk_color[]" value="{{$item}}" class="form-control" />
                                        <span class="input-group-addon"><i></i></span>
                                        <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+</button></span>
                                    </div>
                                </div>
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
            {!! Form::label('produk_weight', 'Berat : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <div class="input-group">
                    {!! Form::text('produk_weight', (isset($produk->produk_discount))?$produk->produk_weight:0.00, [
                        'min' => '0',
                        'class' => 'form-control', 
                        'placeholder' => 'Berat', 
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
            {!! Form::label('produk_note', 'Keterangan : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::textarea('produk_note', null, [
                  'class' => 'form-control', 
                  'placeholder' => 'Keterangan', 
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
                            <a class="btn btn-info btn-block" data-toggle="collapse" href="#grosir" role="button" aria-expanded="false" aria-controls="grosir"><b>Harga Grosir</b></a>
                            <div id="grosir" class="collapse">
                                <table class="table table-bordered table-striped table-highlight m-t-xs">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Total Produk (buah)</th>
                                            <th width="200">Harga Barang / buah</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="grosir_row">
                                        <tr>
                                            <td style="width: 20%">
                                                <input class="form-control" type="number" name="produk_grosir_start[]" placeholder="start" >
                                                <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i>
                                            </td>
                                            <td style="width: 20%">
                                                <input class="form-control" type="number" name="produk_grosir_end[]" placeholder="end" >
                                                <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i>
                                            </td>
                                            <td style="width: 50%">
                                                <input class="form-control" type="number" name="produk_grosir_price[]" >
                                                <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i>
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
                                                Jumlah dan Harga tanpa tanda koma dan titik.<br>
                                                Contoh:<br>
                                                Kelompok Jumlah: 1 - 10, Harga: 15000<br>
                                                Kelompok Jumlah: 11 - 20, Harga: 10000<br>
                                                dst...
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

<script type="text/javascript">
    function removeasdf(argument) {
        console.log("test");
    }
</script>