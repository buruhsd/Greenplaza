<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Produk;
use Session;
use Auth;

class ChartController extends Controller
{
    public function chart()
    {
        return view('frontend.chart');
    }

    public function wishlist()
    {
    	$list = Wishlist::where('wishlist_user_id', Auth::id())->get();
    	$produk = Produk::orderBy('id', 'DESC')->first();
        return view('frontend.wishlist', compact('list', 'produk'));
    }

    public function wishlist_add(Request $request)
    {
    	$produk = Produk::orderBy('id', 'DESC')->first();
    	$wish = new Wishlist;
    	$wish->wishlist_produk_id = $produk->id;
    	$wish->wishlist_user_id = Auth::id();
    	$wish->wishlist_note = $request->wishlist_note;
    	$wish->save();

    	Session::flash("flash_notification", [
                        "level"=>"success",
                        "message"=>"Berhasil Menyimpan Produk ke Wishlist"
            ]);

    	return redirect()->back();
    }

    public function delete_wishlist(Request $request, $id){
    	$del = Wishlist::find($id);
    	$del->delete();
    	return redirect()->back();
    }
    
}
