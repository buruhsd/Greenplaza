@extends('member.index')
@section('content')
                <!-- Page Inner -->
                <div class="page-inner no-page-title">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">User Profile</h4>
                                </div>
                                <div class="panel-body user-profile-panel">
                                    <img src="http://via.placeholder.com/100x100" class="user-profile-image img-circle" alt="">
                                    <h4 class="text-center m-t-lg">john doe</h4>
                                    <p class="text-center">UI/UX Designer</p>
                                    <hr>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Pengaturan Profil</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Nama Toko</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Nama Seller</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Paket Seller 1</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Jenis Seller 1</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Nickname</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                                <p class="help-block">Nickname digunakan saat transaksi, misal register penjual atau transfer saldo.</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Link Etalase</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                                <p class="help-block">Link etalase terdiri dari satu kata atau tidak boleh menggunakan spasi.</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Slogan Toko</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">No Handphone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Pin BB</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Website</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="panel-heading clearfix">
                                            <h4 class="panel-title">Bank</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Nama Bank</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Nama Pemilik Rekening</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">No. Rekening</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-Default" class="col-sm-2 control-label">Cabang</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-Default">
                                            </div>
                                        </div>
                                        <button class="btn btn-info btn-block">Edit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div><!-- /Page Content -->
@endsection
        