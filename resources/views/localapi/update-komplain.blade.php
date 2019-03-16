<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title">Komplain</h4>
        </div>
        {!! Form::open(['url' => url('member/komplain/update_komplain/'.$komplain->id), 'method' => 'POST', 'files' => true]) !!}
        @csrf
        
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div id="solusi" class="col-md-12 collapse">
                            <table class="table table-bordered table-striped table-highlight m-t-xs">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pilih Solusi</th>
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
                                                        @foreach($solusi_type as $item)
                                                            <?php 
                                                                $check = ($komplain->solusi->solusi_solusi_id == $item->id)?"active":"";
                                                                $check2 = ($komplain->solusi->solusi_solusi_id == $item->id)?"checked":"";
                                                             ?>
                                                            <label class="btn btn-info btn-block {{$check}}">
                                                                <input type="radio" name="solusi_solusi_id" value="{{$item->id}}" autocomplete="off" {{$check2}}>
                                                                {{$item->solusi_name}} <span class="check glyphicon glyphicon-ok"></span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                    {!! $errors->first('solusi_solusi_id', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 30%">
                                            <input class="form-control hidden" type="number" name="solusi_value" value="{{$komplain->solusi->solusi_value}}">
                                            <img class="h100" src="{{asset('assets/images/komplain_pic/'.$komplain->pic->komplain_pic_image)}}">
                                            <!-- <i class='btn-block bg-danger m-t-xs'>Sisanya akan masuk ke saldo penjual</i> -->
                                            <!-- <i class='btn-block bg-danger m-t-xs'>Harus berupa angka</i> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @if(isset($type) && $type == 'buyer')
                                                <i class='btn-block bg-danger m-t-xs'>Gambar Bukti</i>
                                                <input class="form-control" type="file" name="komplain_pic_image" >
                                            @endif
                                            {!!$komplain->solusi->solusi_note!!}
                                            <i class='btn-block bg-danger m-t-xs'>Diskusi solusi dengan Pembeli</i>
                                            {!! Form::textarea('solusi_note', null, [
                                              'class' => 'form-control', 
                                              'placeholder' => 'Note', 
                                              'required',
                                              'rows' => 3
                                            ])!!}
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
        // get_solusi();
        $("#solusi").hide();
        $("#solusi").slideDown();
    });
    function get_solusi(){
        $.ajax({
            type: "GET", // or post?
            url: "{{url('localapi/content/get_solusi')}}/"+"{{$komplain->komplain_komplain_id}}", // change as needed
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