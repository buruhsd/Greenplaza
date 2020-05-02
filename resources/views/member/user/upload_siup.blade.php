@extends('member.index')
@section('pengaturan profil', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Upload Foto SIUP \ TDP </h3>
</div>
<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Foto SIUP</h4>
    </div>
    <div class="panel-body">
        {!! Form::open([
            'method' => 'POST',
            'url' => ['/member/user/upload_siup_update'],
            'class' => 'wizardForm',
            'files' => true
        ]) !!}
            <div class="tab-content">
                <div class="tab-pane active fade in" id="tab1">
                    <div class="row m-b-lg">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="btn btn-default">
                                        <img src="{{asset('assets/images/siup/'.$user->user_detail->user_detail_siup_image)}}" alt="..." onerror="this.src='http://via.placeholder.com/100x100'" class="img-thumbnail img-check h100">
                                    </label>
                                </div>
                                <div class="parent-img col-md-6">
                                    <label for="user_detail_siup_image">Pilih Foto SIUP / TDP</label>
                                    <div class="input-group image-preview">
                                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <div class="btn btn-default image-preview-input">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title">Browse</span>
                                                <input type="file" class="input_file_preview" accept="image/png, image/jpeg, image/gif" name="user_detail_siup_image"/>
                                            </div>
                                        </span>
                                    </div>
                                    {!! $errors->first('user_detail_siup_image', '<p class="help-block">:message</p>') !!}
                                    <p class="help-block">Max {{__('dashboard.ukuran') }} = 1000 kb, Max. {{__('dashboard.dimension') }} = 1000 kb x 1000 kb.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection