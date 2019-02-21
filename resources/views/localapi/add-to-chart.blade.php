<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Tambahkan ke Chart</h4>
        </div>
        {!! Form::open(['url' => route('addchart', $detail->id), 'method' => 'POST', 'id' => 'form-chart']) !!}
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        @csrf
                        @guest
                            <div class="col-md-12" style="margin-bottom: 2%">
                                <center>
                                    <li class="col-12">
                                        <input type="button" onclick='modal_get2($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.login")}} value="Login" class="btn btn-info btn-sm col-12" id="btn-pick-address" />
                                    </li>
                                </center>
                            </div>
                        @else
                            <input type="text" name="address_id" id="address_id" value="{{Auth::user()->user_address()->first()['id']}}" hidden/>
                            <input type="text" name="ship_service" id="ship_service" value="none" hidden/>
                            <input type="text" name="ship_cost" id="ship_cost" value="0" hidden/>
                            <input type="text" name="origin" id="origin" value="{{$detail->user->user_address()->first()['user_address_subdist']}}" hidden/>
                            <input type="text" name="originType" id="originType" value="subdistrict" hidden/>
                            <input type="text" name="destination" id="destination" value="{{Auth::user()->user_address()->first()['user_address_subdist']}}" hidden/>
                            <input type="text" name="destinationType" id="destinationType" value="subdistrict" hidden/>
                            <input type="text" name="weight" value="{{$detail->produk_weight}}" hidden/>
                            <input type="text" name="lenght" value="{{$detail->produk_length}}" hidden/>
                            <input type="text" name="width" value="{{$detail->produk_wide}}" hidden/>

                            <div class="col-12 col-md-12">
                                {!! Form::label('address_label', 'Qty') !!}
                                <div class="form-group {{ $errors->has('address_label') ? 'has-error' : ''}}">
                                    {!! Form::text('qty', 1, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Label', 
                                        'id' => 'qty', 
                                        'required'
                                    ])!!}
                                    {!! $errors->first('address_label', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <input type="button" onclick='modal_get2($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.pickaddress", ['id' => Auth::id()])}} value="Choose Address" class="btn btn-success btn-block" id="btn-pick-address" />
                            </div>
                            <div class="col-md-12" id="address-info" style="margin-bottom: 2%">
                                <b>To Address : {{Auth::user()->user_address()->first()['user_address_label']}}</b>
                            </div>
                            <div class="col-md-12">
                                <select name="courier" id="courier" class="form-control">
                                    @foreach($shipment_type as $item)
                                        <option value="{{ strtolower($item->shipment_name) }}">{{$item->shipment_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12" id="shipment-price" style="margin-bottom: 2%">
                            </div>
                            <div class="col-md-12" id="ship-cost" style="margin-bottom: 2%">
                            </div>
                            <div class="col-md-12" style="margin-bottom: 2%">
                                <input type="button" href="#" onclick='get_ongkir()' class="btn btn-success btn-sm col-12" value="Choose Shipment" id="btn-choose-shipment" />
                            </div>
                            {{-- color and size --}}
                            <?php $size = explode(',', $detail->produk_size);?>
                            <?php 
                                $color_arr = [
                                        'blue' => '#007bff',
                                        'orange' => '#ffc107',
                                        'red' => '#dc3545',
                                        'green' => '#28a745',
                                        'white' => '#ffffff',
                                    ];
                                $color_arr = [
                                        'blue' => 'primary',
                                        'orange' => 'warning',
                                        'red' => 'danger',
                                        'green' => 'success',
                                        'white' => 'default',
                                    ];
                                $color = explode(',', $detail->produk_color);
                            ?>
                            <div class="col-md-6 {{ $errors->has('size') ? 'has-error' : ''}}">
                                {!! Form::label('size', 'Size : ', ['class' => 'col-md-12 control-label']) !!}
                                <div class="col-md-12">
                                    <div class="" data-toggle="buttons">
                                        @foreach($size as $item)
                                            @if ($loop->first)
                                                <label class="border1 btn btn-default active">
                                                    <input type="radio" name="size" value="{{$item}}" autocomplete="off" checked>
                                                    {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                            @else
                                                <label class="border1 btn btn-default">
                                                    <input type="radio" name="size" value="{{$item}}" autocomplete="off">
                                                    {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 {{ $errors->has('color') ? 'has-error' : ''}}">
                                {!! Form::label('color', 'Color : ', ['class' => 'col-md-12 control-label']) !!}
                                <div class="col-md-12">
                                    <div class="" data-toggle="buttons">
                                        @foreach($color as $item)
                                            @if ($loop->first)
                                                <label class="border1 btn btn-default active" style="background-color: {!! $item !!}">
                                                    <input type="radio" name="color" value="{{$item}}" autocomplete="off" checked >
                                                    <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                            @else
                                                <label class="border1 btn btn-default" style="background-color: {!! $item !!}">
                                                    <input type="radio" name="color" value="{{$item}}" autocomplete="off">
                                                    <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
            @guest
            @else
                <input type="submit" onclick="$('#form-chart').submit();" class="btn btn-success" value="Tambah ke Keranjang">
            @endguest
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div id="ajax-modal2" class="modal" tabindex="-1" style="display: none;"></div>
<script type="text/javascript">
    function get_ongkir(){
        console.log($("#form-chart").serialize());
        var text = $("#btn-choose-shipment").val();
        $("#btn-choose-shipment").val("Loading");
        $.ajax({
            type: "POST", // or post?
            url: "{{route("localapi.content.choose_shipment", $detail->id)}}", // change as needed
            data: $("#form-chart").serialize(), // change as needed
            success: function(data) {
                if (data) {
                    $('#shipment-price').empty().append(data);
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
                $("#btn-choose-shipment").val(text);
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
    function change_ongkir(service, ongkir){
        var html = "<ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-12 col-sm-12 col-md-12'><b>Shipping : "+service+"</b></div></ul>";
        html += "<ul><div class='col-lg-12 col-sm-12 col-md-12'><b>Shipping Cost : "+ongkir+"</b></div></ul>";
        $("#shipment-price").empty();
        $("#ship-cost").empty().append(html);
        $('#ship_service').attr('value', ongkir);
        $('#ship_cost').attr('value', ongkir);
        console.log(service, ongkir);
    }
    function use_address(id, address_name, city, subdistrict){
        console.log(city, subdistrict);
        $('#address_id').attr('value', id);
        $('#address_id').attr('value', id);
        $('#destinationType').attr('value', 'subdistrict');
        $('#destination').attr('value', subdistrict);
        var html = "<ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-12 col-sm-12 col-md-12'><b>To Address : "+address_name+"</b></div></ul>";
        $("#address-info").empty().append(html);
        empty_ongkir();
    }
    function empty_ongkir(){
        $("#ship-cost").empty();
        $('#ship_cost').attr('value', 0);
    }
    function changed(){
            console.log('tes2');
        $('#qty').on('change', function(){
            console.log('tes3');
            empty_ongkir();
        });
        $('#courier').on('change', function(){
            console.log('tes4');
            empty_ongkir();
        });
    }
    changed();
    function modal_get2(e){
        $.ajax({
            type: e.data('method'), // or post?
            url: e.data('href'), // change as needed
            success: function(data) {
                if (data) {
                    if(typeof data.status !== 'undefined' && data.status == 500){
                        swal({   
                            type: "error",
                            title: "failed",   
                            text: data.message,   
                            showConfirmButton: false ,
                            showCloseButton: true,
                            footer: ''
                        });
                    }else{
                        $('#ajax-modal2').empty().append(data).modal();
                    }
                } else {
                    alert(data);
                }
            },
            error: function(xhr, textStatus) {
                alert(xhr.status+'\n'+textStatus);
            }
        });
    }
</script>
