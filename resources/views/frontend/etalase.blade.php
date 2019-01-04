@extends('layouts.index', ['active' => 'etalase'])
@section('title', 'Etalase')
@section('content')
<!-- breadcumb-area end -->
    <div class="about-area mb-30">
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
    </div>
    <div class="container">
    <div class="col-lg-12 col-md-8 col-12">
        <div class="shop-area">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">products</h2>
                </div>
            </div>
            
            <div class="product-active owl-carousel next-prev-style">
                @foreach ($produk as $p)
                <div class="product-wrap">
                    <div class="product-img black-opacity">
                        <span class="new">New</span>
                        <img class="first" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                        <img class="second" src="{{ asset('assets/images/product/'.$p->produk_image) }}" alt="">
                        <div class="shop-icon">
                            <ul>
                                <li hidden><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{action('member\\FrontController@detail', $p->produk_category_id)}}"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="product-content">
                        <h3><a href="shop.html">{{$p->produk_name}}</a></h3>
                        <p><span><?php echo ($p->produk_price * $p->produk_discount);?></span>
                            <del>{{$p->produk_price}}</del>
                        </p>
                        <ul class="rating">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-o"></i></li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="single-product-menu">
                <ul class="nav">
                    <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                    <li><a data-toggle="tab" href="#faq">Faq</a></li>
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
                                    <h3><a href="#"></a></h3>
                                    <span></span>
                                    <p></p>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
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
                        
                                <div class="row">
                                    <div class="col-12">
                                            <input name="review_user_id" type="text" value="" placeholder="Your name here..." hidden />
                                            <input name="review_produk_id" type="text" value="" placeholder="Your name here..." hidden />
                                            <div class="col-12">
                                                <h4>Your Review:</h4>
                                                <textarea name="review_text" class="form-control" id="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn-style">Submit</button>
                                            </div>
                                        
                                    </div>
                                </div>
                           
                    </div>
                </div>
                <div class="tab-pane" id="diskusi">
                    <div class="faq-wrap" id="accordion">
                        
                            <div class="card">
                                <div class="card-header" id="headdiscuss">
                                    <h5><button data-toggle="collapse" data-target="#discuss" aria-expanded="true" aria-controls="collapseOne"></button> </h5>
                                </div>
                                <div id="discuss" class="collapse show" aria-labelledby="headdiscuss" data-parent="#accordion">
                                    <br/>
                                    <ul class="ml-2">
                                        <li class="review-items">
                                            <div class="review-img">
                                                <img src="{{asset('assets/images/profil/nopic.png')}}" alt="">
                                            </div>
                                            <div class="review-content">
                                                <h3><a href="#"></a></h3>
                                                <span></span>
                                                <p></p>
                                            </div>
                                            <hr/>
                                                
                                                    <ul class="ml-5">
                                                        <li class="review-items">
                                                            <div class="review-img">
                                                                <img src="{{asset('assets/images/profil/nopic.png')}}" alt="">
                                                            </div>
                                                            <div class="review-content">
                                                                <h3><a href="#"></a></h3>
                                                                <span></span>
                                                                <p></p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                
                                            <hr/>
                                        </li>
                                    </ul>
                                    <br/>
                                </div>
                            </div>
                        
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
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}