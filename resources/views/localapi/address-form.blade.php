<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Add Address</h4>
        </div>
        {!! Form::open(['url' => url('member/address/store'), 'method' => 'POST', 'id' => 'addaddress']) !!}
        @csrf
        
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            {!! Form::label('address_label', 'Label') !!}
                            <div class="form-group {{ $errors->has('address_label') ? 'has-error' : ''}}">
                                {!! Form::text('address_label', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Label', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_label', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('address_owner', 'Receiver') !!}
                            <div class="form-group {{ $errors->has('address_owner') ? 'has-error' : ''}}">
                                {!! Form::text('address_owner', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Receiver', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('address_phone', 'Phone') !!}
                            <div class="form-group {{ $errors->has('address_phone') ? 'has-error' : ''}}">
                                {!! Form::text('address_phone', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Phone', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            {!! Form::label('address_tlp', 'Telepon') !!}
                            <div class="form-group {{ $errors->has('address_tlp') ? 'has-error' : ''}}">
                                {!! Form::text('address_tlp', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Telepon', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('address_province', 'Provice') !!}
                            <div class="form-group {{ $errors->has('address_province') ? 'has-error' : ''}}">
                                <select name='address_province' id='address_province' class="form-control" onchange="get_city(this.value);">
                                    {{-- @foreach($province as $item)
                                        <option value='{{$item['province_id']}}'>{{$item['province']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('address_city', 'City') !!}
                            <div class="form-group {{ $errors->has('address_city') ? 'has-error' : ''}}">
                                <select name='address_city' id='address_city' class="form-control" onchange="get_subdistrict(this.value);">
                                    {{-- @foreach($city as $item)
                                        <option value='{{$item['city_id']}}'>{{$item['city_name']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('address_subdist', 'Subdistrict') !!}
                            <div class="form-group {{ $errors->has('address_subdist') ? 'has-error' : ''}}">
                                <select name='address_subdist' id='address_subdist' class="form-control">
                                    {{-- @foreach($subdistrict as $item)
                                        <option value='{{$item['subdistrict_name']}}'>{{$item['subdistrict_name']}}</option>
                                    @endforeach --}}
                                </select>
                                {!! $errors->first('address_subdist', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            {!! Form::label('address_pos', 'Postal Code') !!}
                            <div class="form-group {{ $errors->has('address_pos') ? 'has-error' : ''}}">
                                {!! Form::text('address_pos', null, [
                                    'class' => 'form-control', 
                                    'placeholder' => 'Postal Code', 
                                    'required'
                                ])!!}
                                {!! $errors->first('address_owner', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <label>Address</label>
                            <div class="form-group">
                                <textarea class="form-control" id="address_address" name="address_address" placeholder="Address..."></textarea>
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
            url: "{{route("localapi.content.get_province", 0)}}", // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_province').empty();
                $('#address_province').html(rows);
            },
            success: function(data) {
                if (data) {
                    $('#address_province').empty();
                    $.each( data.province, function(i, o){
                        row = "<option value="+o.province_id+">"+o.province+"</option>";
                        $('#address_province').append(row);
                        if(i == 0){
                            get_city(o.province_id);
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
            url: "{{url("localapi/content/get_city")}}/"+id, // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_city').empty();
                $('#address_city').html(rows);
            },
            success: function(data) {
                if (data) {
                    $('#address_city').empty();
                    $.each( data.city, function(i, o){
                        row = "<option value="+o.city_id+">"+o.city_name+"</option>";
                        $('#address_city').append(row);
                        if(i == 0){
                            get_subdistrict(o.city_id);
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
            url: "{{url("localapi/content/get_subdistrict")}}/"+id, // change as needed
            beforeSend: function(){
                rows = "<option>Loading...</option>";
                $('#address_subdist').empty();
                $('#address_subdist').html(rows);
            },
            success: function(data) {
                if (data) {
                    $('#address_subdist').empty();
                    $.each( data, function(i, o){
                        row = "<option value="+o.subdistrict_id+">"+o.subdistrict_name+"</option>";
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