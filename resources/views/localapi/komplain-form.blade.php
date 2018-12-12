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
				        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('komplain_komplain_id') ? 'has-error' : ''}}">
				            {!! Form::label('komplain_komplain_id', 'Choose Komplain : ', ['class' => 'col-md-12 control-label']) !!}
				            <div class="col-md-12">
				                <div class="" data-toggle="buttons">
				                	@foreach($komplain as $item)
					                    <label class="btn btn-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}} btn-block colapse-btn">
					                        <input type="radio" name="komplain_komplain_id" value="{{$item->id}}" autocomplete="off">
					                        {{$item->komplain_name}} <span class="check glyphicon glyphicon-ok"></span>
					                    </label>
				                	@endforeach
				                </div>
					            {!! $errors->first('komplain_komplain_id', '<p class="help-block">:message</p>') !!}
				            </div>
				        </div>
			        	<div id="solusi" class="col-md-12 collapse">
                            <table class="table table-bordered table-striped table-highlight m-t-xs">
                                <thead>
                                    <tr>
                                        <th>Pilih Solusi</th>
                                        <th width="200">Dana yang ingin diminta kembali dari penjual</th>
                                    </tr>
                                </thead>
                                <tbody id="grosir_row">
                                    <tr>
                                        <td style="width: 70%">
									        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('komplain_komplain_id') ? 'has-error' : ''}}">
									            <div class="col-md-12">
									                <div class="" data-toggle="buttons">
									                	@foreach($solusi as $item)
										                    <label class="btn btn-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}} btn-block">
										                        <input type="radio" name="komplain_komplain_id" value="{{$item->id}}" autocomplete="off">
										                        {{$item->solusi_name}} <span class="check glyphicon glyphicon-ok"></span>
										                    </label>
									                	@endforeach
									                </div>
										            {!! $errors->first('komplain_komplain_id', '<p class="help-block">:message</p>') !!}
									            </div>
									        </div>
                                        </td>
                                        <td style="width: 30%">
                                            <input class="form-control" type="number" name="produk_grosir_price[]" >
                                            <i class='btn-block bg-danger m-t-xs'>Sisanya akan masuk ke saldo penjual</i>
                                            <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
				            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var rows, row;
		$(".colapse-btn").click(function(){
			$("#solusi").hide();
			$("#solusi").slideDown();
		});
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
</script>