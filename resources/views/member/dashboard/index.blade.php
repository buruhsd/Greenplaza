@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">Dashboard</h3>
</div>
<div class="panel-body">
    <div class="pull-right">
        <p class="stats-info hidden">Total {{__('dashboard.transaksi') }} :
            <span class="stats-number">
                Rp. {{FunctionLib::number_to_text(
                    FunctionLib::sum_trans("", Auth::id())
                    +FunctionLib::sum_trans("", Auth::id(), 'seller')
                )}}
            </span>
        </p>
        {{-- <p class="stats-info">Grade Toko : --}}
        {{-- <span class="stats-number">$781,876</span></p> --}}
    </div>
</div>
<div id="main-wrapper">
@if(Auth::user()->seller_active())
    <div class="panel panel-white stats-widget bg-info">
        <h3 class="breadcrumb-header">{{__('dashboard.penjualan') }}</h3>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.sales', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(1, Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pesanan') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.sales', ['status' => 'transfer'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(2, Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">Transfer</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.sales', ['status' => 'packing'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(4, Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pengepakan') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.sales', ['status' => 'shipping'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(5, Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pengiriman') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.sales', ['status' => 'dropping'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(6, Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.barang_sampai') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="javascript:;">
                    <div class="panel stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                        <div class="panel-body">
                            <div class="pull-left">
                                <span class="stats-number">Rp. 
                                    {{
                                        FunctionLib::number_to_text(
                                            FunctionLib::sum_wd(Auth::id())
                                        )
                                    }}
                                </span>
                                <!-- <span class="stats-number">Rp. 
                                    {{
                                        FunctionLib::number_to_text(
                                            FunctionLib::sum_trans(7, Auth::id(), 'seller')+
                                            FunctionLib::sum_trans(8, Auth::id(), 'seller')
                                        )
                                    }}
                                </span> -->
                                <p class="stats-info">{{__('dashboard.penarikan_cw') }}</p>
                            </div>
                            
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 hidden">
                    <a href="{{route('member.transaction.sales', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans("", Auth::id(), 'seller')
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">Total {{__('dashboard.transaksi') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
            </div><!-- Row -->
        </div>
    </div>
@endif
    <div class="panel panel-white stats-widget bg-info">
        <h3 class="breadcrumb-header">{{__('dashboard.pembelian') }}</h3>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('chart')}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">
                                        <?php $chart = (Session::has('chart'))
                                            ?FunctionLib::number_to_text(
                                                FunctionLib::array_sum_key(Session::get('chart'), 'trans_detail_amount_total')
                                            )
                                            :FunctionLib::number_to_text(0);?>
                                        Rp. {{$chart}}
                                    </span>
                                    <p class="stats-info">{{__('front.kerancang') }}</p>
                                </div>
                                
                            </div>
                    </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(1, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pesanan') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'transfer'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(2, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">Transfer</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'packing'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(4, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pengepakan') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(5, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.pengiriman') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(6, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">{{__('dashboard.barang_sampai') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-lg-4 col-md-6">
                    <a href="{{route('member.transaction.purchase', ['status' => 'order'])}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans(7, Auth::id())+
                                                FunctionLib::sum_trans(8, Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">Penarikan</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div> -->
                <div class="col-lg-4 col-md-6 hidden">
                    <a href="{{route('member.transaction.purchase')}}">
                        <div class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                            <div class="panel-body">
                                <div class="pull-left">
                                    <span class="stats-number">Rp. 
                                        {{
                                            FunctionLib::number_to_text(
                                                FunctionLib::sum_trans("", Auth::id())
                                            )
                                        }}
                                    </span>
                                    <p class="stats-info">Total {{__('dashboard.transaksi') }}</p>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
            </div><!-- Row -->
        </div>
    </div>
</div>
@endsection
        