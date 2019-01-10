@extends('member.index')
@section('content')
<!-- Page Inner -->
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">List Hotlist</h3>
    </div>
    <div class="panel-body">
    </div>
    <div id="main-wrapper">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Pencarian</h4>
            </div>
            <form action="" method="GET">
                <input class="form-control" value="{{(isset($_GET['search']))?$_GET['search']:''}}" name="search" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">List Hotlist</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive invoice-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">No</th>
                                        <th></th>
                                        <th>Produk</th>
                                        <th>Sisa Click</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = ($hotlist->currentpage()-1)* $hotlist->perpage() + 1;?>
                                    @foreach($hotlist as $item)
                                    <tr>
                                        <th>{{$no++}}</th>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <img src="{{asset('assets/images/product/'.$item->produk->produk_image)}}" style="max-height: 100px;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Name : {{$item->produk->produk_name}}</li>
                                                <li>Harga : Rp. {{FunctionLib::number_to_text($item->produk->produk_price - ($item->produk->produk_price * $item->produk->produk_discount / 100))}}</li>
                                            </ul>
                                        </td>
                                        <td>{{$item->produk_hotlist}}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div> {!! $hotlist->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
    </div>
@endsection
                                   
        
                                        
                                           

                                