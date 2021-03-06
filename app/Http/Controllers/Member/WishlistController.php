<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Category;
use FunctionLib;
use Auth;


class WishlistController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_brand';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data['list'] = Wishlist::where('wishlist_user_id', Auth::id())->paginate($this->perPage);
        } else {
            $data['list'] = Wishlist::where('wishlist_user_id', Auth::id())->paginate($this->perPage);
        }
        $data['produk'] = Produk::orderBy('id', 'DESC')->first();
        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        $data['categoryheader'] = Category::orderBy('created_at', 'DESC')->where('category_status', '=', 1)->limit(7)->get();

        return view('frontend.wishlist', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addWishlist(Request $request, $id)
    {
        // dd($request);
        $status = 200;
        $message = 'Berhasil ditambahkan ke wishlist!';
        
        $res = new Wishlist;
        $res->wishlist_produk_id = $id;
        $res->wishlist_user_id = Auth::id();
        $res->wishlist_note = $request->note;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'wishlist Not added!';
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    public function moveToChart ()
    {
        $status = 200;
        $message = 'moved to chart';

        $bank = Bank::where('user_bank_user_id', Auth::id())->first();
        $pay = Payment::where('payment_name', Auth::id()->name)->first();
        $produk = Produk::where('produk_seller_id', Auth::id())->first();

        $trans->trans_code = FunctionLib::str_rand(6);
        $trans->trans_user_id = Auth::id()->id;
        $trans->trans_paid_image = $request->trans_paid_image;
        $trans->
        $trans->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['wishlist'] = Wishlist::findOrFail($id);

        $data['footer_script'] = $this->footer_script(__FUNCTION__);
        return view('member.wishlist.show', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $status = 200;
        $message = 'wishlist deleted!';
        $res = Wishlist::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'wishlist Not deleted!';
        }

        return redirect('member/wishlist')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $where
    * @return
    */
    public function get_one_row($where='1', $join=array()){
        $qry = 'SELECT * FROM '.$this->mainTable;
        if(!empty($join)){
            foreach ($join as $value) {
                $qry .= $value;
            }
        }
        $qry .= ' WHERE '.$where.' Limit 1';
        $brand = DB::query($qry);

        return $brand;
    }

    /**
    * @param method $method
    * @return add main footer script / in spesific method
    */
    public function footer_script($method=''){
        ob_start();
        ?>
            <script type="text/javascript"></script>
        <?php
        switch ($method) {
            case 'index':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'create':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'show':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
            case 'edit':
                ?>
                    <script type="text/javascript"></script>
                <?php
                break;
        }
        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
