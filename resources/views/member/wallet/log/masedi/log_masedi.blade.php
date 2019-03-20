@extends('member.index')
@section('log', 'active-page')
@section('content')

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            @include('layouts._flash')
            
            <div class="page-title">
                <h4 class="breadcrumb-header"><center>Log Transaksi Masedi</center></h3>
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
                                    <th><center>Transaksi</center></th>
                                    <th><center>Detail Produk</center></th>
                                    <th><center>Status</center></th>
                                </tr>
                            </thead>
                            @if(count($masedi) != 0)
                                @foreach ($masedi as $key => $g)
                                <tr>
                                    <td><center>{{$key ++}}</center></td>
                                    <td><center>{{$g->trans->pembeli->username}}</center></td>
                                    <td>
                                        <ul>
                                            <li>Transaksi Kode : {{$g->trans_code}}</li>
                                            <li>Tanggal : {{$g->trans->created_at}}</li>
                                        </ul>
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-xs" data-toggle="modal" data-target="#editModal{{$g->id}}"><i class="fa fa-edit"></i>Detail Produk</button></td>
                                    <td><center>Done</center></td>
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
@include('member.wallet.log.masedi.detailmasedi')
@endsection
<!-- @section('script')
<script type="text/javascript">
  $('#select-list').on('change',function(e){
      console.log($(this).find(':selected').val());
      window.location.href = $(this).find(':selected').val();
      })
</script>
@endsection -->