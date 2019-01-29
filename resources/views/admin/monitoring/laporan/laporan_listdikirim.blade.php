@extends('admin.index')
@section('monitoring', 'active-page')
@section('content')


<link href="{{asset('admin/plugins/summernote-master/summernote.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admin/plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
		            <div class="col-md-3">
                        <select id="select-list" type="text" class="form-control">
                            <option value="">--Choose Option Search--</option>
                            <option value="/admin/monitoring/laporan">Tanggal Checkout</option>
                            <option value="/admin/monitoring/laporan_transfer">Tanggal Member Transfer</option>
                            <option value="/admin/monitoring/laporan_dikirim">Tanggal Barang di Kirim</option>
                            <option value="/admin/monitoring/laporan_sampai">Tanggal Barang Sampai</option>
                        </select>
                    </div>
                    <form class="form-horizontal" method="GET" action= "{{route('admin.monitoring.laporan')}}" enctype = "multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-3">
                            <div class="form-group" style="padding-right: 3%">
                                <input type="text" name="tglawal" class="form-control date-picker" id="" placeholder="Tanggal Mulai">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="padding-right: 3%">
                                <input type="text" name="tglakir" class="form-control date-picker" id="" placeholder="Tanggal Sampai">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <center><button type="submit" class="btn btn-primary" style="width: 100%">Search</button></center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-title">
			    <h4 class="breadcrumb-header"><center>Laporan Transaksi Page</center></h3>
			</div>
			<div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><center>Id Order Detail</center></th>
                                    <th><center>Detail Waktu</center></th>
                                    <th><center>Detail Barang</center></th>
                                    <th><center>Detail Seller</center></th>
                                    <th><center>Detail Member</center></th>
                                </tr>
                            </thead>
                             @if(count($detail) != 0)
                            <tbody>
                                @foreach ($detail as $d)
                                <tr>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->created_at}}</td>
                                    <td>
                                        <center>{{$d->trans_code}}</center> <br/>
                                        <center><img style="width: 20%" src="{{ asset('assets/images/product/'.$d->produk->produk_image) }}" alt=""></center>
                                    </td>
                                    <td>{{App\User::where('id', $d->produk->produk_seller_id)->first()->username}}</td>
                                    <td>{{App\User::where('id', $d->user_address->user_address_user_id)->first()->username}}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Kosong</td>
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

<script src="{{asset('admin/plugins/summernote-master/summernote.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin/js/pages/form-elements.js')}}"></script>
@endsection
