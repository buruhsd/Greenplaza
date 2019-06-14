<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trans_detail;
use App\Models\Produk;
use App\Models\Produk_grosir;
use App\Models\Log_wallet;
use App\Models\log_transfer;
use App\Models\Shipment;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;

class ApiController extends Controller
{
    public function get_user_address(Request $request){
        $status = 500;
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        // $data = $par_auth;
        $data = [];
        if(FunctionLib::check_atempt($par_auth) == 200){
            $user = User::whereUsername($request->input("username"))->first();
            if($user){
                $data = $user->user_address()->get();
            }
            $status = 200;
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    public function get_courier(){
        $where = 1;
        $data = Shipment::whereRaw($where)->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    public function update_profil(Request $request){
        $status = 500;
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $user = User::whereUsername($request->input("username"))->first();
            $user->name = $request->input("name");
            $user->user_store = $request->input("user_store");
            $user->user_slogan = $request->input("user_slogan");
            $user->save();
            $status = 200;
        }
        return response()->json(['status' => $status, 'data'=>$user]);
    }

    public function log_transfer(Request $request){
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }
        $where = '1';
        $order = "rand()";
        if($uid !== 0){
            $where .= ' AND (log_transfer.transfer_user_id ='.$uid.' OR log_transfer.transfer_to_user_id ='.$uid.')';
        }
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $order = explode ("-", $request->input("order"));
            $order = $order[0].' '.$order[1];
        }
        if(!empty($request->input("type")) && $request->input("type") !== ""){
            $where .= ' AND log_transfer.transfer_type LIKE "%'.$request->input("type").'%"';
        }
        $data = log_transfer::whereRaw($where)
                    ->orderByRaw($order)
                    ->with('from')
                    ->with('to')
                    ->get();

        return response()->json(['status' => 200, 'data'=>$data]);
    }

