@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Ubah Biodata</h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Ubah Biodata</h4>
                                </div>
                                <div class="panel-body">
                                    <form id="wizardForm">
                                            <div class="tab-content">
                                                <div class="tab-pane active fade in" id="tab1">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="exampleInputEmail">Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="exampleInputName" id="exampleInputName" placeholder="Nama Lengkap">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleInputName">Jenis Kelamin</label>
                                                                    <select class="form-control" id="sel1">
                                                                    <option>Laki - Laki</option>
                                                                    <option>Perempuan</option>
                                                                  </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="exampleInputName">Email</label>
                                                                    <input type="text" class="form-control" name="exampleInputName" id="exampleInputName" placeholder="Email">
                                                                </div>
                                                                <div class="form-group  col-md-4">
                                                                    <label for="exampleInputName2">No HP</label>
                                                                    <input type="text" class="form-control col-md-6" name="exampleInputName2" id="exampleInputName2" placeholder="No HP" >
                                                                </div>
                                                                <div class="form-group  col-md-4">
                                                                    <label for="exampleInputName2">Telp / Rumah</label>
                                                                    <input type="text" class="form-control col-md-6" name="exampleInputName2" id="exampleInputName2" placeholder="Telp/Rumah" >
                                                                </div>
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
@endsection
                                   
        
                                        
                                           

                                