@extends('admin.index')
@section('content')


<div class="page-inner">
  <div class="page-title">
      <h3 class="breadcrumb-header">Manage Iklan Paket Order Saldo</h3>
  </div>
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
            <p><center>SETTING KURS CAKRA POIN / Rp</center></p>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="form-group">
                            <div class="col-md-5">
                              <label for="exampleInputEmail1">Cakra Poin</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="col-md-5">
                              <label for="exampleInputEmail1">/ Rupiah</label>
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="col-sm-2">
                              <label for="exampleInputEmail1"></label>
                              <button type="submit" class="btn btn-danger btn-xs">Update</button>
                          </div>
                      </div>
                  </form>
                  <p style="font-size: 80%">*) Contoh : Cakra Poin 1 , Rp 1.000 Rupiah <br/> - Setiap pembelian 1000 Rupiah mendapatkan 1 Cakra Poin</p>
              </div>
          </div>
      </div>
  </div><!-- Row -->
  <div class="row">
        @include('layouts._flash')
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
            <p><center>SETTING BONUS CAKRA (%)</center></p>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="form-group">
                            <div class="col-md-10">
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-danger btn-xs">Update</button>
                          </div>
                      </div>
                  </form>
                  <p style="font-size: 80%">*) Contoh : Isikan angka 5 untuk setting 5% <br/>
                  - Setiap pembeli/ penjual membeli Saldo iklan maka akan mendapatkan tambahan cakra poin sebanyak 5% dari cakra yang seharusnya didapat.</p>

              </div>
          </div>
      </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-6">
          <div class="panel panel-white">
            <div class="panel-heading clearfix">
            </div>
            <p><center>SETTING DISKON (dalam %)</center></p>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
                    {{ csrf_field() }}
                      <div class="form-group">
                          <div class="form-group">
                            <div class="col-md-10">
                              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <div class="col-sm-2">
                              <button type="submit" class="btn btn-danger btn-xs">Update</button>
                          </div>
                      </div>
                  </form>
                  <p style="font-size: 80%">*) Contoh : Isikan angka 15 untuk setting 15% <br/>
                  *) Diskon berlaku dengan ketentuan <br/>
                  - pembeli/penjual pernah melakukan transfer pembelian saldo dengan tagihan minimal Rp. 500.000,- <br/>
                  - pembeli/penjual pernah melakukan transfer pembelian saldo dengan akumulasi tagihan mencapai Rp.  <br/>1.500.000,- </p>
              </div>
          </div>
      </div>
  </div><!-- Row -->
  <div class="row">
    @include('layouts._flash')
    <div class="col-md-6">
      <div class="panel panel-white">
        <div class="panel-heading clearfix">
        </div>
        <p><center>SETTING PROFIT SPONSOR (dalam %)</center></p>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" action= "" enctype = "multipart/form-data">
              {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-group">
                      <div class="col-md-10">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-danger btn-xs">Update</button>
                    </div>
                </div>
            </form>
            <p style="font-size: 80%">*) Contoh : Isikan angka 5 untuk setting 5% <br/>
                  - Setiap pembeli/penjual membeli iklan maka sponsor akan mendapat 5%. </p>
          </div>
      </div>
    </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->
<div id="main-wrapper">
  <div class="row">
    @include('layouts._flash')
    <div class="col-md-12">
      <div class="panel panel-white">
        <div class="panel-heading clearfix">
          <a href="{{route('admin.konfigurasi.tambah_hargabeli')}}"><button type="" class="btn btn-danger pull-left" style="margin-bottom: 3%">Tambah Pilihan Order Saldo</button></a>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                          <th><center>Id</center></th>
                          <th><center>Nama</center></th>
                          <th><center>Harga</center></th>
                          <th><center>Action</center></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div><!-- Row -->
</div><!-- Main Wrapper -->

</div>

@endsection