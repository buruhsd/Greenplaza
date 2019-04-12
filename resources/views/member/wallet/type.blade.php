@extends('member.index')
@section('log', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">History Saldo</h3>
</div>
<div class="panel-body">
    <div class="pull-right">
        {{-- <p class="stats-info">Grade Toko :
        <span class="stats-number">Rp. {{FunctionLib::number_to_text($log_wallet->first()->wallet->wallet_ballance)}}</span></p> --}}
    </div>
</div>
<div id="main-wrapper">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Pencarian</h4>
        </div>
        <form>
        <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search"/>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-white">
                <div class="pull-right">
                    {{-- <p class="stats-info">Total :
                    <span class="stats-number">Rp. {{FunctionLib::number_to_text($log_wallet->first()->wallet->wallet_ballance)}}</span></p> --}}
                </div>
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">History Saldo {{ucfirst(strtolower(str_replace("_", " ", $wallet_type['wallet_type_name'])))}}</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive invoice-table">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">No</th>
                                    <td>Tanggal</td>
                                    <td>Cash In</td>
                                    <td>Cash Out</td>
                                    <td>Detail</td>
                                </tr>
                                <?php $no=1; ?>
                                @foreach($log_wallet as $item)

                                    <?php

                                        if($item->wallet_type == "7"){
                                            $keterangan = "transaksi by gln";
                                        }else{
                                            $keterangan = $item->wallet_note;
                                        }
                                     ?>
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{FunctionLib::date_indo($item->created_at, true, 'full')}}</td>
                                        <td>{{$item->wallet_cash_in}}</td>
                                        <td>{{$item->wallet_cash_out}}</td>
                                        <td>{{$keterangan}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div>
@endsection
        