@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Atur Kurir</h3>
                    </div>
                    <div class="panel-body">
                    </div>
                    <div id="main-wrapper">                      
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Pilih Kurir</h4>
                                    </div>
                                    <form class="form-horizontal">
                                    <div class="form-group">
                                            <label class="col-sm-2 control-label">Pilih Pengiriman :</label>
                                            <div class="col-sm-10">                                                
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" checked>JNE
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" checked>TIKI
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" checked>POS
                                                    </label>
                                                </div>      
                                            </div>
                                        </div>                                        
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- Row -->
                        <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active fade in" id="tab1">
                                            <div class="row m-b-lg">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputEmail">Layanan Kurir Anda : JNE, TIKI, POS</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
@endsection
                                   
        
                                        
                                           

                                