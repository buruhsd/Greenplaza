@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Daftar Alamat</h3>
    </div>
    <div class="panel-body">
    </div>
        <div class="panel panel-white">
            <input onclick='modal_get($(this));' data-dismiss="modal" data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addaddress")}} type="button" class="btn btn-danger btn-sm" name="addAdress" value="Tambah Alamat Baru" />
        </div>
    <div id="main-wrapper">
    <div class="row">
        <?php $no = 1; ?>
        @foreach($user->user_address->all() as $item)
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4><b>{{$item->user_address_label}}</b></h4>
                    </div>
                    <div class="panel-body">
                        <i>Penerima : {{$item->user_address_owner}}</i><br>
                        {{FunctionLib::address_info($item->id)}}<br>
                        Kode POS {{$item->user_address_pos}}<br>
                        HP. {{$item->user_address_phone}}<br>
                        Tlp. {{$item->user_address_tlp}}<br><br>
                        <div class="col-md-6">
                            <a class="btn btn-info btn-block" data-toggle="collapse" href="#edit{{$no}}" role="button" aria-expanded="false" aria-controls="edit"><b>Ubah</b></a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-primary btn-block" data-toggle="collapse" href="#edit{{$no}}" role="button" aria-expanded="false" aria-controls="edit"><b>Set to Default</b></a>
                        </div>
                        {!! Form::model($item, [
                            'method' => 'POST',
                            'url' => route('member.user.set_shipment_update'),
                            'class' => 'wizardForm',
                            'files' => false
                        ]) !!}
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
                                            <div class="form-group-sm {{ $errors->has('user_address_label') ? 'has-error' : ''}}">
                                                {!! Form::text('user_address_label', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Label', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_address_label', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_owner') ? 'has-error' : ''}}">
                                                {!! Form::text('user_address_owner', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Receiver', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_address_owner', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Telepon</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_phone') ? 'has-error' : ''}}">
                                                {!! Form::text('user_address_phone', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Phone', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_address_phone', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_tlp') ? 'has-error' : ''}}">
                                                {!! Form::text('user_address_tlp', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Telpon', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_address_tlp', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Province</th>
                                        <th>City</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_province') ? 'has-error' : ''}}">
                                                <select name='user_address_province' id='address_province' class="form-control" onchange="get_city(this.value);">
                                                    {{-- @foreach($province as $item)
                                                        <option value='{{$item['province_id']}}'>{{$item['province']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('user_address_province', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_city') ? 'has-error' : ''}}">
                                                <select name='user_address_city' id='address_city' class="form-control" onchange="get_subdistrict(this.value);">
                                                    {{-- @foreach($city as $item)
                                                        <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('user_address_city', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subdistrict</th>
                                        <th>Postal Code</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_subdist') ? 'has-error' : ''}}">
                                                <select name='user_address_subdist' id='address_subdist' class="form-control">
                                                    {{-- @foreach($subdistrict as $item)
                                                        <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                                                    @endforeach --}}
                                                </select>
                                                {!! $errors->first('user_address_subdist', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group-sm {{ $errors->has('user_address_pos') ? 'has-error' : ''}}">
                                                {!! Form::text('user_address_pos', null, [
                                                    'class' => 'form-control', 
                                                    'placeholder' => 'Postal Code', 
                                                    'required'
                                                ])!!}
                                                {!! $errors->first('user_address_pos', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">Alamat</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group-sm">
                                                    {!! Form::textarea('user_address_address', null, [
                                                      'class' => 'form-control', 
                                                      'placeholder' => 'Address...', 
                                                    ])!!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
                                   
        
                                        
                                           

                                