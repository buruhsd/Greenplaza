<?php

namespace App\Facades\Classes;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class RajaOngkir extends Controller
{
    // private $__api_server='http://wallet.cavallocoin.io/api'; //api
    // private $__api_username='fahmisodret-778181514'; //api key
    private $__api_key = "c6cd80e53a26df51bad3773ef6f76331";

 
    /**
    * @param
    * @return
    **/
    public function province($param= []){
        extract($param);
        $url = "http://pro.rajaongkir.com/api/province";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ".$this->__api_key
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = 'error';
            return 'error';
        } else {
            return $response;
        }
    }

    /**
    * @param
    * @return
    **/
    public function city($param= []){
        extract($param);
        $url = "http://pro.rajaongkir.com/api/city";
        if(isset($id)){
            $url = "http://pro.rajaongkir.com/api/city?province=$id";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ".$this->__api_key
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = 'error';
            return 'error';
        } else {
            return $response;
        }
    }

    /**
    * @param
    * @return
    **/
    public function subdistrict($param= []){
        extract($param);
        $url = "http://pro.rajaongkir.com/api/subdistrict";
        if(isset($id)){
            $url = "http://pro.rajaongkir.com/api/subdistrict?city=$id";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ".$this->__api_key
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = 'error';
            return 'error';
        } else {
            return $response;
        }
    }

    /**
    * mendapat harga ongkir
    * @param *origin, originType, destination, destinationType, weight
    * @param courier, lenght, width, height, diameter
    * @return
    **/
    public function cost($param= []){
        extract($param);
        $url = "http://pro.rajaongkir.com/api/cost";
        if(isset($id)){
            $url = "http://pro.rajaongkir.com/api/cost?city=".$id;
        }
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
                "key: ".$this->__api_key
                ),
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $result = 'error';
            return 'error';
        } else {
            return $response;
        }
    }
}
