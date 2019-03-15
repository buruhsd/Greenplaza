@extends('member.index')
@section('log', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
                <h4 class="breadcrumb-header"><center>Log Transaksi Greenline</center></h3>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <form action="#" method="GET" class="form-inline">
                                <div class="input-group pull-left" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Code ..."></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="sr-only">Status</label>
                            <select class="form-control" id="status" name="status" onchange = "location=this.value;">
                                <option value=""><-- Select Transaction Option --></option>
                                <option value="/member/wallet/log_gln">All Transaction</option>
                                <option value="/member/wallet/log_gln_done">Success Transaction</option>
                                <option value="/member/wallet/log_gln_cancel">Cancel Transaction</option>
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
                                    <th><center>Username</center></th>
                                    <th><center>Transaksi Code</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            @if(count($gln) != 0)
                                @foreach ($gln as $key => $g)
                                @if (App\Models\Trans_gln::where('trans_gln_detail_id', $gln->id)->count() > 0 && $g->gln->trans_gln_status == 2)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    <td><center>{{$g->trans_code}}</center></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    <td><center>Pending</center></td>
                                </tr>
                                @endif
                                @endforeach
                        
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">KOSONG</td>
                                </tr>
                            @endif  
                        </table>
                        {{$gln->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('member.wallet.log.gln.detailgln')
@endsection
<!-- @section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection -->