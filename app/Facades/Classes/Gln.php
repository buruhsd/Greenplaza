<?php

namespace App\Facades\Classes;

use App\Http\Controllers\Controller;
use Session;

class Gln extends Controller
{
    // private $__api_server='http://wallet.cavallocoin.io/api'; //api
    private $__api_key = "FCeQbFJ6eSMB0HRg1ZpD";
    private $__api_server = 'https://wallet.greenline.ai/api';
    private $__api_username='merisodret1-915543755'; //api key
    
    /**
    * @param ['data'=>['label'=>$label]]
    * @return
    */
    public function create($param= []){
        extract($param);
        $url = $this->__api_server.'/create/wallet/'.$this->__api_key;
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
                    // "cache-control: no-cache",
                    // "content-type: application/x-www-form-urlencoded",
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
    * @param ['data'=>['to_address' =>$to_address,'amount'=>$amount], 'address'=>$address]
    * @return
    */
    public function transfer($param= []){
        extract($param);
        $url = $this->__api_server.'/send/'.$this->__api_key.'/'.$address;
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
                    'Accept: application/json',
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    // "cache-control: no-cache",
                    // "content-type: application/x-www-form-urlencoded",
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
    * @param ['address'=>$address]
    * @return
    */
    public function ballance($param= []){
        extract($param);
        $url = $this->__api_server.'/ballance/'.$this->__api_key.'/'.$address;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                'content-type: application/json',
                    // "cache-control: no-cache",
                    // "content-type: application/x-www-form-urlencoded",
                    // "cache-control: no-cache",
                    // "content-type: application/x-www-form-urlencoded",
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
    * @param
    * @return
    */
    public function list($param= []){
        extract($param);
        $url = $this->__api_server.'/list/address/'.$this->__api_key;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    // "cache-control: no-cache",
                    // "content-type: application/x-www-form-urlencoded",
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
    * @param 
    * @return
    */
    public function compare($param= []){
        extract($param);
        $url = 'https://editeg.id/api/price/gln';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    'Authorization:Bearer HlvMocCVFKcKfQzhSPPy9sgTd89KTAtLmH6UcIG8bBkac6GbjtECP4QARPTsZ3WrvmJn3JVc7PAhmTpRVjMoY8g04EBv3HBtNgTG',
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
