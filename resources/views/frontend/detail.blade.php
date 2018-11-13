@extends('layouts.index')
@section('title', 'Page Title')
@section('content')
<!-- .shop-page-area start -->
    <div class="shop-single-area">
        <div class="container">
            <div class="row revarce-wrap">
                <div class="col-9 col-lg-9 col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="product-single-img">
                                    <div class="product-single-active owl-carousel">
                                        <div class="item black-opacity">
                                            <img src="{{ asset('img_produk/'.$detail->produk_image) }}" alt="">
                                        </div>
                                        <p>{{$detail->produk_image}}</p>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/2.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/3.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/4.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/5.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/6.jpg') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="product-thumbnil-active  owl-carousel">
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/1.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/2.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/3.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/4.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/5.jpg') }}" alt="">
                                        </div>
                                        <div class="item black-opacity">
                                            <img src="{{ asset('frontend/images/product/product-details/6.jpg') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-12">
                                <div class="product-single-content">
                                    <h3><a href="{{action('member\\FrontController@etalase', $detail->user->id)}}"> {{$detail->user->user_store}}</h3>
                                    <div class="rating-wrap fix">
                                        <span class="pull-left">{{$detail->produk_price}}</span>
                                        <ul class="rating pull-right">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li>(05 Customar Review)</li>
                                        </ul>
                                    </div>
                                    <p>{{$detail->produk_note}}</p>
                                    <ul class="input-style">
                                        <li class="quantity cart-plus-minus">
                                            <input type="text" value="1" />
                                        </li>
                                        <li><a href="cart.html">Add to Cart</a></li>
                                    </ul>
                                    <ul class="cetagory">
                                        <li>Categories:</li>
                                        <li><a href="#">Chair,</a></li>
                                        <li><a href="#">Sitting</a></li>
                                    </ul>
                                    <div class="color-plate">
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
                                    </div>
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
                                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                                        <li><a data-toggle="tab" href="#review">Review</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="description">
                                        <div class="description-wrap">
                                            <p>we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. </p>
                                            <p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tag">
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
                                    <div class="tab-pane" id="review">
                                        <div class="review-wrap">
                                            <ul>
                                                <li class="review-items">
                                                    <div class="review-img">
                                                        <img src="assets/images/comment/1.png" alt="">
                                                    </div>
                                                    <div class="review-content">
                                                        <h3><a href="#">GERALD BARNES</a></h3>
                                                        <span>27 Jun, 2018 at 2:30pm</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="review-items review-items2">
                                                    <div class="review-img">
                                                        <img src="assets/images/comment/2.png" alt="">
                                                    </div>
                                                    <div class="review-content">
                                                        <h3><a href="#">Candle Stand</a></h3>
                                                        <span>15 may, 2018 at 2:30pm</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li class="review-items">
                                                    <div class="review-img">
                                                        <img src="assets/images/comment/3.png" alt="">
                                                    </div>
                                                    <div class="review-content">
                                                        <h3><a href="#">Flower Vase</a></h3>
                                                        <span>14 janu, 2018 at 2:30pm</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                                        <ul class="rating">
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star"></i></li>
                                                            <li><i class="fa fa-star-o"></i></li>
                                                        </ul>
                                                    </div>
                                                </li>
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
                                                            <td>Price</td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Value</td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Quality</td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                            <td>
                                                                <input type="radio" name="a" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <h4>Name:</h4>
                                                    <input type="text" placeholder="Your name here..." />
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <h4>Email:</h4>
                                                    <input type="email" placeholder="Your Email here..." />
                                                </div>
                                                <div class="col-12">
                                                    <h4>Your Review:</h4>
                                                    <textarea name="massage" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn-style">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <li><a href="#">Furniture</a></li>
                                <li><a href="#">Chair & Table</a></li>
                                <li><a href="#">Comfortable Sofa</a></li>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">House Decoration</a></li>
                                <li><a href="#">Kitchen</a></li>
                            </ul>
                        </div>
                        <div class="product-sidebar">
                            <h2 class="section-title">Related Product</h2>
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/24.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Floral Print Buttoned</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/23.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Push It Messenger Bag</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/22.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Sprite Foam Yoga Brick</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/21.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="shop.html">Dual Handle Cardio Ball</a></h4>
                                        <ul class="rating">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <p>$20.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tag-wrap">
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
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- .shop-page-area enc -->
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}