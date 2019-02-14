@extends('admin.index')
@section('masedi', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
			    <h4 class="breadcrumb-header"><center>Laporan Transaksi Masedi</center></h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Trans User</center></th>
                                    <th><center>Trans Code</center></th>
                                    <th><center>Trans Payment</center></th>
                                    <th><center>Trans Paid Date</center></th>
                                    <th><center>Trans Amount Total</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @if(count($masedi) != 0)
                                @foreach ($masedi as $key => $m)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$m->pembeli->username}}</center></td>
                                    <td><center>{{$m->trans_code}}</center></td>
                                    <td><center>Payment By Masedi</center></td>
                                    @if ($m->trans_paid_date == null)
                                    <td><center> - </center></td>
                                    @else 
                                    <td><center>{{$m->trans_paid_date}}</center></td>
                                    @endif
                                    <td><center>{{$m->trans_amount_total}}</center></td>
                                </tr>
                                @endforeach 
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">KOSONG</td>
                                </tr>
                            @endif                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
