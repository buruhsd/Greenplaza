@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Beli Saldo Iklan </h3>
                    </div>
                    <div class="panel panel-white">
                                <div class="panel-body">
                                <form id="wizardForm">
                                            <div class="tab-content">
                                                <div class="tab-pane active fade in" id="tab1">
                                                    <div class="row m-b-lg">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="exampleInputEmail">Pilih Paket</label>
                                                                    <select class="form-control" id="sel1">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                  </select>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="exampleInputPassword1">Keterangan</label>
                                                                    <textarea class="form-control" placeholder="Keterangan" rows="4"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3>Info</h3>
                                                            <p>Harga iklan saat : .<br>
                                                            Iklan Baris : <br>
                                                            Iklan Banner : <br>

                                                            <p>Diskon 15% untuk pembelian saldo minimal Rp 500.000,00, atau setelah akumulasi pembelian mencapai Rp 1.500.000,00 (* </p><br>

                                                            <p>Dapatkan bonus cakra point yang dapat digunakan untuk bermain di cakragames. Menangkan hadiah-hadiah menarik dari CAKRAGAMES. Nilai bonus saat ini adalah Rp 2.000,00 mendapatkan 1 Cakra Point.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <button type="submit" class="btn btn-primary">Beli</button>
                                        </form>
                        </div>
                    </div>
@endsection
                                   
        
                                        
                                           

                                