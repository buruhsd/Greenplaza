@extends('admin.index', ['active' => 'dashboard'])
@section('title', 'Dashboard')
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
                                    <a href="{{route('admin.dashboarddetail')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Hotlist</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($hotsellerbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$hotsellerbaru->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$hotsellerkonf->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$hotsellerbatal->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$hotsellerapprove->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotsellerditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$hotsellerditolak->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardhotlist')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Iklan</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($iklansellerbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$iklansellerbaru->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($iklansellerkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$iklansellerkonf->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($iklansellerbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$iklansellerbatal->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($iklansellerapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$iklansellerapprove->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($iklansellerditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$iklansellerditolak->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardiklan')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Pincode</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($pinsellerbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$pinsellerbaru->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($pinsellerkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$pinsellerkonf->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($pinsellerbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$pinsellerbatal->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($pinsellerapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$iklansellerapprove->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($pinsellerditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$pinsellerditolak->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardpincode')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Member</h4>
                                </div>
                                <center><p>Transaksi Detail</p></center>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($detailmemberorder->count() > 0)
                                            <li>Order<span class="label label-default pull-right">{{$detailmemberorder->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Order<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($detailmembertransfer->count() > 0)
                                            <li>Transfer<span class="label label-default pull-right">{{$detailmembertransfer->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Transfer<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($detailmemberseller->count() > 0)
                                            <li>Seller<span class="label label-success pull-right">{{$detailmemberseller->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Seller<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($detailmemberpacking->count() > 0)
                                            <li>Packing<span class="label label-success pull-right">{{$detailmemberpacking->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Packing<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($detailmembershipping->count() > 0)
                                            <li>Shipping<span class="label label-danger pull-right">{{$detailmembershipping->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Shipping<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($detailmemberdropping->count() > 0)
                                            <li>Dropping<span class="label label-danger pull-right">{{$detailmemberdropping->trans_detail_status->count()}}</span></li>
                                        @else
                                            <li>Dropping<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboarddetailmember')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Hotlist</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($hotmemberbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$hotmemberbaru->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($hotmemberkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$hotmemberkonf->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotmemberbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$hotmemberbatal->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($hotmemberapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$hotmemberapprove->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($hotmemberditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$hotmemberditolak->trans_hotlist_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardhotlistmember')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Iklan</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($iklanmemberbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$iklanmemberbaru->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($iklanmemberkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$iklanmemberkonf->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($iklanmemberbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$iklanmemberbatal->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($iklanmemberapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$iklanmemberapprove->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($iklanmemberditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$iklanmemberditolak->trans_iklan_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardiklanmember')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>

                                <center><p style="margin-top: 15%">Transaksi Pincode</p></center>
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                        @if ($pinmemberbaru->count() > 0)
                                            <li>Baru<span class="label label-default pull-right">{{$pinmemberbaru->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Baru<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        @if ($pinmemberkonf->count() > 0)
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">{{$pinmemberkonf->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Konfirmasi (paid)<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($pinmemberbatal->count() > 0)
                                            <li>Batal<span class="label label-success pull-right">{{$pinmemberbatal->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Batal<span class="label label-success pull-right">0</span></li>
                                        @endif
                                        @if ($pinmemberapprove->count() > 0)
                                            <li>Approve<span class="label label-danger pull-right">{{$pinmemberapprove->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Approve<span class="label label-danger pull-right">0</span></li>
                                        @endif
                                        @if ($pinmemberditolak->count() > 0)
                                            <li>Ditolak<span class="label label-default pull-right">{{$pinmemberditolak->trans_pincode_status->count()}}</span></li>
                                        @else
                                            <li>Ditolak<span class="label label-default pull-right">0</span></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <a href="{{route('admin.dashboardpincodemember')}}"><span class="label label-warning pull-right" style="margin-top:10px">Read More</span></a>
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
        