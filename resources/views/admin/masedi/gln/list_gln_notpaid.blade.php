
@extends('admin.index')
@section('masedi', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
			    <h4 class="breadcrumb-header"><center>Laporan Transaksi Greenline</center></h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-6">
                        <form action="#" method="GET">
                            <div class="input-group pull-left" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Code ..."></a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group pull-right">
                            <select id="select-list" type="text" class="form-control">
                                <option value="">--Choose Paid Option--</option>
                                <option value="/admin/list_transaction_gln_paid">Is Paid</option>
                                <option value="/admin/list_transaction_gln_notpaid">Not Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="margin-top: 2%">
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
                                @if(count($gln) != 0)
                                @foreach ($gln as $key => $m)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$m->pembeli->username}}</center></td>
                                    <td><center>{{$m->trans_code}}</center></td>
                                    <td><center>Payment By GLN</center></td>
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
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
