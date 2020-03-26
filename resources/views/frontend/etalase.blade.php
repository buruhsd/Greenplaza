@extends('frontend.layout.indexall', ['active' => 'home'])
@section('title', 'etalase')
@section('content')
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity" style="background-image: url('/frontend/images/banner/cat.jpg')">
                            <h2>Hlaman Toko</h2>
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
                                        {{-- <li><a data-toggle="tab" href="#transaksi">Transaction</a></li> --}}
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
                                                 <?php $user  ?>
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="list-group list-group-flush">
                                                            <?php 
                                                                $shipment = App\Models\Shipment::whereIn('id', $user->user_shipment()->pluck('user_shipment_shipment_id')->toArray())->pluck('shipment_name')->toArray();
                                                            ?>
                                                            {{-- {{dd ($user->user_detail->country_id == 0) }} --}}
                                                            @if($user->user_detail->country_id == 0)
                                                                <li class="list-group-item">Negara :
                                                                 -
                                                                </li>
                                                            @elseif($user->user_detail->country_id == 222)
                                                                <li class="list-group-item">Negara :
                                                                 Indonesia
                                                                </li>
                                                            @elseif($user->user_detail->country_id == 108)
                                                                <li class="list-group-item">Negara :
                                                                 Malaysia
                                                                </li>
                                                            @else
                                                                <li class="list-group-item">Negara : - </li>
                                                            @endif
                                                            <li class="list-group-item">Sejak : {{FunctionLib::date_indo($user->created_at, true, 'full')}}</li>
                                                            <li class="list-group-item">Total Product : {{FunctionLib::count_produk("", $user->id)}}</li>
                                                            <li class="list-group-item">Product Terjual : {{FunctionLib::count_sell($user->id, 'sell')}}</li>
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
                                                                        Address : {{FunctionLib::user_address($user->id)}}<br/>
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
                                                <h5 class="card-title">Store Sales {{$user->user_store}}</h5>
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
                                        <option disabled selected>Berdasarkan</option>
                                        <option value="produk_name">Nama</option>
                                        <option value="produk_price">Harga</option>
                                    </select>
                                {!! Form::close() !!}
                            </div>
                            <div class=" col-lg-5 col-sm-5 col-12">
                                <p class="total-product">
                                    {{($produk->currentPage() - 1) * $produk->perPage() + 1}}-
                                    {{$produk->perPage() * $produk->currentPage()}} 
                                    Dari {{$produk->count()}} Data
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
                                    <div class="col-lg-2 col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                            <div class="product-img black-opacity" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                @if ($p->produk_stock == 0)
                                                    <div class="featured-content text-center">
                                                        <ul>
                                                            <li><a style="background-color: red; border: red; color: white;">Sold Out</a></li>
                                                        </ul>
                                                    </div>
                                                    @elseif($p->produk_discount == 0)
                                                        <span ></span>
                                                
                                                @else($p->produk_discount == 1)
                                                   <span class="new">sale</span>
                                                @endif
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
                                                

                    
                                        @if ($p->produk_discount != 0)
                                                <p>
                                                    <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</del><span> </span>
                                                        <span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                                                        <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span><br>
                                                        <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($p->price_myr - ( $p->price_myr * $p->produk_discount/ 100) ) }} </span><br>
                                                        <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text( ($p->produk_price - ( $p->produk_price * $p->produk_discount/ 100) )/$price_gln ) }} </span>
                                                    {{-- <span onclick="showPopover({{$n->id}});" class="pull-right popo" id="pop{{$n->id}}" title="{{$n->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                        data-content="
                                                        Rp. {{FunctionLib::number_to_text($n->produk_price - ($n->produk_price * $n->produk_discount/ 100) )}} <br>
                                                        MYR. {{FunctionLib::number_to_text($n->produk_price * $myr - ( ($n->produk_price * $myr) * $n->produk_discount/ 100) ) }} <br>  " >
                                                        <i class="fa fa-bars"></i>
                                                    </span> --}}
                                                </p>
                                            @else
                                                <p>
                                                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</span><br>
                                                    <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($p->price_MYR, 0)}}</span><br>
                                                    <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text($p->gln_coin ) }} <br> </span>

                                                    {{-- <span onclick="showPopover({{$n->id}});" class="pull-right popo" id="pop{{$n->id}}" title="{{$n->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                        data-content="
                                                        Rp. {{FunctionLib::number_to_text($n->produk_price)}} <br>
                                                        MYR. {{FunctionLib::number_to_text($n->produk_price * $myr)}} <br>  " >
                                                        <i class="fa fa-bars"></i>
                                                    </span> --}}
                                                </p>
                                            @endif
                                                
                                               
                                                <!-- <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul> -->
                                            </div>
                                            <!-- <div id="tooltip" role="tooltip">My tooltip</div> -->
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
                                                    <div class="product-content" onclick="javascript:window.location.href='{{route('detail', $p->produk_slug)}}'">
                                                        <h3><a href="{{route('detail', $p->produk_slug)}}">{{$p->produk_name}}</a></h3>
                                                        
                                                            <!-- @if($p->produk_discount > 0)
                                                                <p>
                                                                    <del>MYR.{{FunctionLib::number_to_text($p->produk_price * $myr, 2)}}</del><span> </span><span class="pull-right" style="color:red">{{number_format($p->produk_discount)}}%</span><br>
                                                                    <span>MYR. {{FunctionLib::number_to_text($p->produk_price * $myr - ( ($p->produk_price * $myr) * $p->produk_discount/ 100) ) }}</span><span> </span><span class="pull-right" data-toggle="popover" title="halo" data-popover-content="#a1" ><i class="fa fa-bars"></i></span>
                                                                </p>
                                                            @else
                                                                <p><span>MYR. {{FunctionLib::number_to_text($p->produk_price * $myr)}}</span><span> </span><span class="pull-right" data-toggle="popover" title="halo" data-popover-content="#a1" ><i class="fa fa-bars"></i></span></p>
                                                            @endif -->

                                                        
                                                        
                                                            @if ($p->produk_discount != 0)
                                                                <p>
                                                                    <del class="style-cost-discount-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</del><span> </span>
                                                                    <span class="pull-right" style="color:red">{{number_format($p->produk_discount)}} %</span><br>
                                                                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price-($p->produk_price * $p->produk_discount / 100))}}</span><br>
                                                                    <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($p->price_myr - ( $p->price_myr * $p->produk_discount/ 100) ) }} </span><br>
                                                                    <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text( ($p->produk_price - ( $p->produk_price * $p->produk_discount/ 100) )/$price_gln ) }} </span>
                                                                    {{-- <span onclick="showPopover({{$n->id}});" class="pull-right popo" id="pop{{$n->id}}" title="{{$n->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                                        data-content="
                                                                        Rp. {{FunctionLib::number_to_text($n->produk_price - ($n->produk_price * $n->produk_discount/ 100) )}} <br>
                                                                        MYR. {{FunctionLib::number_to_text($n->produk_price * $myr - ( ($n->produk_price * $myr) * $n->produk_discount/ 100) ) }} <br>  " >
                                                                        <i class="fa fa-bars"></i>
                                                                    </span> --}}
                                                                </p>
                                                            @else
                                                                <p>
                                                                    <span class="style-cost-item-front">Rp.{{FunctionLib::number_to_text($p->produk_price, 0)}}</span><br>
                                                                    <span class="style-cost-discount-item-front">MYR.{{FunctionLib::number_to_text($p->price_MYR, 0)}}</span><br>
                                                                    <span class="style-cost-discount-item-front">GLN.{{FunctionLib::number_to_text($p->gln_coin ) }} <br> </span>
                                                                    {{-- <span onclick="showPopover({{$n->id}});" class="pull-right popo" id="pop{{$n->id}}" title="{{$n->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                                        data-content="
                                                                        Rp. {{FunctionLib::number_to_text($n->produk_price)}} <br>
                                                                        MYR. {{FunctionLib::number_to_text($n->produk_price * $myr)}} <br>  " >
                                                                        <i class="fa fa-bars"></i>
                                                                    </span> --}}
                                                                </p>
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
    $("#initialIdSelectorMouseMove1" ).hover(
        function() {
         $(".pop-sending span").popover({
             placement : 'right',
             html : true,
         });
         $(".pop-target span").popover('show');
         }, 
        function() {
         $(".pop-target span").popover('hide');
        }
    );

    function showPopover(id){
        $(".popo").popover('hide');
        $("#pop"+id).popover('show');
        setTimeout(function(){ 
            $(".popo").popover('hide');
        }, 3000);
    }

</script>

<script type="text/javascript">
    $('#order').change(function(){
        $('#form-etalase').submit();
    })
</script>
@endsection