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
                    <div class="col-md-12">
                        <form action="#" method="GET" class="form-inline">
                            <div class="input-group pull-left" style="width: 225px;">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Search by Code ..."></a>
                            </div>
                            <div class="pull-right form-group mx-sm-3 mb-2">
                            <label for="status" class="sr-only">Status</label>
                            <select class="form-control" id="status" name="status" onchange = "location=this.value;">
                                <option value="">Status</option>
                                <option value="/admin/list_transaction_gln_approve" >Seller Sanggup</option>
                                <option value="/admin/list_transaction_gln_paid">Kirim Seller</option>
                                <option value="/admin/list_transaction_gln_paid">Expired</option>
                            </select>
                          </div>
                        </form>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="input-group pull-right">
                            <a href="{{route('admin.list_gln_wallet')}}"><button class="btn btn-info btn-xs pull-right" style="margin-bottom: 2%">List Wallet Gln</button></a>
                        </div>
                    </div> -->
                </div>
                <div class="panel-body" style="margin-top: 2%">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Wallet</center></th>
                                    <th><center>Trans Code</center></th>
                                    <th><center>Trans Id</center></th>
                                    <th><center>Detail Id</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Saldo Gln</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @if(count($gln) != 0)
                                @foreach ($gln as $key => $g)
                                @if($g->gln['trans_gln_status'] == 1)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    @if (App\Models\Trans_gln::where('trans_gln_detail_id', $g->id)->count() > 0)
                                        <td><center>{{$g->gln->trans_gln_form}}</center></td>
                                        @else
                                        <td><center> - </center></td>
                                    @endif
                                    <td><center>{{$g->trans_code}}</center></td>
                                    <td><center>{{$g->trans_detail_trans_id}}</center></td>
                                    <td><center>{{$g->id}}</center></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    @if (App\Models\Trans_gln::where('trans_gln_detail_id', $g->id)->count() > 0)
                                        <td><center>{{$g->gln->trans_gln_amount_total}}</center></td>
                                        @else
                                        <td><center> - </center></td>
                                    @endif
                                    <td><center>Seller Sanggup</center></td>
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
@include('admin.masedi.detailgln')
@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