    public function log_wallet(Request $request){
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }
        $where = '1';
        $order = "rand()";
        if($uid !== 0){
            $where .= ' AND log_wallet.wallet_user_id ='.$uid;
        }
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $order = explode ("-", $request->input("order"));
            $order = $order[0].' '.$order[1];
        }
        if(!empty($request->input("wallet")) && $request->input("wallet") !== 0){
            $where .= ' AND log_wallet.wallet_type ='.$request->input("wallet");
        }
        $data = Log_wallet::whereRaw($where)
                    ->orderByRaw($order)
                    ->with('wallet')
                    ->with('type')
                    ->get();

        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan cek validasi login
    **/
    public function doLogin(Request $request){
        $userdata = array(
            'email'     => $request->username,
            'password'  => $request->password
        );
        // attempt to do the login
        if (Auth::attempt($userdata)) {
            $status = 200;
            $data = User::whereId(Auth::id())->with('user_detail')->first();
        } else {
            $status = 500;
            $data = [];
        }
        return response()->json(['status' => $status, 'data'=>$data]);
    }

    /**
    * mendapatkan detail transaksi
    **/
    public function detail_transaksi(Request $request, $detail_id){
        $where = 'sys_trans_detail.id ='.$detail_id;
        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('conf_payment', 'conf_payment.id', '=', 'sys_trans.trans_payment_id')
                ->select('sys_trans_detail.*', 
                        DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'),
                        'sys_produk.produk_name',
                        'sys_trans.trans_amount', 'sys_trans.trans_amount_ship', 'sys_trans.trans_amount_total', 'sys_trans.created_at', 'sys_trans.trans_code as kode', 
                        'conf_payment.payment_name'
                    )
                ->first();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data penjualan
    **/
    public function penjualan(Request $request, $status)
    {
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }

        $where = '1';
        if($uid !== 0){
            $where .= ' AND sys_produk.produk_seller_id ='.$uid;
        }
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status[$status]; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data pembelian
    **/
    public function pembelian(Request $request, $status)
    {
        $par_auth = [
            'username'=>$request->input("username"),
            'password'=>$request->input("password")
        ];
        $uid = 0;
        if(FunctionLib::check_atempt($par_auth) == 200){
            $uid = User::whereUsername($request->input("username"))->first()->id;
        }

        $where = '1';
        if($uid !== 0){
            $where .= ' AND sys_trans.trans_user_id ='.$uid;
        }
        // status transaksi
        $arr_status = [
            'process' => 'trans_detail_status != 6 AND trans_detail_is_cancel != 1',
            'done' => 'trans_detail_status = 6 AND trans_detail_is_cancel != 1',
            'cancel' => 'trans_detail_is_cancel = 1'
        ];
        $w_status = ' AND '.$arr_status[$status]; 
        $where .= $w_status;

        $asset = asset('assets/images/product/thumb');
        $data = Trans_detail::whereRaw($where)
                ->leftJoin('sys_trans', 'sys_trans.id', '=', 'sys_trans_detail.trans_detail_trans_id')
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_trans_detail.trans_detail_produk_id')
                ->select('sys_trans_detail.*', DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as produk'))
                ->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan data produk
    **/
    public function produk(Request $request, $status=1)
    {
        $where = '1';
        $order = "rand()";
        $perPage = (!empty($request->input("perpage")))
            ?$request->input("perpage")
            :9;
        $page = (!empty($request->input("page")))
            ?$request->input("page")
            :1;
        // $id_cat = 0;
        if(!empty($request->input("order")) && $request->input("order") !== ""){
            $check = ['populer','ulasan']; 
            $arr = [
                'populer'=>'COUNT(sys_trans_detail.id) ',
                'ulasan'=>'COUNT(sys_review.id)',
            ];
            $order = explode ("-", $request->input("order"));//$request->input("order").' ASC';
            // $order = $order[0].' '.$order[1];
            // $order = (str_contains(strtolower($order_id), 'populer'))
            $order = (in_array($order[0], $check))
                ?$arr[$order[0]].' '.$order[1]
                :$order[0].' '.$order[1];
        }
        if($request->input("src") != ""){
            $where .= " AND produk_name LIKE '%".$request->input("src")."%'";
        }
        if($request->has("user_status") && $request->input("user_status") != ""){
            $where .= " AND produk_user_status = ".$request->input("user_status");
        }

        $asset = asset('assets/images/product/thumb');
        $data = Produk::whereRaw($where)
            ->orderByRaw($order)
            ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->leftJoin('conf_produk_unit', 'conf_produk_unit.id', '=', 'sys_produk.produk_unit')
            ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'), DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as gambar'), 'conf_produk_unit.produk_unit_name')
            ->groupBy('sys_produk.id')
            ->where('produk_status', '=', $status)
            ->skip(($page-1) * $perPage)
            ->take($perPage)
            ->get();
            // ->paginate($perPage);
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan detail produk
    **/
    public function produk_grosir(Request $request, $pid){
        $data = Produk_grosir::where('produk_grosir_produk_id', $pid)->get();
        return response()->json(['status' => 200, 'data'=>$data]);
    }

    /**
    * mendapatkan detail produk
    **/
    public function detail_produk(Request $request, $pid){
        $asset = asset('assets/images/product/thumb');
        $data = Produk::where('sys_produk.id', $pid)
            ->leftJoin('sys_review', 'sys_review.review_produk_id', '=', 'sys_produk.id')
            ->leftJoin('sys_trans_detail', 'sys_trans_detail.trans_detail_produk_id', '=', 'sys_produk.id')
            ->leftJoin('conf_produk_unit', 'conf_produk_unit.id', '=', 'sys_produk.produk_unit')
            ->select('sys_produk.*', DB::raw('COUNT(sys_trans_detail.id) as count_detail'), DB::raw('COUNT(sys_review.id) as count_review'), DB::raw('CONCAT("'.$asset.'/", sys_produk.produk_image) as gambar'), 'conf_produk_unit.produk_unit_name')->first();
        return response()->json(['status' => 200, 'data'=>$data]);
    }
}
