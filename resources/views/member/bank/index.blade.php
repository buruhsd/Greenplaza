@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Rekening Bank</h3>
</div>
<div class="panel panel-white">
    <a class="btn btn-info" data-toggle="collapse" href="#add" role="button" aria-expanded="false" aria-controls="add">Tambah Rekening Baru</a>
    <div id="add" class="collapse">
        <table class="table table-bordered table-striped table-highlight m-t-xs">
            <thead>
            </thead>
            <tbody id="add_row">
                <tr>
                    <th style="width: 30%;">Bank</th>
                    <th style="width: 30%;">Owner</th>
                    <th style="width: 30%;">Account Number</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>
                        <div class="form-group-sm {{ $errors->has('user_bank_bank_id') ? 'has-error' : ''}}">
                            {!! Form::text('address_label', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Label', 
                                'required'
                            ])!!}
                            {!! $errors->first('user_bank_bank_id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group-sm {{ $errors->has('user_bank_owner') ? 'has-error' : ''}}">
                            {!! Form::text('user_bank_owner', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Owner', 
                                'required'
                            ])!!}
                            {!! $errors->first('user_bank_owner', '<p class="help-block">:message</p>') !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group-sm {{ $errors->has('user_bank_no') ? 'has-error' : ''}}">
                            {!! Form::text('user_bank_no', null, [
                                'class' => 'form-control', 
                                'placeholder' => 'Account Number', 
                                'required'
                            ])!!}
                            {!! $errors->first('user_bank_no', '<p class="help-block">:message</p>') !!}
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-block">Save</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="main-wrapper">
    <div class="row">
        <?php $no = 1; ?>
        @foreach($user->user_bank->all() as $item)
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4><b>{{$item->user_bank_no}} </b>{!!($item->user_bank_status == 1)?"<i class='btn btn-danger disabled'>Default</i>":""!!}</h4>
                    </div>
                    <div class="panel-body">
                        <i>Owner : {{$item->user_bank_owner}}</i><br>
                        {{FunctionLib::address_info($item->id)}}<br>
                        Bank {{$item->user_bank_name}}<br>
                        <div class="col-md-6">
                            <a class="btn btn-info btn-block" data-toggle="collapse" href="#edit{{$no}}" role="button" aria-expanded="false" aria-controls="edit"><b>Ubah</b></a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" href="{{route('member.bank.set_default', $item->id)}}" ><b>Set to Default</b></a>
                        </div>
                        <div id="edit{{$no}}" class="collapse">
                            <table class="table table-bordered table-striped table-highlight m-t-xs">
                                <thead>
                                </thead>
                                <tbody id="edit_row{{$no++}}" style="font-size: 10px;line-height: 0;">
                                    <tr>
                                        <th style="width: 50%;">Label</th>
                                        <th>Receiver</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_label') ? 'has-error' : ''}}">
                                                {!! Form::text('address_label', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Label', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('address_label', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_owner') ? 'has-error' : ''}}">
                                                {!! Form::text('address_owner', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Receiver', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Telepon</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_phone') ? 'has-error' : ''}}">
                                                {!! Form::text('address_phone', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Phone', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_tlp') ? 'has-error' : ''}}">
                                                {!! Form::text('address_tlp', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Telpon', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Province</th>
                                        <th>City</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_province') ? 'has-error' : ''}}">
                                                <select name='address_province' id='address_province' class="form-control" onchange="get_city(this.value);">
                                                    {{-- @foreach($province as $item)
                                                        <option value='{{$item['province_id']}}'>{{$item['province']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_city') ? 'has-error' : ''}}">
                                                <select name='address_city' id='address_city' class="form-control" onchange="get_subdistrict(this.value);">
                                                    {{-- @foreach($city as $item)
                                                        <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subdistrict</th>
                                        <th>Postal Code</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_subdist') ? 'has-error' : ''}}">
                                                <select name='address_subdist' id='address_subdist' class="form-control">
                                                    {{-- @foreach($subdistrict as $item)
                                                        <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('address_subdist', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('address_pos') ? 'has-error' : ''}}">
                                                {!! Form::text('address_pos', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Postal Code', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Subdistrict</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group-sm">
                                                    <textarea class="form-control" id="address_address" name="address_address" placeholder="Address..."></textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
                                   
        
                                        
                                           

                                