@extends('layouts.index')
@section('title', 'Page Title')
@section('content')
<!-- .shop-page-area start -->
    <div class="shop-page-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="shop-area">
                        <div class="row mb-30">
                            <div class="col-lg-3 col-sm-4 col-12">
                                <select name="stor" class="select-style">
                                    <option disabled selected>Sort by Defalt</option>
                                    <option>Australia</option>
                                    <option>Brazil</option>
                                    <option>Cambodia</option>
                                    <option>Dominica</option>
                                    <option>France</option>
                                    <option>Guyana</option>
                                    <option>Hong Kong</option>
                                    <option>Ireland</option>
                                    <option>Japan</option>
                                    <option>Malaysia</option>
                                    <option>Nepal</option>
                                    <option>Oman</option>
                                    <option>Peru</option>
                                </select>
                            </div>
                            <div class=" col-lg-5 col-sm-5 col-12">
                                <p class="total-product">Showing 1-12 of 150 Results</p>
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
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/1.jpg" alt="">
                                                <img class="second" src="assets/images/product/2.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/3.jpg" alt="">
                                                <img class="second" src="assets/images/product/4.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/5.jpg" alt="">
                                                <img class="second" src="assets/images/product/6.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/7.jpg" alt="">
                                                <img class="second" src="assets/images/product/8.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/9.jpg" alt="">
                                                <img class="second" src="assets/images/product/10.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/11.jpg" alt="">
                                                <img class="second" src="assets/images/product/12.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/13.jpg" alt="">
                                                <img class="second" src="assets/images/product/14.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/15.jpg" alt="">
                                                <img class="second" src="assets/images/product/16.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/17.jpg" alt="">
                                                <img class="second" src="assets/images/product/18.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/19.jpg" alt="">
                                                <img class="second" src="assets/images/product/20.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/21.jpg" alt="">
                                                <img class="second" src="assets/images/product/22.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-4 col-sm-6  col-12">
                                        <div class="product-wrap">
                                            <div class="product-img black-opacity">
                                                <span class="new sale">Sale</span>
                                                <img class="first" src="assets/images/product/23.jpg" alt="">
                                                <img class="second" src="assets/images/product/24.jpg" alt="">
                                                <div class="shop-icon">
                                                    <ul>
                                                        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                        <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                <p><span>$48.00</span>
                                                    <del>$50.00</del>
                                                </p>
                                                <ul class="rating">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="pagination-wrapper text-center">
                                            <ul class="page-numbers">
                                                <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                <li><a class="page-numbers" href="#">1</a></li>
                                                <li><span class="page-numbers current">2</span></li>
                                                <li><a class="page-numbers" href="#">3</a></li>
                                                <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="list">
                                <div class="product-list">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/1.jpg" alt="">
                                                    <img class="second" src="assets/images/product/2.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/3.jpg" alt="">
                                                    <img class="second" src="assets/images/product/4.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/5.jpg" alt="">
                                                    <img class="second" src="assets/images/product/6.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/7.jpg" alt="">
                                                    <img class="second" src="assets/images/product/8.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/9.jpg" alt="">
                                                    <img class="second" src="assets/images/product/10.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="product-wrap">
                                                <div class="product-img black-opacity">
                                                    <span class="new sale">Sale</span>
                                                    <img class="first" src="assets/images/product/11.jpg" alt="">
                                                    <img class="second" src="assets/images/product/12.jpg" alt="">
                                                    <div class="shop-icon">
                                                        <ul>
                                                            <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                            <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="shop-single.html"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="shop.html">Floral Print Buttoned</a></h3>
                                                    <p class="color">Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo Itaque dignissimos quibusdam fugit ducimus vero officia optio commodi aut cupiditate.</p>
                                                    <p>
                                                        <span>$48.00</span>
                                                        <del>$50.00</del>
                                                    </p>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="pagination-wrapper text-center">
                                                <ul class="page-numbers">
                                                    <li><a class="prev page-numbers" href="#"><i class="fa fa-angle-left"></i></a></li>
                                                    <li><a class="page-numbers" href="#">1</a></li>
                                                    <li><span class="page-numbers current">2</span></li>
                                                    <li><a class="page-numbers" href="#">3</a></li>
                                                    <li><a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a></li>
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
    </div>
    <!-- .shop-page-area enc -->
@endsection