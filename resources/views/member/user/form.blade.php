<div class="panel panel-white col-md-6 no-border">
    <div class="panel-body">
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('name', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Name', 
                    'required'
                ])!!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'email : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('email', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'email', 
                    'required'
                ])!!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_store') ? 'has-error' : ''}}">
            {!! Form::label('user_store', 'Window : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_store', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Window', 
                    'required'
                ])!!}
            {!! $errors->first('user_store', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_slogan') ? 'has-error' : ''}}">
            {!! Form::label('user_slogan', 'Slogan : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_slogan', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Slogan', 
                    'required'
                ])!!}
            {!! $errors->first('user_slogan', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_slug') ? 'has-error' : ''}}">
            {!! Form::label('user_slug', 'Slug : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_slug', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Slug', 
                    'required'
                ])!!}
            {!! $errors->first('user_slug', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('image', ' ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <img class="h100" src="{{asset('assets/images/profil/'.$user->user_store_image) }}" onerror="this.src='http://placehold.it/700x400'" alt="">
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_store_image') ? 'has-error' : ''}}">
            {!! Form::label('user_store_image', 'Image : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::file('user_store_image', null, [
                    'class' => 'form-control', 
                    'placeholder' => 'Image', 
                    'required'
                ])!!}
                {!! $errors->first('user_store_image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_phone') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_phone', 'Phone : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_phone', $user->user_detail->user_detail_phone, [
                    'class' => 'form-control', 
                    'placeholder' => 'Phone', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_tlp') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_tlp', 'phone House : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_tlp', $user->user_detail->user_detail_tlp, [
                    'class' => 'form-control', 
                    'placeholder' => 'phone House', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_tlp', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('user_detail_province') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_province', 'Provice', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='user_detail_province' id='user_detail_province' class="form-control" onchange="get_city(this.value);">
                </select>
                {!! $errors->first('user_detail_province', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('user_detail_city') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_city', 'City', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='user_detail_city' id='user_detail_city' class="form-control" onchange="get_subdistrict(this.value);">
                    {{-- @foreach($city as $item)
                        <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                    @endforeach --}}
                </select>
                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('user_detail_subdist') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_subdist', 'Subdistrict', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                <select name='user_detail_subdist' id='user_detail_subdist' class="form-control">
                    {{-- @foreach($subdistrict as $item)
                        <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                    @endforeach --}}
                </select>
                {!! $errors->first('user_detail_subdist', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_pos') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_pos', 'Postal Code : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_pos', $user->user_detail->user_detail_pos, [
                    'class' => 'form-control', 
                    'placeholder' => 'Postal Code', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_pos', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_name') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_bank_name', 'Bank Name : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_bank_name', $user->user_detail->user_detail_bank_name, [
                    'class' => 'form-control', 
                    'placeholder' => 'Bank Name', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_bank_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_owner') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_bank_owner', 'Owner : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_bank_owner', $user->user_detail->user_detail_bank_owner, [
                    'class' => 'form-control', 
                    'placeholder' => 'Owner', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_bank_owner', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_bank_no') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_bank_no', 'Account number : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::text('user_detail_bank_no', $user->user_detail->user_detail_bank_no, [
                    'class' => 'form-control', 
                    'placeholder' => 'Account number', 
                    'required'
                ])!!}
            {!! $errors->first('user_detail_bank_no', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_jk') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_jk', 'Gender : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9 text-left">
                {!! Form::radio('user_detail_jk', 'laki-laki', true, [])!!}
                {!! Form::label('user_detail_jk', 'Male', []) !!}
                {!! Form::radio('user_detail_jk', 'perempuan', false, [])!!}
                {!! Form::label('user_detail_jk', 'Female', []) !!}
            {!! $errors->first('user_detail_jk', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('user_detail_address') ? 'has-error' : ''}}">
            {!! Form::label('user_detail_address', 'Address : ', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
                {!! Form::textarea('user_detail_address', $user->user_detail->user_detail_address, [
                  'class' => 'form-control', 
                  'placeholder' => 'Address', 
                ])!!}
                {!! $errors->first('user_detail_address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
</div>
<div class="panel panel-white col-md-12 no-border">
    <div class="panel-body">
        <button type="submit" class="btn btn-primary mb-2">Save</button>
    </div>
</div>
