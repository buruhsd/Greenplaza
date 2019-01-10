@extends('frontend.layout.indexall')
@section('content')
    <!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap">
                        <div class="breadcumb-content black-opacity" style="background-image: url({{asset('assets/images/bg_etalase/'.$detail->user->user_detail->user_detail_image)}})">
                            <h2>Halaman Pembelian</h2>
                            <ul>
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- .shop-page-area start -->
    <div class="shop-single-area">
        <div class="container">
            <div class="row revarce-wrap">
                <div class="col-lg-3 col-sm-6 col-12">
                    <aside class="sidebar-area bg-1">
                        <div class="widget widget_search">
                            <h2 class="section-title">Search Product</h2>
                            <form action="#" class="searchform">
                                <input type="text" name="s" placeholder="Search Product...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_categories">
                            <h2 class="section-title">Categories</h2>
                            <ul>
                                @foreach($side_cat as $item)
                                    <li><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a></li>
                                @endforeach
                                {{-- <li><a href="#">Furniture</a></li>
                                <li><a href="#">Chair & Table</a></li>
                                <li><a href="#">Comfortable Sofa</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">House Decoration</a></li>
                                <li><a href="#">Kitchen</a></li> --}}
                            </ul>
                        </div>
                        <div class="product-sidebar">
                            <h2 class="section-title">Related Product</h2>
                            <div class="slidebar-product-wrap">
                                @foreach($side_related as $item)
                                    <div class="product-sidebar-items fix">
                                        <div class="product-sidebar-img">
                                            <img class="h100 w100" style="border-radius: 50%;" src="{{ asset('assets/images/product/'.$item->produk_image) }}" alt="" />{{-- assets/images/product/sidebar/24.jpg" alt=""> --}}
                                        </div>
                                        <div class="product-sedebar-content fix">
                                            <h4><a href="{{route('detail', $item->produk_slug)}}">{{$item->produk_name}}</a></h4>
                                            <ul class="rating">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <p>
                                                @if($item->produk_discount > 0)
                                                    Rp. {{FunctionLib::number_to_text($item->produk_price - ($item->produk_price * $item->produk_discount / 100))}}&nbsp;/&nbsp;
                                                    <del class="text-danger">Rp. {{FunctionLib::number_to_text($item->produk_price)}}</del>
                                                @else
                                                    Rp. {{FunctionLib::number_to_text($item->produk_price)}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="tag-wrap">
                            <h2 class="section-title">Propular Tags</h2>
                            <ul>
                                <li><a href="#">ecommerce</a></li>
                                <li><a href="#">product</a></li>
                                <li><a href="#">man</a></li>
                                <li><a href="#">fan</a></li>
                                <li><a href="#">woman</a></li>
                                <li><a href="#">kids</a></li>
                                <li><a href="#">babys</a></li>
                                <li><a href="#">pant</a></li>
                                <li><a href="#">kids</a></li>
                                <li><a href="#">babys</a></li>
                                <li><a href="#">pant</a></li>
                                <li><a href="#">chair</a></li>
                                <li><a href="#">table</a></li>
                            </ul>
                        </div> --}}
                    </aside>
                </div>
                <div class="col-12 col-lg-9 col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="product-single-img">
                                    <div class="product-single-active owl-carousel">
                                        @foreach($detail->images as $image)
                                            <div class="item black-opacity">
                                                <img class="h400" src="{{ asset('assets/images/product/'.$image->produk_image_image) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="product-thumbnil-active  owl-carousel">
                                        @foreach($detail->images as $image)
                                            <div class="item black-opacity">
                                                <img class="h100" src="{{ asset('assets/images/product/'.$image->produk_image_image) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-12">
                                <div class="product-single-content">
                                    <h3>{{ucfirst(strtolower($detail->produk_name))}}</h3>
                                    <div class="rating-wrap fix">
                                        {{-- <span class="pull-left">$219.56</span> --}}
                                        @if($detail->produk_discount > 0)
                                            <span class="pull-left">Rp. {{FunctionLib::number_to_text($detail->produk_price - ($detail->produk_price * $detail->produk_discount / 100))}}&nbsp;/&nbsp;</span>
                                            <del class="text-danger">Rp. {{FunctionLib::number_to_text($detail->produk_price)}}</del>
                                        @else
                                            <span class="pull-left">Rp. {{FunctionLib::number_to_text($detail->produk_price)}}</span>
                                        @endif
                                        <ul class="rating pull-right">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li>(05 Customar Review)</li>
                                        </ul>
                                    </div>
                                        {{$detail->produk_note}}
                                    <ul class="cetagory">
                                        <li>Categories:</li>
                                        <li><a href="{{url('category?cat='.$detail->category->category_slug)}}">{{ucfirst(strtolower($detail->category->category_name))}}</a></li>
                                    </ul>
                                    {{-- <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized.</p> --}}
                                    {!! Form::open(['url' => route('addchart', $detail->id), 'method' => 'POST', 'id' => 'form-shipment']) !!}
                                    @csrf
                                    @guest
                                        <div class="col-md-12" style="margin-bottom: 2%">
                                            <center>
                                                <div class="col-12">
                                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.login")}} value="Login" class="btn btn-info btn-sm col-12" id="btn-pick-address" />
                                                </div>
                                            </center>
                                        </div>
                                    @else
                                    <input type="text" name="address_id" id="address_id" value="{{Auth::user()->user_address()->first()['id']}}" hidden/>
                                    <input type="text" name="ship_cost" id="ship_cost" value="0" hidden/>
                                    <input type="text" name="origin" id="origin" value="{{$detail->user->user_address()->first()['user_address_subdist']}}" hidden/>
                                    <input type="text" name="originType" id="originType" value="subdistrict" hidden/>
                                    <input type="text" name="destination" id="destination" value="{{Auth::user()->user_address()->first()['user_address_subdist']}}" hidden/>
                                    <input type="text" name="destinationType" id="destinationType" value="subdistrict" hidden/>
                                    <input type="text" name="weight" value="{{$detail->produk_weight}}" hidden/>
                                    <input type="text" name="lenght" value="{{$detail->produk_length}}" hidden/>
                                    <input type="text" name="width" value="{{$detail->produk_wide}}" hidden/>
                                    <ul class="input-style">
                                        <li class="quantity cart-plus-minus">
                                            <input type="text" name="qty" value="1" />
                                        </li>
                                        <li>
                                            <a href="#" onclick="$('#form-shipment').submit();">Add to Cart</a>
                                        </li>
                                    </ul>
                                    <div class="col-md-12 " style="margin-bottom: 2%">
                                        <center>
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.pickaddress", ['id' => Auth::id()])}} value="Choose Address" class="btn btn-success btn-sm col-12" id="btn-pick-address" />
                                        </center>
                                    </div>
                                    <div class="col-md-12" id="address-info" style="margin-bottom: 2%">
                                        <ul style='width: 100%; margin-bottom: 2%'>
                                            <div class='col-lg-6 col-sm-12 col-md-12'>
                                                <b>To Address : {{Auth::user()->user_address()->first()['user_address_label']}}</b>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="col-md-12">
                                        <center>
                                            <select name="courier" class="form-control">
                                                @foreach($shipment_type as $item)
                                                    <option value="{{ strtolower($item->shipment_name) }}">{{$item->shipment_name}}</option>
                                                @endforeach
                                            </select>
                                        </center>
                                    </div>
                                    <div class="col-md-12" id="shipment-price" style="margin-bottom: 2%">
                                    </div>
                                    <div class="col-md-12" id="ship-cost" style="margin-bottom: 2%">
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 2%">
                                        <center>
                                            <input type="button" href="#" onclick='get_ongkir("{{$detail->id}}")' class="btn btn-success btn-sm col-12" value="Choose Shipment" id="btn-choose-shipment" />
                                        </center>
                                    </div>
                                    {{-- color and size --}}
                                    <?php $size = explode(',', $detail->produk_size);?>
                                    <?php 
                                        $color_arr = [
                                                'blue' => '#007bff',
                                                'orange' => '#ffc107',
                                                'red' => '#dc3545',
                                                'green' => '#28a745',
                                                'white' => '#ffffff',
                                            ];
                                        $color_arr = [
                                                'blue' => 'primary',
                                                'orange' => 'warning',
                                                'red' => 'danger',
                                                'green' => 'success',
                                                'white' => 'default',
                                            ];
                                        $color = explode(',', $detail->produk_color);
                                    ?>
                                    <div class="color-plate {{ $errors->has('color') ? 'has-error' : ''}}">
                                        {!! Form::label('color', 'Color : ', ['class' => 'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                            <div class="" data-toggle="buttons">
                                                @foreach($color as $item)
                                                    {{-- <label class="btn btn-default btn-block btn-{!!$color_arr[$item]!!}" >
                                                        <input type="radio" name="color" value="{{$item}}" autocomplete="off">
                                                        {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                    </label> --}}
                                                    <label class="border1 btn btn-default" style="background-color: {!! $item !!}">
                                                        <input type="radio" name="color" value="{{$item}}" autocomplete="off">
                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-size {{ $errors->has('size') ? 'has-error' : ''}}">
                                        {!! Form::label('size', 'Size : ', ['class' => 'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                            <div class="btn-group" data-toggle="buttons">
                                                @foreach($size as $item)
                                                    <label class="border1 btn btn-default">
                                                        <input type="radio" name="size" value="{{$item}}" autocomplete="off">
                                                        {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 2%">
                                        <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $detail->id)}} value="Add to Wishlist" class="btn btn-info btn-sm btn-block" />
                                    </div>
                                    @endguest
                                    {!! Form::close() !!}
                                    {{-- <div class="color-plate">
                                        <p>Color:</p>
                                        <ul>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="product-size">
                                        <p>Size:</p>
                                        <ul>
                                            <li><a href="#">S</a></li>
                                            <li><a href="#">M</a></li>
                                            <li><a href="#">L</a></li>
                                            <li><a href="#">XL</a></li>
                                        </ul>
                                    </div> --}}
                                    <ul class="socil-icon">
                                        <li>Share :</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="single-product-menu">
                                    <ul class="nav">
                                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                                        {{-- <li><a data-toggle="tab" href="#tag">Faq</a></li> --}}
                                        <li><a data-toggle="tab" href="#review">Review</a></li>
                                        <li><a data-toggle="tab" href="#diskusi">Diskusi Produk</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="description-wrap">
                                            {{$detail->produk_note}}
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane" id="tag">
                                        <div class="faq-wrap" id="accordion">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingfive">
                                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                                </div>
                                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="tab-pane" id="review">
                                        <div class="review-wrap">
                                            <ul>
                                                @foreach($review as $item)
                                                <li class="review-items">
                                                    <div class="review-img">
                                                        <img src="{{ asset('assets/images/profil/'.$item->user->user_detail->user_detail_image) }}" alt="">
                                                        {{-- <img src="assets/images/comment/1.png" alt=""> --}}
                                                    </div>
                                                    <div class="review-content">
                                                        <h3><a href="#">{{$item->user->name}}</a></h3>
                                                        <span>{{$item->created_at}}</span>
                                                        <p>{{$item->review_text}}</p>
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="add-review">
                                            <h4>Add A Review</h4>
                                            <div class="ratting-wrap">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>task</th>
                                                            <th>1 Star</th>
                                                            <th>2 Star</th>
                                                            <th>3 Star</th>
                                                            <th>4 Star</th>
                                                            <th>5 Star</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Stars</td>
                                                            <td>
                                                                <input type="radio" name="stars" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="stars" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="stars" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="stars" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="stars" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @guest
                                            @else
                                                @if(!Auth::user()->is_superadmin())
                                                    <div class="row">
                                                        <div class="col-12">
                                                            {!! Form::open(['url' => route('member.review.store'), 'method' => 'POST', 'id' => 'form-review', 'class' => 'row']) !!}
                                                                <input name="review_user_id" type="text" value="{{Auth::id()}}" placeholder="Your name here..." hidden />
                                                                <input name="review_produk_id" type="text" value="{{$detail->id}}" placeholder="Your name here..." hidden />
                                                                <div class="col-12">
                                                                    <h4>Your Review:</h4>
                                                                    <textarea name="review_text" class="form-control" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <button type="submit" class="btn-style">Submit</button>
                                                                </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endguest
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="diskusi">
                                        <div class="faq-wrap" id="accordion">
                                            @foreach($discuss as $item)
                                                <div class="card">
                                                    <div class="card-header" id="headdiscuss{{$item->id}}">
                                                        <h5><button data-toggle="collapse" data-target="#discuss{{$item->id}}" aria-expanded="true" aria-controls="collapseOne">{{$item->user['name']}}</button> </h5>
                                                    </div>
                                                    <div id="discuss{{$item->id}}" class="collapse show" aria-labelledby="headdiscuss{{$item->id}}" data-parent="#accordion">
                                                        <br/>
                                                        <ul class="ml-2">
                                                            <li class="review-items">
                                                                <div class="review-img">
                                                                    <img src="{{asset('assets/images/profil/nopic.png')}}" alt="">
                                                                </div>
                                                                <div class="review-content">
                                                                    <h3><a href="#">{{$item->user['name']}}</a></h3>
                                                                    <span>{{$item->created_at}}</span>
                                                                    <p>{{$item->produk_discuss_text}}</p>
                                                                </div>
                                                                <hr/>
                                                                    @foreach($item->reply as $item)
                                                                        <ul class="ml-5">
                                                                            <li class="review-items">
                                                                                <div class="review-img">
                                                                                    <img src="{{asset('assets/images/profil/nopic.png')}}" alt="">
                                                                                </div>
                                                                                <div class="review-content">
                                                                                    <h3><a href="#">{{$item->user['name']}}</a></h3>
                                                                                    <span>{{$item->created_at}}</span>
                                                                                    <p>{{$item->produk_discuss_reply_text}}</p>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    @endforeach
                                                                <hr/>
                                                            </li>
                                                        </ul>
                                                        <br/>
                                                    </div>
                                                </div>
                                            @endforeach
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
    <!-- .shop-page-area enc -->
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
    <script type="text/javascript">
        function get_ongkir(){
            var text = $("#btn-choose-shipment").val();
            $("#btn-choose-shipment").val("Loading");
            $.ajax({
                type: "POST", // or post?
                url: "{{route("localapi.content.choose_shipment", $detail->id)}}", // change as needed
                data: $("#form-shipment").serialize(), // change as needed
                success: function(data) {
                    if (data) {
                        $('#shipment-price').empty().append(data);
                    } else {
                        swal({   
                            type: "error",
                            title: "failed",   
                            text: "Layanan Tidak Tersedia",   
                            showConfirmButton: false ,
                            showCloseButton: true,
                            footer: ''
                        });
                    }
                    $("#btn-choose-shipment").val(text);
                },
                error: function(xhr, textStatus) {
                    swal({
                        type: "error",
                        title: "failed",   
                        text: "Layanan Tidak Tersedia",   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                    $("#btn-choose-shipment").val(text);
                }
            });
        }
        function change_ongkir(service, ongkir){
            var html = "<ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-12 col-sm-12 col-md-12'><b>Shipping : "+service+"</b></div></ul>";
            html += "<ul><div class='col-lg-12 col-sm-12 col-md-12'><b>Shipping Cost : "+ongkir+"</b></div></ul>";
            $("#shipment-price").empty();
            $("#ship-cost").empty().append(html);
            $('#ship_cost').attr('value', ongkir);
            console.log(service, ongkir);
        }
        function use_address(id, address_name, city, subdistrict){
            console.log(city, subdistrict);
            $('#address_id').attr('value', id);
            $('#address_id').attr('value', id);
            $('#destinationType').attr('value', 'subdistrict');
            $('#destination').attr('value', subdistrict);
            var html = "<ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-12 col-sm-12 col-md-12'><b>To Address : "+address_name+"</b></div></ul>";
            $("#address-info").empty().append(html);
        }
    </script>
@endsection
