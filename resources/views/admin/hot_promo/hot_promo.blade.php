@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Hot Promo</h3>
</div>
<div class="panel-heading clearfix" style="margin-bottom: 10px;">
    <form action="" method="GET" id="src">
        <div class="input-group pull-left" style="width: 225px;">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search" name="name" value="{!! (!empty($_GET['name']))?$_GET['name']:"" !!}" autocomplete="off" id="search_table_currency">
        </div>
        <div class="input-group pull-left" style="width: 225px;">
            <select class="form-control" id="status" name="status">
                <option value="" {!! (!empty($_GET['status']) && $_GET['status'] == "")?"selected":"" !!}>All</option>
                <option value="wait" {!! (!empty($_GET['status']) && $_GET['status'] == "wait")?"selected":"" !!}>Wait</option>
                <option value="active" {!! (!empty($_GET['status']) && $_GET['status'] == "active")?"selected":"" !!}>Active</option>
                <option value="block" {!! (!empty($_GET['status']) && $_GET['status'] == "block")?"selected":"" !!}>Block</option>
            </select>
        </div>
            <input type="submit" class="btn btn-default" value="search">
    </form>
    <div class="input-group pull-right" style="width: 225px;">
        <a href="" type="button" class="btn btn-default">Tambah Produk Baru</a>
    </div>              
</div> 
<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-white">
        
          
            <div class="panel-heading clearfix">
                <h4>Hot Promo</h4> 
                <button type="button" onclick="search('active');" class="btn btn-info">Approve<span class="label label-default pull-right">{{FunctionLib::count_produk_hot(1)}}</span></button>
                <button type="button" onclick="search('wait');" class="btn btn-info">Belum Approve<span class="label label-default pull-right">{{FunctionLib::count_produk_hot(0)}}</span></button>
                <button type="button" onclick="search('block');" class="btn btn-info">Block<span class="label label-default pull-right">{{FunctionLib::count_produk_hot(2)}}</span></button>

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
                         @if($produk->count() > 0)
                            <?php $no = 1; ?>
                            @foreach($produk as $item)
                            <tr>
                                <th scope="row">{{$no++}}</th>
                                <td><img src="{{asset("assets/images/product/".$item->produk_image)}}" style="max-height: 100px;"></td>
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
                                    <a href="{{route('admin.produk.disabled', $item->id)}}" class='btn btn-warning btn-xs'>Disabled</a>
                                    <a href="{{route('admin.produk.edit', $item->id)}}" class='btn btn-info btn-xs'>Edit</a>
                                    <a href="{{route('admin.produk.delete', $item->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <td colspan="6"><center>KOSONG</center></td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row -->
@endsection
<script type="text/javascript">
    function search(val){
        $('#status').val(val);
        $('#src').submit();
    }
</script>
        