<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Produk_discuss;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;


class Produk_discussController extends Controller
{
    private $perPage = 25;
    private $mainTable = 'sys_produk_discuss';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $where = "1";//.' AND produk_user_status=3';
        $andwhere = "";
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND users.name LIKE "%'.$name.'%"';
        }

        if (!empty($where)) {
            $data['produk_discuss'] = Produk_discuss::whereRaw($where)
                ->paginate($this->perPage);
        } else {
            $data['produk_discuss'] = Produk_discuss::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.produk_discuss.index', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function arsip($id)
    {
        $status = 200;
        $message = 'Diskusi Produk Moving to arsip!';
        $res = Produk_discuss::findOrFail($id);
        $res->message_is_arsip = 1;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Diskusi Produk not Moving to arsip!';
        }

        return redirect('member/produk/discuss')
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
