@extends('member.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Produk</h3>
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
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" class="form-control" placeholder="Search" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                        <option value="wait" {!! (!empty($_GET['status']) && $_GET['status'] == "wait")?"selected":"" !!}>Wait</option>
                        <option value="active" {!! (!empty($_GET['status']) && $_GET['status'] == "active")?"selected":"" !!}>Active</option>
                        <option value="block" {!! (!empty($_GET['status']) && $_GET['status'] == "block")?"selected":"" !!}>Block</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
                        
            </div>
            <div class="row">
            <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Produk</h4>
                    <button type="button" onclick="search('active');" class="btn btn-info">Approve<span class="label label-default pull-right">{{FunctionLib::count_produk(1)}}</span></button>
                    <button type="button" onclick="search('wait');" class="btn btn-info">Belum Approve<span class="label label-default pull-right">{{FunctionLib::count_produk(0)}}</span></button>
                    <button type="button" onclick="search('block');" class="btn btn-info">Block<span class="label label-default pull-right">{{FunctionLib::count_produk(2)}}</span></button>
                    <a href="{{ url('admin/produk/create') }}" class="btn btn-success btn-sm pull-right">Add New</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto Produk</th>
                                    <th>Detail Produk</th>
                                    <th>Detail Seller</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($produk as $item)
                                    <tr>
                                        <th scope="row">{{$no++}}</th>
                                        <td><img class="h100" src="{{asset("assets/images/product/".$item->produk_image)}}"></td>
                                        <td scope="row">
                                            <ul>
                                                <li>Name : {{$item->produk_name}}</li>
                                                <li>Brand : {{$item->produk_brand_id}}</li>
                                                <li>Category : {{$item->produk_category_id}}</li>
                                                <li>Price : {{$item->produk_price}}</li>
                                                <li>Stock : {{$item->produk_stock}}</li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            <ul>
                                                <li>window : {{$item->user->user_store}}</li>
                                                <li>Username : {{$item->user->username}}</li>
                                                <li>Name : {{$item->user->name}}</li>
                                                <li>Email : {{$item->user->email}}</li>
                                            </ul>
                                        </td>
                                        <td scope="row">
                                            {!!($item->produk_status == 1)
                                                ?"<button class='btn btn-success btn-xs'>Active</button>"
                                                :"<button class='btn btn-danger btn-xs'>Non Active</button>"!!}
                                        </td>
                                        <td scope="row">
                                            <a href="{{route('member.produk.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                            <a href="{{route('member.produk.edit', $item->id)}}" class='btn btn-info btn-xs'>Edit</a>
                                            <a href="{{route('member.produk.delete', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $produk->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
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
        