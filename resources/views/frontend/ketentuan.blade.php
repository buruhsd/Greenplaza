@extends('layouts.index')
@section('title', 'Page Title')
@section('content')
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    <!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Blog Details</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Blog Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- blog-details-area start-->
    <div class="blog-details-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="blog-details-wrap p-10 bg-1 mb-30">
                        <div class="blog-details-img black-opacity">
                            <img src="{{ asset('frontend/images/blog/blog-details.jpg') }}" alt="">
                        </div>
                        <h3>We Can Ensure Your Comfortable Life</h3>
                        <ul class="meta">
                            <li>19 JAN 2018</li>
                            <li>By Dr. John Darcy</li>
                        </ul>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                        <p>typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <ul class="list">
                            <li>Ever since the 1500s, when an unknown </li>
                            <li>Remaining essentially unchanged. </li>
                            <li>Ipsum has been the industry </li>
                            <li>It was popularised in the 1960s with </li>
                            <li>Printer took a galley of type and scrambled </li>
                        </ul>
                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <div class="row mb-30">
                            <div class="col-md-5 col-12 d-none d-md-block">
                                <img src="{{ asset('frontend/images/blog/blog-details2.jpg') }}" alt="">
                            </div>
                            <div class="col-md-7 col-12">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, </p>
                                <p class="mb-0">typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more</p>
                            </div>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                        <div class="share-wrap">
                            <div class="row">
                                <div class="col-sm-8 ">
                                    <ul class="socil-icon d-flex">
                                        <li>share it on :</li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <a href="javascript:void(0);">Next Post <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form-area p-10 bg-1">
                        <div class="comment-main">
                            <h3 class="section-title"><span>(03)</span>Comments:</h3>
                            <ol class="comments">
                                <li class="comment even thread-even depth-1">
                                    <div class="comment-wrap">
                                        <div class="comment-theme">
                                            <div class="comment-image">
                                                <img src="{{ asset('frontend/images/comment/1.png') }}" alt="Jhon">
                                            </div>
                                        </div>
                                        <div class="comment-main-area">
                                            <div class="comment-wrapper">
                                                <div class="sewl-comments-meta">
                                                    <h4>Lily Justin </h4>
                                                    <span>19 JAN 2018  at 2:30pm</span>
                                                </div>
                                                <div class="comment-area">
                                                    <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                    <div class="comments-reply">
                                                        <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="children">
                                        <li class="comment odd alt">
                                            <div class="comment-wrap comment-wrap1">
                                                <div class="comment-theme">
                                                    <div class="comment-image">
                                                        <img src="assets/images/comment/2.png" alt="Jhon">
                                                    </div>
                                                </div>
                                                <div class="comment-main-area">
                                                    <div class="comment-wrapper">
                                                        <div class="sewl-comments-meta">
                                                            <h4>Michel Frost</h4>
                                                            <span>19 JAN 2018  at 2:30pm</span>
                                                        </div>
                                                        <div class="comment-area">
                                                            <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                            <div class="comments-reply">
                                                                <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="children">
                                        <li class="comment odd alt">
                                            <div class="comment-wrap">
                                                <div class="comment-theme">
                                                    <div class="comment-image">
                                                        <img src="assets/images/comment/3.png" alt="Jhon">
                                                    </div>
                                                </div>
                                                <div class="comment-main-area">
                                                    <div class="comment-wrapper">
                                                        <div class="sewl-comments-meta">
                                                            <h4>Michele Anderson</h4>
                                                            <span>19 JAN 2018  at 2:30pm</span>
                                                        </div>
                                                        <div class="comment-area">
                                                            <p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when</p>
                                                            <div class="comments-reply">
                                                                <a rel="nofollow" class="comment-reply-link" href="#0" onclick="return addComment.moveForm( &quot;comment-1&quot;, &quot;1&quot;, &quot;respond&quot;, &quot;1&quot; )" aria-label="Reply to Mr WordPress"><span class="comment-reply-link"><i class="fa fa-reply"></i> Reply</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                        <div id="respond" class="sewl-comment-form comment-respond form-style">
                            <h3 id="reply-title" class="section-title">Leave a <span>comment</span></h3>
                            <form novalidate="" method="post" id="commentform" class="comment-form" action="#0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="sewl-form-inputs no-padding-left">
                                            <div class="row">
                                                <div class="col-sm-6 col-12">
                                                    <input id="name" name="name" value="" tabindex="2" placeholder="Name" type="text">
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <input id="email" name="email" value="" tabindex="3" placeholder="Email" type="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sewl-form-textarea no-padding-right">
                                            <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-submit">
                                            <input name="submit" id="submit" value="Send" type="submit">
                                            <input name="comment_post_ID" value="1" id="comment_post_ID" type="hidden">
                                            <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <aside class="sidebar-area p-10 bg-1">
                        <div class="widget widget_search">
                            <h4 class="widget-title">Search Product</h4>
                            <form action="#" class="searchform">
                                <input type="text" name="s" placeholder="Search Product...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_categories">
                            <h4 class="widget-title">Categories</h4>
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
                            <h2 class="section-title">Recent Post</h2>
                            <div class="slidebar-product-wrap">
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/24.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="blog-details.html">Lorem ipsum dolor sit amet.</a></h4>
                                        <p>12 Jun 2018</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/23.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="blog-details.html"> Deserunt nemo atque. Quod quos</a></h4>
                                        <p>12 Jun 2018</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/22.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="blog-details.html"> Deserunt nemo atque. Quod quos</a></h4>
                                        <p>12 Jun 2018</p>
                                    </div>
                                </div>
                                <div class="product-sidebar-items fix mb-0">
                                    <div class="product-sidebar-img black-opacity">
                                        <img src="assets/images/product/sidebar/21.jpg" alt="">
                                    </div>
                                    <div class="product-sedebar-content fix">
                                        <h4><a href="blog-details.html"> Deserunt nemo atque. Quod quos</a></h4>
                                        <p>12 Jun 2018</p>
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
@endsection

{!! (isset($footer_script))? $footer_script:'' !!}