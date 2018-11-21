@extends('admin.index')
@section('content')

<div class="page-title">
    <h3 class="breadcrumb-header">Hot Promo</h3>
</div>
<div class="panel-heading clearfix" style="margin-bottom: 10px;">
    <form action="#" method="GET">
        <div class="input-group pull-left" style="width: 225px;">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search" name="search" value="" autocomplete="off" id="search_table_currency">
        </div>
        <div class="input-group pull-left" style="width: 225px;">
            <select class="form-control" id="sel1">
                <option>Coba heuheu</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
            <input type="submit" class="btn btn-default" value="search">
    </form>
    <div class="input-group pull-right" style="width: 225px;">
        <a type="button" class="btn btn-default">Tambah Produk Baru</a>
    </div>              
</div> 
<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-white">
        
          
            <div class="panel-heading clearfix">
                <h4>Hot Promo</h4> 
                <button type="button" class="btn btn-info">Approve<span class="label label-default pull-right">85%</span></button>
                <button type="button" class="btn btn-info">Belum Approve<span class="label label-default pull-right">85%</span></button>
                <button type="button" class="btn btn-info">Block<span class="label label-default pull-right">85%</span></button>

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
                            {{$no = 1}}
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- Row -->
@endsection
        