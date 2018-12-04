<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Message;
use App\Role;
use App\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Produk_unit;
use App\Models\Produk_location;
use App\Models\Produk_image;
use App\Models\Produk_grosir;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;


class MessageController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_message';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $arr = [
            "message_to_id" =>'from',
            "message_from_id" =>'to',
            "message_is_arsip" =>'arsip',
        ];
        $where = "1";//.' AND produk_user_status=3';
        $andwhere = "";
        if(!empty($request->get('name'))){
            $name = $request->get('name');
            $where .= ' AND users.name LIKE "%'.$name.'%"';
        }

        // status from / to
        $status = 'message_to_id';
        $status_val = Auth::id();
        if(!empty($request->get('status'))){
            $status = $request->get('status');
            if($status !== 'arsip'){
	            $andwhere = ' AND message_is_arsip = 0';
            }
        	$status_val = ($status !== 'arsip')?Auth::id():1;
        	$status = array_search($status,$arr);
        }
        $where .= ' AND '.$status.' = '.$status_val.$andwhere;

        if (!empty($where)) {
            $data['message'] = Message::whereRaw($where)
                ->paginate($this->perPage);
        } else {
            $data['message'] = Message::paginate($this->perPage);
        }
        $data['footer_script'] = $this->footer_script(__FUNCTION__);

        return view('member.message.index', $data);
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
        $message = 'Message Moving to arsip!';
        $res = Message::findOrFail($id);
        $res->message_is_arsip = 1;
        $res->save();
        if(!$res){
            $status = 500;
            $message = 'Message not Moving to arsip!';
        }

        return redirect('member/message')
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
        $message = 'Message deleted!';
        $res = Message::destroy($id);
        if(!$res){
            $status = 500;
            $message = 'Message Not deleted!';
        }

        return redirect('member/message')
            ->with(['flash_status' => $status,'flash_message' => $message]);
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
        }

        $script = ob_get_contents();
        ob_end_clean();
        return $script;
    }
}
