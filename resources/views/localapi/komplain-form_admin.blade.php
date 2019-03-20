<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Komplain</h4>
        </div>
        {!! Form::open(['url' => url('/admin/res_kom/store_komplain'), 'method' => 'POST', 'files' => true]) !!}
        @csrf
            <input type="hidden" name="id" value="{{$trans->id}}"/>
        
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('komplain_komplain_id') ? 'has-error' : ''}}">
                            {!! Form::label('komplain_komplain_id', 'Choose Komplain : ', ['class' => 'col-md-12 control-label']) !!}
                            <div class="col-md-12">
                                <div class="" data-toggle="buttons">
                                    @foreach($komplain as $item)
                                        <label class="btn btn-danger btn-block colapse-btn">
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
                                        <!-- <th width="200">Dana yang ingin diminta kembali dari penjual - Foto Bukti</th> -->
                                        <th width="200">Foto Bukti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 70%">
                                            <div class="form-group mx-sm-3 mb-2 {{ $errors->has('solusi_solusi_id') ? 'has-error' : ''}}">
                                                <div class="col-md-12">
                                                    <div id="solusi_box" class="" data-toggle="buttons">
                                                        @foreach($solusi as $item)
                                                            <label class="btn btn-info btn-block">
                                                                <input type="radio" name="solusi_solusi_id" value="{{$item->id}}" autocomplete="off">
                                                                {{$item->solusi_name}} <span class="check glyphicon glyphicon-ok"></span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                    {!! $errors->first('solusi_solusi_id', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 30%">
                                            <input class="form-control hidden" type="number" name="solusi_value" value="0">
                                            {{-- <i class='btn-block bg-danger m-t-xs'>Sisanya akan masuk ke saldo penjual</i> --}}
                                            {{-- <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i> --}}
                                            <hr/>
                                            <input class="form-control" type="file" name="komplain_pic_image" >
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
            get_solusi(this);
            $("#solusi").hide();
            $("#solusi").slideDown();
        });
    });
    function get_solusi(e){
        var val = $(e).children("input").val();
        $.ajax({
            type: "GET", // or post?
            url: "{{url("localapi/content/get_solusi")}}/"+val, // change as needed
            beforeSend: function(){
                rows = '<label class="btn btn-info btn-block">'+
                        '<input type="radio" name="solusi_solusi_id" value="{{$item->id}}" autocomplete="off">'+
                        '{{$item->solusi_name}} <span class="check glyphicon glyphicon-ok"></span>'+
                    '</label>';
                $('#solusi_box').empty();
                $('#solusi_box').html(rows);
            },
            success: function(data) {
                if (data) {
                    $('#solusi_box').empty();
                    $.each( data, function(i, o){
                        row = '<label class="btn btn-info btn-block">'+
                                '<input type="radio" name="solusi_solusi_id" value="'+o.id+'" autocomplete="off">'+
                                o.solusi_name+'<span class="check glyphicon glyphicon-ok"></span>'+
                            '</label>';
                        $('#solusi_box').append(row);
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
            }
        });
    }
</script>