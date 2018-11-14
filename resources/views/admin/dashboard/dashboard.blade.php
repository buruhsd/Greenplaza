@extends('admin.index')
@section('content')

<div class="page-title">
        <h3 class="breadcrumb-header">Dashboard</h3>
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
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Seller</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                            <li>Belum Bayar<span class="label label-default pull-right">85%</span></li>
                                            <li>Belum Approve<span class="label label-success pull-right">Finished</span></li>
                                            <li>Approve<span class="label label-success pull-right">Finished</span></li>
                                            <li>Block<span class="label label-danger pull-right">Rejected</span></li>
                                            <li>Reject<span class="label label-default pull-right">27%</span></li>
                                        </ul>
                                    </div>
                                    <a href="#"><span class="label label-danger pull-right" style="margin-top:150px">Read More</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
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
                                    <a href="#"><span class="label label-danger pull-right" style="margin-top:235px">Read More</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Transaksi Barang</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="project-stats">
                                        <ul class="list-unstyled">
                                            <li>Cart<span class="label label-default pull-right">85%</span></li>
                                            <li>Order<span class="label label-success pull-right">Finished</span></li>
                                            <li>Transfer<span class="label label-success pull-right">Finished</span></li>
                                            <li>Seller Tunggu<span class="label label-danger pull-right">Rejected</span></li>
                                            <li>Seller Batal<span class="label label-default pull-right">27%</span></li>
                                            <li>Packing<span class="label label-default pull-right">48%</span></li>
                                            <li>Shipping<span class="label label-default pull-right">Pending</span></li>
                                        </ul>
                                    </div>
                                    <a href="#"><span class="label label-danger pull-right" style="margin-top:65px">Read More</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                
@endsection
        