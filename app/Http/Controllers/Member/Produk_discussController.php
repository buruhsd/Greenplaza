<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk_discuss;
use App\Models\Produk_discuss_reply;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;


class Produk_discussController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk_discuss';

    /**
     */
    public function index(Request $request)
    {
        $arr = [
            "sys_produk.produk_seller_id" =>'from',
            "produk_discuss_user_id" =>'to',
            "produk_discuss_status" =>'arsip',
        ];
        $where = "1";//.' AND produk_user_status=3';
        $andwhere = "";
        $user = Auth::id();
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND users.name LIKE "%'.$name.'%"';
        }

        // status from / to
        $status = 'sys_produk.produk_seller_id';
        $status_val = Auth::id();
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            if($status !== 'arsip'){
                $andwhere = ' AND produk_discuss_status = 1';
            }
            $status_val = ($status !== 'arsip')?Auth::id():0;
            // $status_val = Auth::id();
            $status = array_search($status,$arr);
        }
        $where .= ' AND '.$status.' = '.$status_val.$andwhere;

        if (!empty($where)) {
            $data['produk_discuss'] = Produk_discuss::where('produk_discuss_user_id', $user)
                // ->where('produk_discuss_status', $where)
                ->whereRaw($where)
                ->SELECT('sys_produk_discuss.*', 'sys_produk.produk_seller_id')
                ->leftJoin('sys_produk', 'sys_produk.id', '=', 'sys_produk_discuss.produk_discuss_produk_id')
                ->orderBy('updated_at', 'DESC')
                ->paginate($this->perPage)
                ;
                // dd($data['produk_discuss']);
        } else {
            $data['produk_discuss'] = Produk_discuss::paginate($this->perPage);
        }


        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.produk_discuss.index', $data);
    }
    /**
    * @param $request
    * @return redirect
    */
    public function store(Request $request){
        $status = 200;
        $message = 'diskusi produk berhasil ditambahkan.';
        $discuss = new Produk_discuss;
        $discuss->produk_discuss_produk_id = $request->produk_id;
        $discuss->produk_discuss_user_id = Auth::id();
        $discuss->produk_discuss_text = $request->discuss_text;
        $discuss->save();
        if(!$discuss){
            $status = 500;
            $message = 'diskusi produk gagal ditambahkan.';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * @param $request
    * @return redirect
    */
    public function reply_store(Request $request){
        $status = 200;
        $message = 'balasan terkirim.';
        $discuss = new Produk_discuss_reply;
        $discuss->produk_discuss_reply_discuss_id = $request->discuss_id;
        $discuss->produk_discuss_reply_user_id = Auth::id();
        $discuss->produk_discuss_reply_text = $request->discuss_reply_text;
        $discuss->save();
        if(!$discuss){
            $status = 500;
            $message = 'balasan tidak terkirim.';
        }

        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     */
    public function arsip($id)
    {
        $status = 200;
        $message = 'Diskusi Produk Moving to arsip!';
        $res = Produk_discuss::findOrFail($id);
        $res->produk_discuss_status = 0;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Diskusi Produk not Moving to arsip!';
        }

        return redirect('member/produk/discuss')
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
     */
    public function destroy($id)
    {
        $status = 200;
        $message = 'Diskusi Produk deleted!';
        $res = Produk_discuss::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Diskusi Produk Not deleted!';
        }

        return redirect('member/produk/discuss')
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
        $produk_unit = DB::query($qry);

        return $produk_unit;
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
