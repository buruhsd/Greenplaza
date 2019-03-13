@extends('frontend.layout.indexall', ['active' => 'home'])
@section('title', 'etalase')
@section('content')
<!-- breadcumb-area end -->
<!--     <div class="about-area mb-30">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>

    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 ">
                    <div class="author-wrap-etalase">
                        <img class="h100" src="{{ asset('/assets/images/profil/'.$user->user_detail->user_detail_image.'') }}" onerror="this.src='http://placehold.it/700x400'" alt="">

                        <h4>{{$user->name}}</h4>
                        <p>{{$user->user_slogan}}</p>
                        <ul>
                        <a href="{{route('member.message.create', $user->user_slug)}}"><li class="btn-chat"> Chat </li></a>
                        </ul>
                    </div>  
                </div>
                <div class="col-9">
                    <div class="breadcumb-wrap-etalase bg-1" src="">
                        <div class="breadcumb-content-etalase black-opacity" style="background: url('{{ asset('/assets/images/bg_etalase/'.$user->user_store_image.'')}}') no-repeat center center/ cover; " onerror="this.src='http://placehold.it/700x400'">
                            <h2></h2>
                            <ul>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity" style="background-image: url('/frontend/images/banner/cat.jpg')">
                            <h2>Halaman Toko</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .shop-page-area start -->
    <div class="shop-page-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <div class="row">
                            <div class="col-12">
                                <div class="single-product-menu">
                                    <ul class="nav">
                                        <li><a class="active" data-toggle="tab" href="#informasi">Informasi</a> </li>
                                        {{-- <li><a data-toggle="tab" href="#transaksi">Transaksi</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="informasi">
                                        <div class="card col-md-12 p-0">
                                            <div class="card-header">
                                                Informasi
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">{{$user->user_store}} Etalase</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list-group list-group-flush">
                                                            <?php 
                                                                $shipment = App\Models\Shipment::whereIn('id', $user->user_shipment()->pluck('user_shipment_shipment_id')->toArray())->pluck('shipment_name')->toArray();
                                                            ?>
                                                            <li class="list-group-item">Sejak : {{FunctionLib::date_indo($user->created_at, true, 'full')}}</li>
                                                            <li class="list-group-item">Total Produk : {{FunctionLib::count_produk("", $user->id)}}</li>
                                                            <li class="list-group-item">Produk Terjual : {{FunctionLib::count_sell($user->id, 'sell')}}</li>
                                                            <li class="list-group-item">Transaksi Success : {{FunctionLib::count_sell($user->id)}}</li>
                                                            <li class="list-group-item">Kurir : {{implode (", ", $shipment)}}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-7 offset-md-1">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="review-items">
                                                                <div class="review-img" style="border:none">
                                                                    <img style="" src="{{asset("assets/images/profil/".$user->user_detail->user_detail_image)}}" onerror="this.src='{{asset('assets/images/profil/nopic.png')}}'" />
                                                                </div>
                                                                <div class="review-content">
                                                                    <i>
                                                                        Alamat : {{FunctionLib::user_address($user->id)}}<br/>
                                                                        Slogan Pemilik Toko : {{$user->user_slogan}}
                                                                    </i>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <a class="btn btn-success btn-block" href="{{route('member.message.create', $user->username)}}">
                                                                    Kirim Pesan
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="transaksi">
                                        <div class="card col-md-12 p-0">
                                            <div class="card-header">
                                                Transaksi
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Penjualan Toko {{$user->user_store}}</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-3 col-sm-4 col-12">
                                {!! Form::open([
                                    'method' => 'GET',
                                    'id' => 'form-etalase',
                                    'files' => true
                                ]) !!}
                                    <select name="order" class="select-style" id="order">
                                        <option disabled selected>Order by</option>
                                        <option value="produk_name">Nama</option>
                                        <option value="produk_price">Harga</option>
                                    </select>
                                {!! Form::close() !!}
                            </div>
                            <div class=" col-lg-5 col-sm-5 col-12">
                                <p class="total-product">
                                    {{($produk->currentPage() - 1) * $produk->perPage() + 1}}-
                                    {{$produk->perPage() * $produk->currentPage()}} 
                                    dari {{$produk->count()}} Data
                                </p>
                            </div>
                            <div class="col-lg-4 col-12 col-sm-3">
                                <ul class="nav shop-menu">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#grid"><i class="fa fa-th"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#list"><i class="fa fa-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="grid">
                                <div class="row">
                                        @foreach ($produk as $p)
                                    <div class="col-lg-3 col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                <span class="new sale">Sale</span>
                                                <img class="" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                                                {{-- <img class="second second2" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt=""> --}}
                                                <!-- <div class="shop-icon">
                                                    <ul>
                                                        {{-- <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li> --}}
                                                        <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $p->id)}}><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="{{route('detail', $p->produk_slug)}}"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="product-content tambahan">
                                                <h3>
                                                    <a href="{{route('detail', $p->produk_slug)}}">{{str_limit($p->produk_name, 15)}}</a>
                                                    <a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $p->id)}}><i class="fa fa-heart pull-right"></i></a>
                                                    <a href="{{route("detail", $p->produk_slug)}}"><i class="fa fa-eye pull-right"></i></a>
                                                </h3>
                                                @if($p->produk_discount > 0)
                                                    <p>
                                                        <del>{{FunctionLib::number_to_text($p->produk_price)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}}%</span><br>
                                                        <span>Rp. {{FunctionLib::number_to_text($p->produk_price - ($p->produk_price * $p->produk_discount / 100))}}</span>
                                                    </p>
                                                @else
                                                    <p><span>Rp. {{FunctionLib::number_to_text($p->produk_price)}}</span></p>
                                                @endif
                                                <!-- <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul> -->
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    <div class="col-12">
                                        {!! $produk->appends(['order' => Request::get('order')])->render() !!}
                                        {{-- <div class="pagination-wrapper text-center">
                                            <ul class="page-numbers">
                                                <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                <li><a class="page-numbers" href="#">1</a></li>
                                                <li><span class="page-numbers current">2</span></li>
                                                <li><a class="page-numbers" href="#">3</a></li>
                                                <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="list">
                                <div class="product-list">
                                    <div class="row">
                                        @foreach ($produk as $p)
                                            <div class="col-lg-6">
                                                <div class="product-wrap">
                                                    <div class="product-img black-opacity">
                                                        <span class="new sale">Sale</span>
                                                        <img class="" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                                                        {{-- <img class="second" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt=""> --}}
                                                        <div class="shop-icon">
                                                            <ul>
                                                                <li><a href="#" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $p->id)}}><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="{{route('detail', $p->produk_slug)}}"><i class="fa fa-eye"></i></a></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="shop.html">{{$p->produk_name}}</a></h3>
                                                        @if($p->produk_discount > 0)
                                                            <p>
                                                                <span>Rp. {{FunctionLib::number_to_text($p->produk_price - ($p->produk_price * $p->produk_discount / 100))}}</span>
                                                                <del>Rp. {{FunctionLib::number_to_text($p->produk_price)}}</del>
                                                            </p>
                                                        @else
                                                            <p><span>Rp. {{FunctionLib::number_to_text($p->produk_price)}}</span></p>
                                                        @endif
                                                        <!-- <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul> -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-12">
                                            {!! $produk->appends(['order' => Request::get('order')])->render() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#order').change(function(){
            $('#form-etalase').submit();
        })
    </script>
@endsection
{!! (isset($footer_script))? $footer_script:'' !!}