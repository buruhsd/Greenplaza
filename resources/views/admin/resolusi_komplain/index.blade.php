@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Resolusi Komplain</h3>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Pencarian</h4>
                </div>
                
                <form action="" method="GET" id="src" class="form-inline">
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="komplain" class="sr-only">Komplain</label>
                    <input type="text" class="form-control" placeholder="Komplain" name="komplain" value="{!! (!empty($_GET['komplain']))?$_GET['komplain']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        <option value="new" {!! (!empty($_GET['status']) && $_GET['status'] == "new")?"selected":"" !!}>New</option>
                        <option value="help" {!! (!empty($_GET['status']) && $_GET['status'] == "help")?"selected":"" !!}>Admin Help</option>
                        <option value="done" {!! (!empty($_GET['status']) && $_GET['status'] == "done")?"selected":"" !!}>Done</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Resolusi Komplain</h4>
                    <button type="button" onclick="search('new');" class="btn btn-info">New<span class="label label-default pull-right">{{FunctionLib::count_res_kom(1)}}</span></button>
                    <button type="button" onclick="search('help');" class="btn btn-warning">Admin Help<span class="label label-default pull-right">{{FunctionLib::count_res_kom(2)}}</span></button>
                    <button type="button" onclick="search('done');" class="btn btn-success">Done<span class="label label-default pull-right">{{FunctionLib::count_res_kom(3)}}</span></button>
                    <!-- <a href="{{ url('admin/produk/create') }}" class="btn btn-success btn-sm pull-right">Add New</a> -->
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Komplain Detail</th>
                                    <th>Transaction Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($komplain->count() > 0)
                                <?php $no = 1; ?>
                                @foreach($komplain as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td scope="row">
                                            <ul>
                                                <li>Komplain : {{$item->komplain_type->komplain_name}}</li>
                                                <li>status : 
                                                    {!!($item->komplain_status == 1)
                                                        ?"<button class='btn btn-info btn-xs'>New</button>"
                                                        :(($item->komplain_status == 2)
                                                            ?"<button class='btn btn-warning btn-xs'>Admin Help</button>"
                                                            :"<button class='btn btn-success btn-xs'>Done</button>")!!}
                                                </li>
                                                <li>Date Create : {{$item->created_at}}</li>
                                                <li>Date Clear : {{$item->komplain_clear_date}}</li>
                                                <!-- <li><button class='btn btn-info btn-xs'>More</button></li> -->
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <ul>
                                                <li>Code : {{$item->trans_detail->trans_code}}</li>
                                                <li>Amount : {{$item->trans_detail->trans_detail_amount_total}}</li>
                                                <li>
                                                    {!! Form::open(['id' => 'form-transDetail']) !!}
                                                    <input type="hidden" name="type" value="buyer"/>
                                                    <input type="button" onclick='modal_post($(this), $("#form-transDetail").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.res_kom_transDetail_admin", $item->komplain_trans_id)}} value="More" class="btn btn-info btn-xs" />
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            @if($item->komplain_status == 1)
                                                <a href="{{route('admin.produk.disabled', $item->id)}}" class='btn btn-info btn-xs'>Proses</a>
                                            @elseif($item->komplain_status == 2 && $item->solusi->solusi_status == 3 && $item->solusi->solusi_seller_accept == 1 && ($item->solusi->solusi_solusi_id == 1 || $item->solusi->solusi_solusi_id == 4))
                                                <a href="{{route('admin.res_kom.done_komplain', $item->id)}}" class='btn btn-danger btn-xs'>Transfer ke member</a>
                                            @else
                                                <a href="javascript:;" class='btn btn-success btn-xs'>Done</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="4"><center>KOSONG</center></td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $komplain->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
        </div>
    </div><!-- Row -->
</div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
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
        