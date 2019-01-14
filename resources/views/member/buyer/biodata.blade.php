@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Biodata</h3>
                    </div>
                    <div id="main-wrapper">
                        <div class="row">
                        <div class="col-md-9">
                        <div class="panel panel-white">
                            <a href="#" class="btn btn-default">Ubah Biodata</a>
                        </div>
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">User Profile</h4>
                                </div>
                                <div class="panel-body user-profile-panel">
                                    <img src="http://via.placeholder.com/100x100" class="user-profile-image img-circle" alt="">
                                    <h4 class="text-center m-t-lg">john doe</h4>
                                    <p class="text-center">UI/UX Designer</p>
                                    
                                    <button class="btn btn-info btn-block">Ubah Foto</button>
                                    <hr>
                                    <div class="panel panel-white">
                                    <ul class="list-unstyled ">
                                        <li><p><i class="fa fa-map-marker m-r-xs"></i>Melbourne, Australia <a href=""><span class="label label-danger">Tambah Alamat</span></a></p></li>
                                        <li><p><i class="fa fa-paper-plane-o m-r-xs"></i><a href="#">example@mail.com</a></p></li>
                                        <li><p><i class="fa fa-link m-r-xs"></i><a href="#">www.themeforest.net</a></p></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="panel panel-white">
                                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">Lihat KTP</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- Main Wrapper -->
                </div>
                <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">KTP Anda</h4>
                        </div>
                        <div class="modal-body">
                          <p>Isine Foto KTP.</p>
                        </div>
                        <div class="panel panel-white">
                                    <a href="#" class="btn btn-default" >Ubah Foto KTP</a>
                                </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                  
                </div>
@endsection
                                   
        
                                        
                                           

                                