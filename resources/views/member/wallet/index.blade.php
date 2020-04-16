@extends('member.index')
@section('get penjual', 'active-page')
@section('content')
<!-- Page Inner -->
<div class="page-title">
    <h3 class="breadcrumb-header">{{__('dashboard.history') }} Saldo</h3>
</div>
<div class="panel-body">
<div class="pull-right">
    <p class="stats-info">{{__('dashboard.grade_toko') }} :
    {{-- <span class="stats-number">$781,876</span></p> --}}
    </div>
</div>
<div id="main-wrapper">
    <div class="row">
        @foreach($wallet as $item)
            <div class="col-lg-6 col-md-6">
                <div class="panel panel-white">
                    <div class="pull-right">
                        <p class="stats-info">Total :
                            <span class="stats-number">Rp. {{FunctionLib::number_to_text($item->wallet_ballance)}}</span>
                        </p>
                    </div>
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">{{__('dashboard.history') }} Saldo {{strtoupper($item->type->wallet_type_name)}}</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <table class="table">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">No</th>
                                        <td>{{__('dashboard.date') }}</td>
                                        <td>{{__('dashboard.cash_in') }}</td>
                                        <td>{{__('dashboard.cash_out') }}</td>
                                        <td>Detail</td>
                                    </tr>
                                    <?php $no=1; ?>
                                    @foreach($item->log()->limit(5)->get() as $log)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{FunctionLib::date_indo($log->created_at, true, 'full')}}</td>
                                            <td>{{$log->wallet_cash_in}}</td>
                                            <td>{{$log->wallet_cash_out}}</td>
                                            <td>{{$log->wallet_note}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5"><a href="{{route('member.wallet.type', [$item->type->wallet_type_name])}}" type="button" class="btn btn-info">{{__('dashboard.all') }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection
        