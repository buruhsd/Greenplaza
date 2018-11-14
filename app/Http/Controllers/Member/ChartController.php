<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
use Auth;

class ChartController extends Controller
{
    public function chart()
    {
        return view('frontend.chart');
    }

    public function wishlist(Request $request)
    {
    	$produk = Produk::where('produk_seller_id', Auth::id())->first();
    	$wish = new Wishlist;
    	$wish->wishlist_produk_id = $produk->id;
    	$wish->wishlist_user_id = Auth::id();
    	$wish->wishlist_note = $request->wishlist_note;
    	$wish->save();

    	$list = Wishlist::where('wishlist_user_id', '$produk')->first();
    	dd($list);
        return view('frontend.wishlist', compact('produk', 'wish'));
    }
    
}
