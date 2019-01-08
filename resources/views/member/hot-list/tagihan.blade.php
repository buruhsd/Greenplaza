@extends('member.index')
@section('content')
               <!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">Tagihan Hot List </h3>
    </div>
    <div class="panel-body">
    </div>
    <div id="main-wrapper">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Pencarian</h4>
            </div>
            <!-- Search form -->
            <form action="" method="GET" id="src" class="form-inline">
              <div class="form-group mx-sm-3 mb-2">
                <label for="name" class="sr-only">Name</label>
                <input type="text" class="form-control" placeholder="Search" name="code" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="status" class="sr-only">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                    <option value="new" {!! (!empty($_GET['status']) && $_GET['status'] == "new")?"selected":"" !!}>Belum Lunas</option>
                    <option value="wait" {!! (!empty($_GET['status']) && $_GET['status'] == "wait")?"selected":"" !!}>Menunggu Validasi Admin</option>
                    <option value="lunas" {!! (!empty($_GET['status']) && $_GET['status'] == "lunas")?"selected":"" !!}>Lunas</option>
                    <option value="batal" {!! (!empty($_GET['status']) && $_GET['status'] == "batal")?"selected":"" !!}>Batal</option>
                    <option value="ditolak" {!! (!empty($_GET['status']) && $_GET['status'] == "ditolak")?"selected":"" !!}>Ditolak</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2">Cari</button>
            </form>
        </div>
        <div class="panel panel-white">
            <div class="panel-body">
                <button type="button" onclick="search('new');" class="btn btn-danger">Belum Lunas<span class="label label-default pull-right">{{FunctionLib::count_trans_hotlist(0, Auth::id())}}</span></button>
                <button type="button" onclick="search('wait');" class="btn btn-info">Menunggu validasi admin<span class="label label-default pull-right">{{FunctionLib::count_trans_hotlist(1, Auth::id())}}</span></button>
                <button type="button" onclick="search('lunas');" class="btn btn-success">Lunas<span class="label label-default pull-right">{{FunctionLib::count_trans_hotlist(3, Auth::id())}}</span></button>
                <button type="button" onclick="search('batal');" class="btn btn-info">Batal<span class="label label-default pull-right">{{FunctionLib::count_trans_hotlist(2, Auth::id())}}</span></button>
                <button type="button" onclick="search('ditolak');" class="btn btn-info">Ditolak<span class="label label-default pull-right">{{FunctionLib::count_trans_hotlist(4, Auth::id())}}</span></button>
                <a href="{{ url('member/hotlist/buy_poin') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle"></i> Beli Poin</a>
                <div class="table-responsive invoice-table">
                    <table class="table">
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Tagihan Hot List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">No</th>
                                        <th>Kode Order</th>
                                        <th>Tanggal Order</th>
                                        <th>Paket</span></th>
                                        <th>Total Tagihan</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $no = 1;?>
                                    @foreach($hotlist as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td>{{$item->trans_hotlist_code}}</td>
                                        <td>{{FunctionLib::datetime_indo($item->created_at, true, 'full')}}</td>
                                        <td>{{$item->paket->paket_hotlist_name}}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    Status : {!!
                                                        ($item->trans_hotlist_status == 3)
                                                        ?'<button class="btn btn-xs btn-success">Lunas</button>'
                                                        :'<button class="btn btn-xs btn-danger">Belum Lunas</button>'
                                                    !!}
                                                </li>
                                                <li>
                                                    Tagihan : Rp. {{FunctionLib::number_to_text($item->trans_hotlist_amount)}}
                                                </li>
                                            </ul>
                                        </td>
                                        {{-- <td>{{$item->trans_hotlist_status}}</td> --}}
                                        <td>
                                            @if($item->trans_hotlist_status == 1)
                                                <a href="{{route('member.hotlist.konfirmasi', 1)}}" class="btn btn-xs btn-success">Konfirmasi</a>
                                                <button class="btn btn-xs btn-danger">Batal</button>
                                            @else
                                                <button class="btn btn-xs btn-success">Detail</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div> {!! $hotlist->appends(['code' => Request::get('code'), 'status' => Request::get('status')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.input-tanggal').datepicker();       
    });
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection