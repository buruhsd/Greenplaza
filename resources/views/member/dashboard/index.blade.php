@extends('member.index')
@section('content')
               <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Dashboard</h3>
                    </div>
                    <div class="panel-body">
                    <div class="pull-right">
                        <p class="stats-info">Total Transaksi :
                        <span class="stats-number">$781,876</span></p>
                        <p class="stats-info">Grade Toko :
                        <span class="stats-number">$781,876</span></p>
                        </div>
                    </div>
                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">
                                                <?php $chart = (Session::has('chart'))
                                                    ?FunctionLib::number_to_text(FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total'))
                                                    :'0';?>
                                                Rp. {{$chart}}
                                            </span>
                                            <p class="stats-info">Keranjang</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans(1, Auth::id())}}</span>
                                            <p class="stats-info">Pesanan</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans(2, Auth::id())}}</span>
                                            <p class="stats-info">Transfer</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans(4, Auth::id())}}</span>
                                            <p class="stats-info">Pengepakan</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans(5, Auth::id())}}</span>
                                            <p class="stats-info">Pengiriman</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans(6, Auth::id())}}</span>
                                            <p class="stats-info">Barang Sampai</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans("7,8", Auth::id())}}</span>
                                            <p class="stats-info">Penarikan</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">Rp. {{FunctionLib::sum_trans("1,2,3,4,5,6,7,8", Auth::id())}}</span>
                                            <p class="stats-info">Total Transaksi</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                       
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Pencarian</h4>
                                </div>
                                <!-- Search form -->
                                <form>
                                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Penjualan</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive invoice-table">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">No</th>
                                                        <td>Kode Order</td>
                                                        <td>Nama Pembeli</td>
                                                        <td>Tanggal Beli</span></td>
                                                        <td>Detail</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">0186</th>
                                                        <td>contoh</td>
                                                        <td>isi</td>
                                                        <td>lo</span></td>
                                                        <td>wkwkwkwkwk</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- Main Wrapper -->
@endsection
        