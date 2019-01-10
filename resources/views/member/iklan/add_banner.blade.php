@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Post Iklan Baris </h3>
    </div>
    <div class="panel panel-white">
        <div class="panel-body">
            {!! Form::open(['url' => route('member.iklan.add_banner'), 'id' => 'wizardForm', 'files' => true]) !!}
                <div class="tab-content">
                    <div class="tab-pane active fade in" id="tab1">
                        <div class="row m-b-lg">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="iklan_category_id">Kategory</label>
                                        <select class="form-control" id="iklan_category_id" name="iklan_category_id">
                                            @foreach($category as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->category_name}} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <label for="is_link">Tambahkan link ke iklan baris?</label>
                                        <div class="col-md-12">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default linked">
                                                    <input type="radio" name="is_link" value="1" autocomplete="off">
                                                    Ya <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                                <label class="btn btn-default active linked">
                                                    <input type="radio" name="is_link" value="0" autocomplete="off" checked>
                                                    Tidak <span class="check glyphicon glyphicon-ok"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 link" style="display:none">
                                        <label for="iklan_link">Link</label>
                                        {!! Form::text('iklan_link', null, [
                                            'class' => 'form-control', 
                                            'placeholder' => 'Link', 
                                        ])!!}
                                        {!! $errors->first('iklan_link', '<p class="help-block">:message</p>') !!}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="parent-img col-md-12">
                                                <label for="user_detail_image">Upload foto profil</label>
                                                <div class="input-group image-preview">
                                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                            <span class="glyphicon glyphicon-remove"></span> Clear
                                                        </button>
                                                        <div class="btn btn-default image-preview-input">
                                                            <span class="glyphicon glyphicon-folder-open"></span>
                                                            <span class="image-preview-input-title">Browse</span>
                                                            <input type="file" class="input_file_preview" accept="image/png, image/jpeg, image/gif" name="iklan_image"/>
                                                        </div>
                                                    </span>
                                                </div>
                                                {!! $errors->first('user_detail_image', '<p class="help-block">:message</p>') !!}
                                                <p class="help-block">Max Size = 1000 kb, <br/>
                                                Max. Dimension = 1000 kb x 1000 kb.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Info</h3>
                                <p>Saldo Iklan anda saat ini : .<br>
                                Harga iklan saat : .<br>
                                Iklan Baris : <br>
                                Iklan Banner : <br>
                                Iklan Banner Khusus : <br>
                                Iklan Slider : <br></p>

                                <p>Diskon 15% untuk pembelian saldo minimal Rp 500.000,00, atau setelah akumulasi pembelian mencapai Rp 1.500.000,00 (* </p><br>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Beli</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $('.linked').click(function () {
        if ($(this).find('input').attr("value") == "1") {
            $(".link").show('slow');
        }
        if ($(this).find('input').attr("value") == "0") {
            $(".link").hide('slow');
            $('.link').find('input').val("");
        }
    });
</script>
@endsection
                                   
        
                                        
                                           

                                