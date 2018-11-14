@extends('layouts.index', ['active' => 'chart'])
@section('title', 'Chart')
@section('content')

<!-- breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap bg-1">
                        <div class="breadcumb-content black-opacity">
                            <h2>Shopping Cart</h2>
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
                    <div class="cart-wrapper bg-1 p-10">
                        <form action="cart">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images">Image</th>
                                        <th class="product">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="quantity">Quantity</th>
                                        <th class="total">Total</th>
                                        <th class="remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/2.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Modern and Wanderful chair</a></td>
                                        <td class="ptice">$139.00</td>
                                        <td class="quantity ">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" />
                                            </div>
                                        </td>
                                        <td class="total">$139.00</td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/3.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Wooden Pot</a></td>
                                        <td class="ptice">$684.47</td>
                                        <td class="quantity ">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" />
                                            </div>
                                        </td>
                                        <td class="total">$684.47</td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="images"><img src="assets/images/cart/4.jpg" alt=""></td>
                                        <td class="product"><a href="single-product.html">Wonderful Light</a></td>
                                        <td class="ptice">$145.80</td>
                                        <td class="quantity ">
                                            <div class="cart-plus-minus">
                                                <input type="text" value="1" />
                                            </div>
                                        </td>
                                        <td class="total">$145.80</td>
                                        <td class="remove"><i class="fa fa-times"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row mt-60">
                                <div class="col-lg-5 col-md-6 ">
                                    <div class="cartcupon-wrap">
                                        <ul class="d-flex">
                                            <li>
                                                <button>Update Cart</button>
                                            </li>
                                            <li><a href="shop.html">Continue Shopping</a></li>
                                        </ul>
                                        <h3>Cupon</h3>
                                        <p>Enter Your Cupon Code if You Have One</p>
                                        <div class="cupon-wrap">
                                            <input type="text" placeholder="Cupon Code">
                                            <button>Apply Cupon</button>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-lg-4 offset-lg-3 col-md-6">
                                    <div class="cart-total text-right">
                                        <h3>Cart Totals</h3>
                                        <ul>
                                            <li><span class="pull-left">Subtotal </span>$380.00</li>
                                            <li><span class="pull-left"> Total </span> $380.00</li>
                                        </ul>
                                        <a href="checkout.html">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
    

@endsection