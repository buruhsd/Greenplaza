@extends('admin.index')
@section('masedi', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="col-md-12">
                <div class="col-md-4">
                    <div style="padding: 10px" class="panel panel-white stats-widget panel-{{FunctionLib::class_arr()[array_rand(FunctionLib::class_arr())]}}">
                        <div class="panel-body">
                            <p class="stats-info">Saldo Masedi Admin : <br/>
                           
                            <b>Rp. 
                                {{
                                    number_format($trans,2,',','.')
                                                                     
                                }}
                            </b>
                            
                            
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title">
                <h4 class="breadcrumb-header"><center>Laporan Transaksi Masedi Admin</center></h3>
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
                        <div class="col-md-6 pull-right">
                            <label for="status" class="sr-only">Status</label>
                            <select class="form-control" id="status" name="status" onchange = "location=this.value;">
                                <option value="">--> Select Transaction Option <--</option>
                                <option value="{{route('admin.list_masedi')}}">All Transaction</option>
                                <option value="{{route('admin.list_masedi_done')}}">Dropping Transaction</option>
                                <option value="{{route('admin.list_masedi_cancel')}}">Cancel Transaction</option>
                            </select>
                        </div>
                    </div>
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
                                    <th><center>Transaksi Code</center></th>
                                    <th><center>Username</center></th>
                                    <th><center>Seller</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            @if(count($masedi) != 0)
                                @foreach ($masedi as $key => $g)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$g->trans_code}}</center></td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    <td><center>{{$g->produk->user->username}}</center></td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    @if ($g->trans_detail_status == 1)
                                        <td><center>in Chart</center></td>
                                    @elseif ($g->trans_detail_status == 2)
                                        <td><center>Transfer</center></td>
                                    @elseif ($g->trans_detail_status == 3)
                                        <td><center>Seller</center></td>
                                    @elseif ($g->trans_detail_status == 4)
                                        <td><center>Packing</center></td>
                                    @elseif ($g->trans_detail_status == 5)   
                                        <td><center>Shipping</center></td>
                                    @elseif ($g->trans_detail_status == 6)   
                                        <td><center>Dropping</center></td>
                                    @elseif ($g->trans_is_cancel == 1)   
                                        <td><center>Cancel</center></td>
                                    @else 
                                        <td><center>-</center></td>
                                    @endif
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">KOSONG</td>
                                </tr>
                            @endif  
                        </table>
                        {{$masedi->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.masedi.detailmasedi')
@endsection
@section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection
