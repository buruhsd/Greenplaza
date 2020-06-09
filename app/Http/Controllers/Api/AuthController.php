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
            if($user){
                // $user->push(['api_token' => $response['data']['api_token']]);
                $data = array_merge($user->toArray(), ['api_token' => $response['data']['api_token']]);
                return response()->json([
                    'sucess' => true,
                    'data' => $data
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

    public function login_com(Request $request){
        // $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
