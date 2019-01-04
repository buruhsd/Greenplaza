@extends('layouts.index', ['active' => 'detail'])
@section('title', 'Detail')
@section('content')


<!-- .shop-page-area start -->
    <div class="shop-single-area">
        <div class="container">
            <div class="row">
                @include('layouts._flash')
                <div class="col-9 col-lg-9 col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="product-single-img">
                                    <div class="product-single-active owl-carousel">
                                        <div class="item black-opacity">
                                            <img src="{{ asset('assets/images/product/'.$detail->produk_image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="product-thumbnil-active  owl-carousel">
                                        @foreach($detail->images as $image)
                                            <div class="item black-opacity">
                                                    <img src="{{ asset('assets/images/product/'.$image->produk_image_image) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-12">
                                <div class="product-single-content">
                                    <h3><a href="{{action('member\\FrontController@etalase', $detail->user->user_store)}}">{{$detail->user->user_store}}</a></h3>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="pull-left">{{ucfirst(strtolower($detail->produk_name))}}</h5>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="rating-wrap fix" style="margin-bottom: 0">
                                        @if($detail->produk_discount > 0)
                                            <h3 class="pull-left">Rp. {{FunctionLib::number_to_text($detail->produk_price - ($detail->produk_price * $detail->produk_discount / 100))}}&nbsp;/&nbsp;</h3>
                                            <del class="text-danger">Rp. {{FunctionLib::number_to_text($detail->produk_price)}}</del>
                                        @else
                                            <h4 class="pull-left">Rp. {{FunctionLib::number_to_text($detail->produk_price)}}</h4>
                                        @endif
                                        {{-- <ul class="rating pull-right">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li>(05 Customar Review)</li>
                                        </ul> --}}
                                    </div>
                                    <ul style="width: 100%; margin-bottom: 2%">
                                        <li><h5>Stock : {{$detail->produk_stock}} </h5></li>
                                    </ul>
                                    {!! Form::open(['url' => route('addchart', $detail->id), 'method' => 'POST', 'id' => 'form-shipment']) !!}
                                    @csrf
                                    @guest
                                        <div class="col-md-12" style="margin-bottom: 2%">
                                            <center>
                                                <li class="col-12">
                                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.login")}} value="Login" class="btn btn-info btn-sm col-12" id="btn-pick-address" />
                                                </li>
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
                                        <div class="col-md-12">
                                            <center>
                                            <li class="quantity cart-plus-minus " style="width: 100%; margin-bottom: 2%">
                                                <input type="text" name="qty" value="1" />
                                            </li>
                                            </center>
                                        </div>
                                        <div class="col-md-12 " style="margin-bottom: 2%">
                                            <center>
                                                <li class="col-12">
                                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.pickaddress", ['id' => Auth::id()])}} value="Choose Address" class="btn btn-success btn-sm col-12" id="btn-pick-address" />
                                                </li>
                                            </center>
                                        </div>
                                        <div class="col-md-12" id="address-info" style="margin-bottom: 2%">
                                            <ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-6 col-sm-12 col-md-12'><b>To Address : {{Auth::user()->user_address()->first()['user_address_label']}}</b></div></ul>
                                        </div>
                                        <div class="col-md-12">
                                            <center>
                                                <li class="col-12">
                                                    <select name="courier" class="form-control">
                                                        @foreach($shipment_type as $item)
                                                            <option value="{{ strtolower($item->shipment_name) }}">{{$item->shipment_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </li>
                                            </center>
                                        </div>
                                        <div class="col-md-12" id="shipment-price" style="margin-bottom: 2%">
                                        </div>
                                        <div class="col-md-12" id="ship-cost" style="margin-bottom: 2%">
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 2%">
                                            <center>
                                                <li class="col-12">
                                                    <input type="button" href="#" onclick='get_ongkir("{{$detail->id}}")' class="btn btn-success btn-sm col-12" value="Choose Shipment" id="btn-choose-shipment" />
                                                </li>
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
                                        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('size') ? 'has-error' : ''}}">
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
                                        <div class="form-group mx-sm-3 mb-2 {{ $errors->has('color') ? 'has-error' : ''}}">
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
                                        <div class="col-md-12">
                                            <center>
                                                <li class="col-4">
                                                    <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $detail->id)}} value="Add to Wishlist" class="btn btn-info btn-sm" />
                                                </li>
                                                <li class="col-4">
                                                    <input type="button" onclick="$('#form-shipment').submit();" value="Add to Cart" class="btn btn-info btn-sm">
                                                </li>
                                            </center>
                                        </div>
                                    @endguest
                                    </ul>
                                    {!! Form::close() !!}
                                    <ul class="cetagory">
                                        <li>Categories:</li>
                                        <li><a href="{{url('category?cat='.$detail->category->category_slug)}}">{{ucfirst(strtolower($detail->category->category_name))}}</a></li>
                                    </ul>
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
                                    {{-- <ul class="socil-icon">
                                        <li>Share :</li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/icon/fb.png') }}"></i></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/icon/tw.png') }}"></i></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/icon/ig.png') }}"></i></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/icon/go.png') }}"></i></a></li>
                                        <li><a href="#"><img src="{{ asset('frontend/images/icon/yt.png') }}"></i></a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="single-product-menu">
                                    <ul class="nav">
                                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                                        {{-- <li><a data-toggle="tab" href="#faq">Faq</a></li> --}}
                                        <li><a data-toggle="tab" href="#review">Review</a></li>
                                        <li><a data-toggle="tab" href="#diskusi">Diskusi Produk</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="description-wrap">
                                            <h4>Keterangan</h4>
                                            {{$detail->produk_note}}
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="review">
                                        <div class="review-wrap">
                                            <ul>
                                                @foreach($review as $item)
                                                <li class="review-items">
                                                    <div class="review-img">
                                                        <img src="assets/images/comment/1.png" alt="">
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
                                    <div class="tab-pane" id="faq">
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
                                                <div class="card-header" id="headingTwo">
                                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingfour">
                                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                                </div>
                                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-12">
                    <aside class="sidebar-area bg-1">
                        <div class="widget widget_categories">
                            <h2 class="section-title">Categories</h2>
                            <ul>
                                @foreach($side_cat as $item)
                                    <li><a href="{{url('category?cat='.$item->category_slug)}}">{{ucfirst(strtolower($item->category_name))}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="product-sidebar">
                            <h2 class="section-title">Related Product</h2>
                            <div class="slidebar-product-wrap">
                                @foreach($side_related as $item)
                                    <div class="product-sidebar-items fix">
                                        <div class="product-sidebar-img black-opacity">
                                            <img src="assets/images/product/sidebar/24.jpg" alt="">
                                        </div>
                                        <div class="product-sedebar-content fix">
                                            <h4><a href="shop.html">{{$item->produk_name}}</a></h4>
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
                    </aside>
                </div>
            </div>
        </div>
    </div>
<div id="ajax-modal" class="modal" tabindex="-1" style="display: none;"></div>
    <!-- .shop-page-area enc -->
    <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog" style="margin-top: 5%">
      <div class="modal-content">
        <!-- Modal body -->
        <button type="button" class="close" data-dismiss="modal" style="color: green">&times;</button>
        <div class="modal-body" style="margin-top: 5%; margin-bottom: 3%">
            <center>Berhasil Menambahkan Produk ke Wishlist <i class="fa fa-heart"></i></center>
        </div>
      </div>
    </div>
  </div>
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
@section('script')
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js') }}"></script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') }}"></script>
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}