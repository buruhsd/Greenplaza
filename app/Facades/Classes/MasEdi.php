<?php

namespace App\Facades\Classes;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class MasEdi extends Controller
{
    // private $__api_server='http://wallet.cavallocoin.io/api'; //api
    private $__api_key = "c6cd80e53a26df51bad3773ef6f76331";
    // private $__api_server = 'http://wakanda.harmonyb12.com/edisedis/index.php';
    private $__api_server = 'http://45.76.176.231/edisedis/index.php';

    /**
    * bayar masedi
    * @param *username, password, note, price, poin
    * @param username, password, note, price, poin
    * @return
    **/
    public function payment($param= []){
        extract($param);
        $url = $this->__api_server."/sadisbgt/Controller_api/pembayaran";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $status = 500;
            $message = 'curl error.';
            $response = ['status'=>$status, 'message'=>$message];
            return $response;
        } else {
            return $response;
        }
    }

    /**
    * mengecek voucher
    * @param voucher
    * @return
    **/
    public function cek_voucher($param= []){
        extract($param);
        $url = $this->__api_server."/sadisbgt/controller_api/cek_voucher";
        $url = "http://wakanda.harmonyb12.com/edisedis/index.php/sadisbgt/controller_api/cek_voucher";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $status = 500;
            $message = 'curl error.';
            $response = ['status'=>$status, 'message'=>$message];
            return $response;
        } else {
            return $response;
        }
    }

    /**
    * mengecek voucher
    * @param voucher
    * @return
    **/
    public function use_voucher($param= []){
        extract($param);
        $url = "http://wakanda.harmonyb12.com/edisedis/index.php/sadisbgt/controller_api/used_voucher";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $status = 500;
            $message = 'curl error.';
            $response = ['status'=>$status, 'message'=>$message];
            return $response;
        } else {
            return $response;
        }
    }
}
