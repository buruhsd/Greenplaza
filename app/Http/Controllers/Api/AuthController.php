<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request){        
        $validator = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string'
        ],[
        'username.required' => 'username dibutuhkan',
        'password.required' => 'password dibutuhkan',
        ]);
        if ($validator->fails()) {    
            return response()->json([
            'sucess' => false,
            'error' => $validator->messages()], 200);
        }  
        try {
        $API_AUTH = "https://gicommunity.org/api/user/check"; 
        $attr = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $API_AUTH,
            CURLOPT_POSTFIELDS => json_encode($attr),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
        )
        ]);
        $resp = curl_exec($curl);
        $response = json_decode($resp, true);
        curl_close($curl);
        if($response['success']) {
            $user = User::where('username', $request->username)->with('user_detail')->first();
            if(json_decode($user)){
                // $user->push(['api_token' => $response['data']['api_token']]);
                return response()->json([
                    'sucess' => true,
                    'data' => $user;
                ], 200); 
            // return response()->json([
            //     'sucess' => true,
            //     'data' => [
            //         'id' => $data->id,
            //         'username' => $data->username,
            //         'email' => $data->email,
            //         'name' => $data->name,
            //         'api_token' => $response['data']['api_token']
            //     ]
            // ], 200); 
            }
             return response()->json([
            'sucess' => false,
            'error' => ['data' => "you must login in web before"]], 200);
             
        }
        if(!$response['success']) {
            if($response['message'] == "error parameter"){
                $sendError = $response['errors']['password'][0];
            }else{
                $sendError = $response['message'];
            }
            return response()->json([
            'sucess' => false,
            'error' => ['data' => $sendError]], 200);
        }
        } catch (Exception $e) {
           return response()->json([
            'sucess' => false,
            'error' => ['data' => "error"]], 200);
        }
    }
}
