@extends('admin.index')
@section('need approval', 'active-page')
@section('content')

<div class="page-inner">
<div id="main-wrapper">
    <div class="row">
        @include('layouts._flash')
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix" style="margin-bottom: 2%">
                    <div class="col-md-6">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <form action="#" method="GET">
                                <div class="input-group pull-left" style="width: 225px;">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <a href="javascript:void(0)"><input type="text" name="search" class="form-control search-input" placeholder="Email Member ..."></a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('admin/produk/create') }}" class="btn btn-primary btn-sm pull-right">Add New Produk</a>
                    </div>
                    <div class="col-md-12 pull-right" style="margin-top: 2%">
                        <a href="{{url('admin/needapproval/produkadmin')}}"><button class='btn btn-info'>Active<span class="label label-default pull-right">{{$count}}</span></button></a>
                        <a href="{{url('admin/needapproval/produkadmin_block')}}"><button class='btn btn-info'>Block<span class="label label-default pull-right">{{$count_block}}</span></button></a>
                    </div>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Foto_Produk</center></th>
                                    <th><center>Detail_produk</center></th>
                                    <th><center>Detail_Seller</center></th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody class="table-responsive table table-striped">
                            @if($produk->count() > 0)
                            @foreach ($produk as $key => $h)
                                <tr>

                                    <td><center>{{++$key}}</center></td>
                                    <td><center><img class="h100" src="{{asset("assets/images/product/".$h->images->first()['produk_image_image'])}}"></center></td>
                                    <td scope="row">
                                        <ul>
                                            <li>Name : {{$h->produk_name}}</li>
                                            <li>Brand : {{$h->brand->brand_name}}</li>
                                            <li>Category : {{$h->category_name}}</li>
                                            <li>Price : {{$h->produk_price}}</li>
                                            <li>Stock : {{$h->produk_stock}}</li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        <ul>
                                            <li>window : {{$h->user->user_store}}</li>
                                            <li>Username : {{$h->user->username}}</li>
                                            <li>Name : {{$h->user->name}}</li>
                                            <li>Email : {{$h->user->email}}</li>
                                        </ul>
                                    </td>
                                    <td scope="row">
                                        {!!($h->produk_status == 1)
                                            ?"<button class='btn btn-success btn-xs'>Active</button>"
                                            :"<button class='btn btn-danger btn-xs'>Non Active</button>"!!}
                                    </td>
                                    <td><center>
                                        <a href="{{route('admin.produk.edit', $h->id)}}"><button class='btn btn-warning btn-xs'>Edit</button></a>
                                        <a href="{{route('admin.produk.destroy', $h->id)}}" class='btn btn-danger btn-xs'>Delete</a>
                                        @if ($h->produk_status == 1)
                                        <a href="{{route('admin.produk.block', $h->id)}}" class='btn btn-danger btn-xs'>Block</a>
                                        @else
                                        <a href="{{route('admin.produk.active', $h->id)}}" class='btn btn-success btn-xs'>Active</a>
                                        @endif
                                    </center></td>
                                </tr>
                                @endforeach
                            @else
                                <td colspan="7"><center>KOSONG</center></td>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div> {!! $produk->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
</div>

@endsection