<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Komplain;
use App\Models\Komplain_pic;
use App\Models\Komplain_discuss;
use App\Models\Solusi;
use App\Models\Trans_detail;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Auth;
use FunctionLib;


class SolusiController extends Controller
{
    private $perPage = 5;
    private $mainTable = 'sys_solusi';

    /**
    * #seller
    * @param $id solusi
    * @return
    **/
    public function approve_solusi(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{            
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_status = 2;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #seller
    * @param $request, $id solusi
    * @return
    **/
    public function add_buyer_without_resi(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_buyer_without_resi = 1;
            $solusi->solusi_buyer_accept = 0;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #buyer
    * @param $request, $id solusi
    * @return
    **/
    public function add_shipment_buyer(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_buyer_resi = $request->solusi_buyer_resi;
            $solusi->solusi_buyer_shipment = $request->solusi_buyer_shipment;
            $solusi->solusi_buyer_accept = 0;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #buyer
    * @param $request, $id solusi
    * @return
    **/
    public function approve_shipment_buyer(Request $request, $id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_buyer_accept = 1;
            $solusi->solusi_buyer_date = $date;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #seller
    * @param $request, $id solusi
    * @return
    **/
    public function add_seller_without_resi(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_seller_without_resi = 1;
            $solusi->solusi_seller_accept = 0;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Konfirmasi gagal.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #seller
    * @param $request, $id solusi
    * @return
    **/
    public function add_shipment_seller(Request $request, $id){
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_seller_resi = $request->solusi_seller_resi;
            $solusi->solusi_seller_shipment = $request->solusi_seller_shipment;
            $solusi->solusi_seller_accept = 0;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Konfirmasi gagal.";
        }
        return redirect()->back()
            ->with(['flash_status' => $status,'flash_message' => $message]);
    }

    /**
    * #seller
    * @param $request, $id solusi
    * @return
    **/
    public function approve_shipment_seller(Request $request, $id){
        $date = date('Y-m-d H:i:s');
        $status = 200;
        $message = "Solusi has been updated.";
        try{
            $solusi = Solusi::findOrFail($id);
            $solusi->solusi_seller_accept = 1;
            $solusi->solusi_seller_date = $date;
            $solusi->save();
        } catch (\Exception $e) {
            $status = 500;
            $message = "Komplain cannot added.";
        }
        return redirect()->back()
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
