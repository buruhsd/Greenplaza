@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Beli Poin Hot List </h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-body">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Saldo Hot List Anda : nominal e hehe</h4>
                                </div>
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Kurs Hot List Saat Ini : nominal e hehe</h4>
                                </div>
                                    <form id="wizardForm">
                                        <div class="tab-content">
                                            <div class="tab-pane active fade in" id="tab1">
                                                <div class="row m-b-lg">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail">Paket Hot List</label>
                                                                <select class="form-control" id="sel1">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail">Password Transaksi</label>
                                                                <input type="password" class="form-control col-md-6" name="Password" id="exampleInputName2" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Beli</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
                                   
        
                                        
                                           

                                