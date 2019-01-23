<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">edit Address</h4>
        </div>
        {!! Form::model($user_address, ['url' => url('member/address/update/'.$user_address->id), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            {!! Form::label('user_address_label', 'Label') !!}
                            <div class="form-group {{ $errors->has('user_address_label') ? 'has-error' : ''}}">
                                {!! Form::text('user_address_label', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Label', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_label', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('user_address_owner', 'Receiver') !!}
                            <div class="form-group {{ $errors->has('user_address_owner') ? 'has-error' : ''}}">
                                {!! Form::text('user_address_owner', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Receiver', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('user_address_phone', 'Phone') !!}
                            <div class="form-group {{ $errors->has('user_address_phone') ? 'has-error' : ''}}">
                                {!! Form::text('user_address_phone', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Phone', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_phone', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('user_address_tlp', 'Telpon') !!}
                            <div class="form-group {{ $errors->has('user_address_tlp') ? 'has-error' : ''}}">
                                {!! Form::text('user_address_tlp', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Telpon', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_tlp', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('user_address_province', 'Provice') !!}
                            <div class="form-group {{ $errors->has('user_address_province') ? 'has-error' : ''}}">
                                <select name='user_address_province' id='address_province' class="form-control" onchange="get_city(this.value);">
                                    {{-- @foreach($province as $item)
                                        <option value='{{$item['province_id']}}'>{{$item['province']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('user_address_province', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('user_address_city', 'City') !!}
                            <div class="form-group {{ $errors->has('user_address_city') ? 'has-error' : ''}}">
                                <select name='user_address_city' id='address_city' class="form-control" onchange="get_subdistrict(this.value);">
                                    {{-- @foreach($city as $item)
                                        <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('user_address_city', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('user_address_subdist', 'Subdistrict') !!}
                            <div class="form-group {{ $errors->has('user_address_subdist') ? 'has-error' : ''}}">
                                <select name='user_address_subdist' id='address_subdist' class="form-control">
                                    {{-- @foreach($subdistrict as $item)
                                        <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('user_address_subdist', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('user_address_pos', 'Postal Code') !!}
                            <div class="form-group {{ $errors->has('user_address_pos') ? 'has-error' : ''}}">
                                {!! Form::text('user_address_pos', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Postal Code', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_pos', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <label>Address</label>
                            <div class="form-group">
                                {!! Form::textarea('user_address_address', null, [
                                    'class' => 'form-control', 
                                    'id' => 'user_address_address',
                                    'rows' => '3', 
                                    'placeholder' => 'Address...', 
                                    'required'
                                ])!!}
                                {!! $errors->first('user_address_pos', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" value="Close" onclick="$(this).closest('.modal').modal('hide')">
            <input type="submit" class="btn btn-success" value="Save">
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var rows, row;
        get_province();
    });
    function get_province(){
        $.ajax({
            type: "GET", // or post?
            url: "<?php echo url('localapi/content/get_db_province', 0);?>", // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_province').empty();
                $('#address_province').html(rows);
            },
            success: function(data) {
                var id = parseInt("<?php echo $user_address->user_address_province;?>");
                if (data) {
                    $('#address_province').empty();
                    $.each( data.province, function(i, o){
                        $check = (o.id == id)?"selected":"";
                        row = "<option value="+o.id+" "+$check+">"+
                            o.province_name+"</option>";
                        $('#address_province').append(row);
                        if(i == 0){
                            get_city(o.id);
                        }
                        if($check == "selected"){
                            get_city(id);
                        }
                    });
                } else {
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }
                // $("#btn-choose-shipment").val(text);
            },
            error: function(xhr, textStatus) {
                swal({
                    type: "error",
                    title: "failed",   
                    text: "Layanan Tidak Tersedia",   
                    showConfirmButton: false ,
                    showCloseButton: true,
                    footer: ''
                });
                $("#btn-choose-shipment").val(text);
            }
        });
    }
    function get_city(id = 0){
        $.ajax({
            type: "GET", // or post?
            url: "<?php echo url("localapi/content/get_db_city"); ?>/"+id, // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_city').empty();
                $('#address_city').html(rows);
            },
            success: function(data) {
                var id = parseInt("<?php echo $user_address->user_address_city;?>");
                if (data) {
                    $('#address_city').empty();
                    $.each( data.city, function(i, o){
                        $check = (o.id == id)?"selected":"";
                        row = "<option value="+o.id+" "+$check+">"+o.city_name+"</option>";
                        $('#address_city').append(row);
                        if(i == 0){
                            get_subdistrict(o.id);
                        }
                        if($check == "selected"){
                            get_subdistrict(id);
                        }
                    });
                } else {
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }
                // $("#btn-choose-shipment").val(text);
            },
            error: function(xhr, textStatus) {
                swal({
                    type: "error",
                    title: "failed",   
                    text: "Layanan Tidak Tersedia",   
                    showConfirmButton: false ,
                    showCloseButton: true,
                    footer: ''
                });
                $("#btn-choose-shipment").val(text);
            }
        });
    }
    function get_subdistrict(id){
        $.ajax({
            type: "GET", // or post?
            url: "<?php echo url("localapi/content/get_db_subdistrict");?>/"+id, // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_subdist').empty();
                $('#address_subdist').html(rows);
            },
            success: function(data) {
                var id = parseInt("<?php echo $user_address->user_address_subdist;?>");
                if (data) {
                    $('#address_subdist').empty();
                    $.each( data, function(i, o){
                        $check = (o.id == id)?"selected":"";
                        row = "<option value="+o.id+" "+$check+">"+o.subdistrict_name+"</option>";
                        $('#address_subdist').append(row);
                    });
                } else {
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }
                // $("#btn-choose-shipment").val(text);
            },
            error: function(xhr, textStatus) {
                swal({
                    type: "error",
                    title: "failed",   
                    text: "Layanan Tidak Tersedia",   
                    showConfirmButton: false ,
                    showCloseButton: true,
                    footer: ''
                });
                $("#btn-choose-shipment").val(text);
            }
        });
    }
</script>