@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Dashboard</h3>
            </div>
                <!-- <form action="#" method="GET">
                    <div class="panel-heading clearfix" style="margin-bottom: 10px;">
                        <div class="input-group pull-left" style="width: 225px;">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search" name="search" value="" autocomplete="off" id="search_table_currency">
                        </div>
                      </div> 
                </form> -->
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Seller</h4>
                                </div>
                                <center><p>Transaksi Detail</p></center>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($detailsellerorder->count() > 0)
                                            <li>Order<span class="label label-default pull-right">{{$detailsellerorder->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Order<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($detailsellertransfer->count() > 0)
                                            <li>Transfer<span class="label label-default pull-right">{{$detailsellertransfer->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Transfer<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($detailsellerseller->count() > 0)
                                            <li>Seller<span class="label label-success pull-right">{{$detailsellerseller->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Seller<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($detailsellerpacking->count() > 0)
                                            <li>Packing<span class="label label-success pull-right">{{$detailsellerpacking->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Packing<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($detailsellershipping->count() > 0)
                                            <li>Shipping<span class="label label-danger pull-right">{{$detailsellershipping->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Shipping<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($detailsellerdropping->count() > 0)
                                            <li>Dropping<span class="label label-danger pull-right">{{$detailsellerdropping->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Dropping<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardseller')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Detail</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($hotsellerbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$hotsellerbaru->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerkonf->count() > 0)
                                            <li>Konfirmasi<span class="label label-danger pull-right">{{$hotsellerkonf->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$hotsellerbatal->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$hotsellerapprove->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$hotsellerditolak->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardseller')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Member</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                            <li>Belum Approve<span class="label label-default pull-right">85%</span></li>
                                            <li>Approve<span class="label label-success pull-right">Finished</span></li>
                                            <li>Block<span class="label label-danger pull-right">Rejected</span></li>
                                        </ul>
                                    </div>
                                    <a href="#"><span class="label label-danger pull-right" style="margin-top:200px">Read More</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Transaksi Barang</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                            <li>Cart<span class="label label-default pull-right">{{FunctionLib::count_trans(0)}}</span></li>
                                            <li>Order<span class="label label-success pull-right">{{FunctionLib::count_trans(1)}}</span></li>
                                            <li>Transfer<span class="label label-success pull-right">{{FunctionLib::count_trans(2)}}</span></li>
                                            <li>Seller Tunggu<span class="label label-danger pull-right">{{FunctionLib::count_trans(3)}}</span></li>
                                            <li>Seller Batal<span class="label label-default pull-right">{{FunctionLib::count_trans(4)}}</span></li>
                                            <li>Packing<span class="label label-default pull-right">{{FunctionLib::count_trans(5)}}</span></li>
                                            <li>Shipping<span class="label label-default pull-right">{{FunctionLib::count_trans(6)}}</span></li>
                                            <li>Dropping<span class="label label-default pull-right">{{FunctionLib::count_trans(7)}}</span></li>
                                        </ul>
                                    </div>
                                    <a href="#"><span class="label label-danger pull-right" style="margin-top:65px">Read More</span></a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                
@endsection
        