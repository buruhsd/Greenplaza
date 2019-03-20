@extends('member.index')
@section('sales', 'active-page')
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
                    <button type="button" onclick="search('new');" class="btn btn-info">New<span class="label label-default pull-right">{{FunctionLib::count_res_kom(1, "seller")}}</span></button>
                    <button type="button" onclick="search('help');" class="btn btn-warning">Admin Help<span class="label label-default pull-right">{{FunctionLib::count_res_kom(2, "seller")}}</span></button>
                    <button type="button" onclick="search('done');" class="btn btn-success">Done<span class="label label-default pull-right">{{FunctionLib::count_res_kom(3, "seller")}}</span></button>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($komplain as $item)
                                    <tr>
                                        <td scope="row" colspan="2">
                                            <ul>
                                                <li>
                                                    <b>
                                                        Komplain&nbsp;
                                                        {{$item->trans_detail->produk->produk_name}}&nbsp;
                                                        dengan kode transaksi&nbsp;
                                                        {{$item->trans_detail->trans->trans_code}}
                                                        dan kode transaksi detail&nbsp;
                                                        {{$item->trans_detail->trans_code}}
                                                    </b>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="50%">
                                            <ul>
                                                <li>Komplain : {{$item->komplain_type->komplain_name}}</li>
                                                <li>Date Create : {{FunctionLib::datetime_indo($item->created_at, true, 'full')}}</li>
                                                {{-- <li>Date Clear : {{FunctionLib::datetime_indo($item->komplain_clear_date, true, 'full')}}</li> --}}
                                            </ul>
                                        </td>
                                        <td scope="row" width="50%">
                                            <ul>
                                                <li>Code : {{$item->trans_detail->trans_code}}</li>
                                                <li>Amount : {{$item->trans_detail->trans_detail_amount_total}}</li>
                                                <li>
                                                    {!! Form::open(['id' => 'form-transDetail']) !!}
                                                        <input type="hidden" name="type" value="seller"/>
                                                        <input type="button" onclick='modal_post($(this), $("#form-transDetail").serialize());' data-toggle='modal' data-method='post' data-href={{route("localapi.modal.res_kom_transDetail_post", $item->komplain_trans_id)}} value="More" class="btn btn-info btn-xs" />
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" colspan="2">
                                            <ul class="m-l-lg">
                                                <li>
                                                    <b>
                                                        Solusi yang ditawarkan.
                                                    </b>
                                                    @if($item->solusi->solusi_status !== 3)
                                                        <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.update_komplain", $item->id)}} class='btn btn-info btn-xs'>
                                                            Ubah Solusi
                                                        </button>
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" width="50%">
                                            <ul class="m-l-lg">
                                                <li>Solusi : {{$item->solusi->solusi_type->solusi_name}}</li>
                                                <li>Dana yang diminta : {{$item->solusi->solusi_value}}
                                                </li>
                                                <li>Status : &nbsp;
                                                    #Buyer&nbsp;
                                                    {!!
                                                        ($item->solusi->solusi_buyer_accept == 1)
                                                        ?"<button class='btn btn-info btn-xs'>Done</button> at ".FunctionLib::date_indo($item->solusi->solusi_buyer_date, true, 'full')
                                                        :"<button class='btn btn-danger btn-xs'>Wait</button>"
                                                    !!} &nbsp;
                                                </li>
                                                <li>Status : &nbsp;
                                                    #Seller&nbsp;
                                                    {!!
                                                        ($item->solusi->solusi_seller_accept == 1)
                                                        ?"<button class='btn btn-info btn-xs'>Done</button> at ".FunctionLib::date_indo($item->solusi->solusi_seller_date, true, 'full')
                                                        :"<button class='btn btn-danger btn-xs'>Wait</button>"
                                                    !!}
                                                </li>
                                            </ul>
                                        </td>
                                        <td scope="row" width="50%">
                                            {{-- jika ada komplain status new --}}
                                            @if($item->solusi->solusi_status == 1)
                                                <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.solusi.approve_solusi", $item->solusi->id)}} class='btn btn-danger btn-xs'>
                                                    Terima Solusi Tawaran Pembeli
                                                </button><br/>
                                            {{-- jika ada komplain status 2 nomor resi pembeli null --}}
                                            @elseif($item->solusi->solusi_status == 2 && $item->solusi->solusi_seller_resi == null && $item->solusi->solusi_seller_without_resi == 0)
                                                @switch($item->solusi->solusi_type->id)
                                                    @case(1)
                                                    @case(4)
                                                        <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.solusi.add_seller_without_resi", $item->solusi->id)}} value="konfirmasi kembalikan dana" class="btn btn-danger btn-xs" />
                                                    @break
                                                    @case(2)
                                                    @case(3)
                                                        <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.komplain.add_shipment_seller", $item->id)}} value="Konfirmasi Kirim Barang" class="btn btn-danger btn-xs" />
                                                    @break
                                                @endswitch
                                            @endif
                                            {{-- jika ada komplain status 2 nomor resi pembeli bukan null dan buyer accept 0 --}}
                                            @if($item->solusi->solusi_status == 2 && ($item->solusi->solusi_buyer_resi !== null || $item->solusi->solusi_buyer_without_resi !== 0) && $item->solusi->solusi_buyer_accept == 0)
                                            <button onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("member.solusi.approve_shipment_buyer", $item->solusi->id)}} class='btn btn-info btn-xs'>
                                                Menerima Barang Kembalian
                                            </button><br/>
                                            @endif
                                            <ul>
                                                <li>
                                                    {!!$item->solusi->solusi_note!!}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
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
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
@endsection
        