@extends('layouts.index', ['active' => 'wishlist'])
@section('title', 'Wishlist')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Wishlist</h2>
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area mb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wishlist-wrap p-10 bg-1">
                        <form action="cart">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">Image</th>
                                        <th class="product">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="stock">Stock Stutus </th>
                                        <th class="addcart">Add to Cart</th>
                                        <th class="remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/2.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Modern and Wanderful chair</a></td>
                                        <td class="ptice">$139.00</td>
                                        <td class="stock">In Stock</td>
                                        <td class="addcart"><a href="cart.html">Add to Cart</a></td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/3.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Wooden Pot</a></td>
                                        <td class="ptice">$684.47</td>
                                        <td class="stock"><span>Out Stock</span></td>
                                        <td class="addcart"><a href="cart.html">Add to Cart</a></td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/4.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Wonderful Light</a></td>
                                        <td class="ptice">$145.80</td>
                                        <td class="stock">In Stock</td>
                                        <td class="addcart"><a href="cart.html">Add to Cart</a></td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->

@endsection