@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Upload Foto SIUP \ TDP </h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Foto SIUP</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="wizardForm">
                                        <div class="tab-content">
                                            <div class="tab-pane active fade in" id="tab1">
                                                <div class="row m-b-lg">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail">Pilih Foto SIUP / TDP</label>
                                                                <input type="file" class="form-control col-md-6" name="exampleInputName2" id="exampleInputName2" >
                                                                <p class="help-block">Max Size = 200 kb, Max. Dimension = 1000 px x 1000 px.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
                                   
        
                                        
                                           

                                