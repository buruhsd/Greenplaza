@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Laporan Transaksi</h3>
            </div>
                <form action="#" method="GET">
                    <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                        <div class="input-group pull-left" style="width: 225px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search" name="search" value="" autocomplete="off" id="search_table_currency">
                        </div>
                      </div> 
                </form>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Pencarian</h4>
                                </div>
                                
                                <form class="form-inline">
                                  <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">Tanggal</label>
                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Tanggal Checkout">
                                  </div>
                                  <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">Mulai</label>
                                    <input type="text" class="form-control input-tanggal" id="inputPassword2" placeholder="Mulai">
                                  </div>
                                  <div class="form-group mx-sm-3 mb-2">
                                    <label for="inputPassword2" class="sr-only">Sampai dengan:</label>
                                    <input type="text" class="form-control input-tanggal" id="inputPassword2" placeholder="Sampai dengan">
                                  </div>
                                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </form>
                                        
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Laporan Transaksi</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                    <th>Table heading</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                    <td>Table cell</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div><!-- Row -->
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('.input-tanggal').datepicker();       
                    });
                </script>
                
@endsection
        