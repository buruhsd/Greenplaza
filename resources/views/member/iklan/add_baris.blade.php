@extends('member.index')
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Post Iklan Baris </h3>
</div>
<div class="panel panel-white">
    <div class="panel-body">
        {!! Form::open(['url' => route('member.iklan.add_baris'), 'id' => 'wizardForm', 'files' => true]) !!}
            <div class="tab-content">
                <div class="tab-pane active fade in" id="tab1">
                    <div class="row m-b-lg">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="iklan_title">Judul (Maksimal 20 karakter) -- 20 karakter lagi</label>
                                    {!! Form::text('iklan_title', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => 'Judul', 
                                        'required'
                                    ])!!}
                                    {!! $errors->first('iklan_title', '<p class="help-block">:message</p>') !!}
                                </div>
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
                                <div class="form-group col-md-12">
                                    <label for="iklan_content">Konten (Maksimal 160 karakter) -- 160 karakter lagi</label>
                                    <textarea class="form-control" name="iklan_content" placeholder="Konten" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Info</h3>
                            <h4>Saldo Iklan Anda : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_saldo(4))}}</b></h4>
                            <p>Harga iklan saat : <br>
                            Iklan Baris : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_baris'))}}</b><br>
                            Iklan Banner : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_banner'))}}</b><br>
                            Iklan Banner Khusus : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_banner_khusus'))}}</b><br>
                            Iklan Slider : <b>Rp. {{FunctionLib::number_to_text(FunctionLib::get_config('price_iklan_slider'))}}</b><br></p>

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
                                   
        
                                        
                                           

                                