@extends('frontend.layout.indexall')
@section('content')
<style>
/* Slideshow container */
.slideshow-container11 {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev11, .next11 {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next11 {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev11:hover, .next11:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text11 {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext11 {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot11 {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active11, .dot11:hover {
  background-color: #717171;
}

/* Fading animation */
.fade11 {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev11, .next11,.text11 {font-size: 11px}
}
</style>
    <!-- breadcumb-area start -->
    <div class="breadcumb-area req-all">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap">
                        <div class="breadcumb-content black-opacity" style="background-image: url('{{asset('assets/images/bg_etalase/'.$detail->user->user_detail->user_detail_image)}}'), url('{{asset('assets/images/bg_etalase/nopic.jpg')}}')">
                            <h2>Purchase Page</h2>
                            <ul>
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li>Product</li>
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
                {!!Plugin::view('side_left', ['id'=>$detail->category->id])!!}
                <div class="col-12 col-lg-9 col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="product-single-img">
                               
                                    <div class="product-single-active owl-carousel">
                                        @foreach($detail->images as $image)
                                            <a onclick="modalasdf()"> <div class="item black-opacity zoom">
                                                 <img class="h400" src="{{ asset('assets/images/product/'.$image->produk_image_image) }}" alt=""  class="hover-shadow cursor">
                                            </div>
                                            </a>                                        
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
                                    @if($detail->user->seller_active())
                                    <h5><a href="{{route('etalase', $detail->user->user_slug)}}">
                                    <center>{{$detail->user->user_store}} Shop</center></a></h5>
                                    @endif
                                    <div class="rating-wrap fix">
                                        <!-- <span class="pull-left">$219.56</span> -->
                                        @if ($detail->user->user_detail->country_id == 108)
                                          @if ($detail->produk_discount != 0)
                                                <p>
                                                    <del>MYR.{{FunctionLib::number_to_text($detail->produk_price, 2)}}</del><span> </span>
                                                    <span class="pull-right" style="color:red">{{number_format($detail->produk_discount)}} %</span><br>
                                                    <span>MYR.{{FunctionLib::number_to_text($detail->produk_price-($detail->produk_price * $detail->produk_discount / 100))}}</span><br>
                                                    <span>Rp.{{FunctionLib::number_to_text($detail->produk_price * $myr - ( ($detail->produk_price * $myr) * $detail->produk_discount/ 100) ) }} <br> </span>
                                                    {{-- <span onclick="showPopover({{$detail->id}});" class="pull-right popo" id="pop{{$detail->id}}" title="{{$detail->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                        data-content="
                                                        Rp. {{FunctionLib::number_to_text($detail->produk_price - ($detail->produk_price * $detail->produk_discount/ 100) )}} <br>
                                                        MYR. {{FunctionLib::number_to_text($detail->produk_price * $myr - ( ($detail->produk_price * $myr) * $detail->produk_discount/ 100) ) }} <br>  " >
                                                        <i class="fa fa-bars"></i>
                                                    </span> --}}
                                                </p>
                                            @else
                                                <p>
                                                    <span>MYR.{{FunctionLib::number_to_text($detail->produk_price, 2)}}</span><br>
                                                    <span>Rp.{{FunctionLib::number_to_text($detail->produk_price * $myr)}}</span>
                                                    {{-- <span onclick="showPopover({{$detail->id}});" class="pull-right popo" id="pop{{$detail->id}}" title="{{$detail->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                        data-content="
                                                        Rp. {{FunctionLib::number_to_text($detail->produk_price)}} <br>
                                                        MYR. {{FunctionLib::number_to_text($detail->produk_price * $myr)}} <br>  " >
                                                        <i class="fa fa-bars"></i>
                                                    </span> --}}
                                                </p>
                                            @endif

                                        @elseif($detail->user->user_detail->country_id == 222)
                                          @if ($detail->produk_discount != 0)                
                                              <p>
                                                  <del>Rp.{{FunctionLib::number_to_text($detail->produk_price, 2)}}</del><span> </span>
                                                  <span class="pull-right" style="color:red">{{number_format($detail->produk_discount)}} %</span><br>
                                                  <span>Rp.{{FunctionLib::number_to_text($detail->produk_price-($detail->produk_price * $detail->produk_discount / 100))}}</span><br>
                                                  <span>MYR.{{FunctionLib::number_to_text($detail->produk_price / $myr - ( ($detail->produk_price / $myr) * $detail->produk_discount/ 100) ) }} <br> </span>
                                                  {{-- <span onclick="showPopover({{$detail->id}});" class="pull-right popo" id="pop{{$detail->id}}" title="{{$detail->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                      data-content="
                                                      Rp. {{FunctionLib::number_to_text($detail->produk_price - ($detail->produk_price * $detail->produk_discount/ 100) )}} <br>
                                                      MYR. {{FunctionLib::number_to_text($detail->produk_price * $myr - ( ($detail->produk_price * $myr) * $detail->produk_discount/ 100) ) }} <br>  " >
                                                      <i class="fa fa-bars"></i>
                                                  </span> --}}
                                              </p>
                                          @else
                                              <p>
                                                  <span>Rp.{{FunctionLib::number_to_text($detail->produk_price, 2)}}</span><br>
                                                  <span>MYR.{{FunctionLib::number_to_text($detail->produk_price / $myr)}}</span>
                                                  {{-- <span onclick="showPopover({{$detail->id}});" class="pull-right popo" id="pop{{$detail->id}}" title="{{$detail->produk_name}}" class="btn btn-lg btn-default"data-toggle="popover" data-html="true" 
                                                      data-content="
                                                      Rp. {{FunctionLib::number_to_text($detail->produk_price)}} <br>
                                                      MYR. {{FunctionLib::number_to_text($detail->produk_price * $myr)}} <br>  " >
                                                      <i class="fa fa-bars"></i>
                                                  </span> --}}
                                              </p>
                                          @endif
                                        @else
                                            <p> - </p>
                                        @endif  
                                        <ul class="rating pull-right">
                                            <!-- <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li> -->
                                            <li class="text-info">({{$review->count()}} Customar Review)</li>
                                        </ul>
                                    </div>
                                    <ul class="stock">
                                        <li>Stok : </li>
                                        <li>{{$detail->produk_stock}} <b>{{$detail->unit->produk_unit_name}}</b></li>
                                    </ul>
                                    <ul class="cetagory">
                                        <li>Categories:</li>
                                        <li><a href="{{url('category?cat='.$detail->category->category_slug)}}">{{ucfirst(strtolower($detail->category->category_name))}}</a></li>
                                    </ul>
                                    {!! Form::open(['url' => route('addchart', $detail->id), 'method' => 'POST', 'id' => 'form-shipment']) !!}
                                    @csrf
                                    @guest
                                        <div class="col-md-12" style="margin-bottom: 2%">
                                            <center>
                                                <div class="col-12">
                                                    <input type="button" onClick="showLoginModal()" value="Login" class="btn btn-info btn-sm col-12" />
                                                </div>
                                            </center>
                                        </div>
                                    @else
                                    <input type="text" name="address_id" id="address_id" value="{{Auth::user()->user_address()->first()['id']}}" hidden/>
                                    <input type="text" name="ship_service" id="ship_service" value="none" hidden/>
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
                                            <input type="text" name="qty" value="1" id="qty" />
                                        </li>
                                        <li>
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.addwishlist", $detail->id)}} value="Add to Wishlist" class="btn btn-info btn-sm btn-block" />
                                        </li>
                                    </ul>
                                    <div class="col-md-12 " style="margin-bottom: 2%">
                                        <center>
                                            <input type="button" onclick='modal_get($(this));' data-toggle='modal' data-method='get' data-href={{route("localapi.modal.pickaddress", ['id' => Auth::id()])}} value="Destination Address" class="btn btn-success btn-sm col-12" id="btn-pick-address" />
                                        </center>
                                    </div>
                                    <div class="col-md-12" id="address-info" style="margin-bottom: 2%">
                                        <ul style='width: 100%; margin-bottom: 2%'>
                                            <div class='col-lg-6 col-sm-12 col-md-12'>
                                                <b>Destination Address : {{Auth::user()->user_address()->first()['user_address_label']}}</b>
                                            </div>
                                        </ul>
                                    </div>
                                    @if($detail->user->user_shipment()->exists())
                                        <div class="col-md-12">
                                            <center>
                                                <select name="courier" class="form-control" id="courier">
                                                    @foreach($detail->user->user_shipment()->get() as $item)
                                                        <option value="{{ strtolower($item->shipment->shipment_name) }}">{{$item->shipment->shipment_name}}</option>
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
                                                <input type="button" href="#" onclick='get_ongkir("{{$detail->id}}")' class="btn btn-success btn-sm col-12" value="Service Courier" id="btn-choose-shipment" />
                                            </center>
                                        </div>
                                    @else
                                        <div class="col-md-12" style="margin-bottom: 2%">
                                            <center>
                                                <input type="button" href="#" class="btn btn-danger btn-sm col-12" id="btn-choose-shipment" value="Service Courier not avalaible" />
                                            </center>
                                        </div>
                                    @endif
                                    <!-- color and size -->
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
                                                    @if ($loop->first)
                                                        <label class="border1 btn btn-default active" style="background-color: {!! $item !!}">
                                                            <input type="radio" name="color" value="{{$item}}" autocomplete="off" checked >
                                                            <span class="check glyphicon glyphicon-ok"></span>
                                                        </label>
                                                    @else
                                                        <label class="border1 btn btn-default" style="background-color: {!! $item !!}">
                                                            <input type="radio" name="color" value="{{$item}}" autocomplete="off">
                                                            <span class="check glyphicon glyphicon-ok"></span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-size {{ $errors->has('size') ? 'has-error' : ''}}">
                                        {!! Form::label('size', 'Size : ', ['class' => 'col-md-12 control-label']) !!}
                                        <div class="col-md-12">
                                            <div class="" data-toggle="buttons">
                                                @foreach($size as $item)
                                                    @if ($loop->first)
                                                        <label class="border1 btn btn-default active">
                                                            <input type="radio" name="size" value="{{$item}}" autocomplete="off" checked>
                                                            {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                        </label>
                                                    @else
                                                        <label class="border1 btn btn-default">
                                                            <input type="radio" name="size" value="{{$item}}" autocomplete="off">
                                                            {{strtoupper($item)}} <span class="check glyphicon glyphicon-ok"></span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 2%">
                                        <input type="button" onclick="$('#form-shipment').submit();" value="Add to cart" class="btn btn-danger btn-sm btn-block" />
                                    </div>
                                    @endguest
                                    {!! Form::close() !!}
                                    <!-- <ul class="socil-icon">
                                        <li>Share :</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="single-product-menu">
                                    <ul class="nav">
                                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                                        <!-- <li><a data-toggle="tab" href="#tag">Faq</a></li> -->
                                        <li><a data-toggle="tab" href="#review">Review</a></li>
                                        <li><a data-toggle="tab" href="#diskusi">Produt Discution</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="description-wrap">
                                            <table class="table-responsive cart-wrap">
                                                <thead>
                                                </thead>
                                                <tbody>
                                                    @if($detail->is_grosir())
                                                        <tr class="accordion" id="accordiongrosir">
                                                            <td colspan="3">
                                                            @foreach($detail->grosir as $grosir)
                                                                <button class="btn btn-success btn-block btn-sm" type="button" data-toggle="collapse" data-target="#grosir{{$grosir->id}}" aria-expanded="false" aria-controls="grosir{{$grosir->id}}">Grosir {{$grosir->produk_grosir_start}} {{$detail->unit->produk_unit_name}}</button>
                                                            @endforeach
                                                            </td>
                                                            <td colspan="4">
                                                            @foreach($detail->grosir as $grosir)
                                                                <div class="collapse multi-collapse {!!($loop->first)?'show':''!!}" data-parent="#accordiongrosir" id="grosir{{$grosir->id}}">
                                                                    <div class="card card-body">
                                                                        <table>
                                                                            <tr>
                                                                                <th><b>From</b></th>
                                                                                <th><b>To</b></th>
                                                                                <th><b>Price</b></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{$grosir->produk_grosir_start}}</td>
                                                                                <td>{{$grosir->produk_grosir_end}}</td>
                                                                                <td>Rp. {{FunctionLib::number_to_text($grosir->produk_grosir_price)}}</td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <table class="table-responsive cart-wrap">
                                                <tr>
                                                    <!-- <td class="text-left">
                                                        <ul>
                                                            <li class="no-list-style">
                                                                Tinggi : {{$detail->produk_height}} mm
                                                            </li>
                                                            <li class="no-list-style">
                                                                Lebar : {{$detail->produk_wide}} mm
                                                            </li>
                                                            <li class="no-list-style">
                                                                Panjang : {{$detail->produk_length}} mm
                                                            </li>
                                                            <li class="no-list-style">
                                                                Berat : {{$detail->produk_weight}} Gram
                                                            </li>
                                                        </ul>
                                                    </td> -->
                                                </tr>
                                                <tr>
                                                    <td class="text-left">
                                                        {{$detail->produk_note}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="tab-pane" id="tag">
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
                                    </div> -->
                                    <div class="tab-pane" id="review">
                                        <div class="review-wrap">
                                            <ul>
                                                @foreach($review as $item)
                                                <li class="review-items">
                                                    <div class="review-img">
                                                        <img src="{{ asset('assets/images/profil/'.$item->user->user_detail->user_detail_image) }}" onerror="this.src='{{asset('assets/images/profil/nopic.png')}}'">
                                                        <!-- <img src="assets/images/comment/1.png" alt=""> -->
                                                    </div>
                                                    <div class="review-content">
                                                        <h3><a href="#">{{$item->user->name}}</a></h3>
                                                        <span>{{$item->created_at}}</span>
                                                        @if($item->review_stars == 1)
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            @elseif($item->review_stars ==2)
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            @elseif($item->review_stars == 3)
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            @elseif($item->review_stars == 4)
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            @elseif($item->review_stars == 5)
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                        @else
                                                        @endif
                                                        <p>{{$item->review_text}}</p>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="add-review">
                                            <!-- <h4>Add A Review</h4>
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
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="border1 btn btn-default active">
                                                                        <input type="radio" name="stars" value="1" autocomplete="off" checked>
                                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="border1 btn btn-default">
                                                                        <input type="radio" name="stars" value="2" autocomplete="off">
                                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="border1 btn btn-default">
                                                                        <input type="radio" name="stars" value="3" autocomplete="off">
                                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="border1 btn btn-default">
                                                                        <input type="radio" name="stars" value="4" autocomplete="off">
                                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" data-toggle="buttons">
                                                                    <label class="border1 btn btn-default">
                                                                        <input type="radio" name="stars" value="5" autocomplete="off">
                                                                        <span class="check glyphicon glyphicon-ok"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> -->
                                            <!-- @guest
                                            @else
                                                @if(!Auth::user()->is_superadmin())
                                                    <div class="row">
                                                        <div class="col-12">
                                                            {!! Form::open(['url' => route('member.review.store'), 'method' => 'POST', 'id' => 'form-review', 'class' => 'row']) !!}
                                                                <input name="review_user_id" type="text" value="{{Auth::id()}}" placeholder="Your name here..." hidden />
                                                                <input name="review_produk_id" type="text" value="{{$detail->id}}" placeholder="Your name here..." hidden />
                                                                <div class="col-12">
                                                                    <h4>Review Anda:</h4>
                                                                    <div class="product-size {{ $errors->has('size') ? 'has-error' : ''}}">
                                                                        <div class="col-md-12">
                                                                            <div class="btn-group" data-toggle="buttons">
                                                                                @for($no=1;$no<=5;$no++)
                                                                                    @if ($no == 1)
                                                                                        <label class="border1 btn btn-default active">
                                                                                            <input type="radio" name="stars" value="{{$no}}" autocomplete="off" checked>{{$no}} Stars<span class="check glyphicon glyphicon-ok"></span>
                                                                                        </label>
                                                                                    @else
                                                                                        <label class="border1 btn btn-default">
                                                                                            <input type="radio" name="stars" value="{{$no}}" autocomplete="off">{{$no}} Stars<span class="check glyphicon glyphicon-ok"></span>
                                                                                        </label>
                                                                                    @endif
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <textarea name="review_text" class="form-control" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <button type="submit" class="btn-style">Kirim</button>
                                                                </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endguest -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="diskusi">
                                        <div class="faq-wrap" id="accordion">
                                            @guest
                                            @else
                                            <div class="card">
                                                <div class="collapse show">
                                                    <br/>
                                                    {!! Form::open(['url' => route('member.produk.discuss.store'), 'method' => 'POST', 'id' => 'form-produk-discuss']) !!}
                                                    <ul class="ml-2">
                                                        <input type="hidden" class="btn btn-success" name="produk_id" value="{{$detail->id}}">
                                                        <li>
                                                            <div class="col-md-12">
                                                                <textarea name="discuss_text" class="form-control" id="massage" cols="2" rows="2" placeholder="Tulis disini..."></textarea>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col-md-12 mt-2">
                                                                <input type="submit" class="btn btn-success" name="" value="kirim">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <br/>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            @endguest
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
                                                                    <img src="{{asset('assets/images/profil/'.$item->user->user_detail->user_detail_image)}}" onerror="this.src='{{asset('assets/images/profil/nopic.png')}}'">
                                                                </div>
                                                                <div class="review-content">
                                                                    <h3><a href="#">{{$item->user['name']}}</a></h3>
                                                                    <span>{{FunctionLib::date_indo($item->created_at, true, 'full')}}</span>
                                                                    <p>{{$item->produk_discuss_text}}</p>
                                                                </div>
                                                                <hr/>
                                                                @foreach($item->reply as $item2)
                                                                    <ul class="ml-5">
                                                                        <li class="review-items">
                                                                            <div class="review-img">
                                                                                <img src="{{asset('assets/images/profil/'.$item2->user->user_detail->user_detail_image)}}" onerror="this.src='{{asset('assets/images/profil/nopic.png')}}'">
                                                                            </div>
                                                                            <div class="review-content">
                                                                                <h3><a href="#">{{$item2->user['name']}}</a></h3>
                                                                                <span>{{FunctionLib::date_indo($item2->created_at, true, 'full')}}</span>
                                                                                <p>{{$item2->produk_discuss_reply_text}}</p>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            @guest
                                                            @else
                                                                <hr/>
                                                                {!! Form::open(['url' => route('member.produk.discuss.reply.store'), 'method' => 'POST', 'id' => 'form-produk-discuss-reply']) !!}
                                                                <ul class="ml-5">
                                                                    <input type="hidden" class="btn btn-success" name="discuss_id" value="{{$item->id}}">
                                                                    <li>
                                                                        <div class="col-md-12">
                                                                            <textarea name="discuss_reply_text" class="form-control" id="massage" cols="2" rows="2" placeholder="balas disini..."></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="col-md-12 mt-2">
                                                                            <input type="submit" class="btn btn-success" name="" value="balas">
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                {!! Form::close() !!}
                                                            @endguest
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
    </div>
    <div class="modal fade11" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="slideshow-container11">
              <div class="slider-active owl-carousel next-prev-btn">
                @foreach($detail->images as $image)                                       
                     <img src="{{ asset('assets/images/product/'.$image->produk_image_image) }}" alt="" class="hover-shadow cursor">
                @endforeach
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
              $('#ship_service').attr('value', service);
              $('#ship_cost').attr('value', ongkir);
              // console.log(service, ongkir);
          }
          function use_address(id, address_name, city, subdistrict){
              $("#ajax-modal").modal("hide")
              // console.log(city, subdistrict);
              $('#address_id').attr('value', id);
              $('#address_id').attr('value', id);
              $('#destinationType').attr('value', 'subdistrict');
              $('#destination').attr('value', subdistrict);
              var html = "<ul style='width: 100%; margin-bottom: 2%'><div class='col-lg-12 col-sm-12 col-md-12'><b>To Address : "+address_name+"</b></div></ul>";
              $("#address-info").empty().append(html);
              empty_ongkir();
          }
          function empty_ongkir(){
              $("#ship-cost").empty();
              $('#ship_cost').attr('value', 0);
          }
          function changed(){
              $('#qty').on('change', function(){
                  empty_ongkir();
              });
              $('#courier').on('change', function(){
                  empty_ongkir();
              });
          }
          changed();

          function modalasdf(){
              $('#myModal').modal('show');
              $.ajax({
                  url : '{{url('detail_image_image')}}',
                  type: "GET",
                  dataType: "JSON",
                  success: function(data){
                    console.log(data);
                      data.forEach(function(entry) {
                          $('#myasdef').append('<div class="mySlides11 fade11"><div class="numbertext"></div><img src="/assets/images/product/'+entry.produk_image_image+'" style="width:100%"><div class="text11">Caption Text</div></div>');
                  });

                  }
              })
          }
          var slideIndex = 1;
          showSlides(slideIndex);

          function plusSlides(n) {
            showSlides(slideIndex += n);
          }

          function currentSlide(n) {
            showSlides(slideIndex = n);
          }

          function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides11");
            var dots = document.getElementsByClassName("dot11");
            if (n > slides.length) {slideIndex = 1}    
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
          }
              </script>
      <!-- lightbox -->
    
@endsection

<div style="padding: 0px" id="myModalLogin" class="modal fade" role="dialog">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <br>
            <div class="text-center">
               <div class="text-center">
                  <img class="dark-logo" src="{{ asset('frontend/images/logo-fix-2.png') }}" alt="" width="120px" height="40px">
               </div>
               <br>
            </div>
            <br> 
            <form action="#" id="formData" class="form-horizontal container col-md-12 col-md-offset-2" >
               <span id="feedbackdata"></span>
               @csrf
               <div class="form-group">
                  <label for="username">username GI</label>
                  <input type="text" class="form-control m-input remove-border-focus" name="email" />
                  <span id="feedbackusername"></span>
               </div>
               <div class="form-group">
                  <label for="password">password GI</label>
                  <input class="form-control m-input remove-border-focus" type="password" name="password"/>
                  <span id="feedbackpassword"></span>
               </div>
               <div style="font-size: 12px">belum punya akun? <a href="https://gicommunity.org/register"> daftar </a></div>
               <div class="pull-right" style="padding: 1.5rem 0;">
                  <a style="cursor: pointer; font-size: 14px; color: #fff" onclick="saveLogin()" class="btn btn-success btnsave">Masuk</a>&nbsp;&nbsp;&nbsp;&nbsp;
                  <a style="cursor: pointer; font-size: 14px;" class="btn btn-metal" data-dismiss="modal">Tutup</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
    <script>
        function showLoginModal(){
            $('.remove-border-focus').attr("style", "outline: 0px !important");
            $('.remove-border-focus').attr("style", "-webkit-appearance: none");
            $('.remove-border-focus').attr("style", "box-shadow: none !important");
            $('#myModalLogin').modal('show');
        }
        function saveLogin(){
            $('.btnsave').html("load...");
            $('.btnsave').addClass("disabled").prop('disabled', true);
            var dataString = $("#formData").serialize();
            $.ajax({
                url : "{{ url('/login_gi') }}",
                type: "POST",
                data: dataString,
                dataType: "JSON",
                success: function(data){
                 if(data.sucess){
                    location.reload();
                 }
                 (!data.error.email) ?
                 $("#feedbackusername").html('') : $("#feedbackusername").html('<span style="font-size: 12px; color: #ed5249">' + data.error.email[0] +'</span>');
                 (!data.error.password) ?
                 $("#feedbackpassword").html('') : $("#feedbackpassword").html('<span style="font-size: 12px; color: #ed5249">' + data.error.password[0] +'</span>');
                 (!data.error.data) ?
                 $("#feedbackdata").html('') : $("#feedbackdata").html('<div class="alert alert-danger text-center" role="alert">' + data.error.data +'</div>');
                 $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);

                },
                error: function (err){
                    console.log(err.error);
                    $('.btnsave').html("Masuk");
                 $('.btnsave').removeClass("disabled").prop('disabled', false);
                }
            });
        }
    </script>