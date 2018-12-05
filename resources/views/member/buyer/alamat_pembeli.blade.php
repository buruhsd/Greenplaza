@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Daftar Alamat</h3>
                    </div>
                    <div class="panel-body">
                    </div>
                        <div class="panel panel-white">
                            <a href="#" class="btn btn-default " data-toggle="modal" data-target="#myModal">Tambah Alamat Baru</a>
                        </div>
                    <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Kantor</h4>
                                </div>  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-body">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Teman</h4>
                                </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Ubah Alamat</h4>
                            </div>
                            <div class="modal-body">
                              <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
@endsection
                                   
        
                                        
                                           

                                