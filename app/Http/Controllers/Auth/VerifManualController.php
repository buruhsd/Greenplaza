<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class VerifManualController extends Controller
{
    public function activating($token)
    {
        Auth::logout();
        $date = date('Y-m-d H:i:s');
        $model = User::where('token_register', $token)->first();
        if(!empty($model)){
            $model->email_verified_at = $date;
            $model->active = true;
            $model->token_register = str_random(190);
            $model->save();

            Session::flash('flash_status', 200); 
            Session::flash('flash_message', 'Verifikasi Email berhasil!'); 
        	Auth::login($model);

            return redirect('/');
        }

        return redirect('login')
            ->with(['flash_status' => 500, 'flash_message' => "Verifikasi Email gagal. <a href='".route('re_send')."'>Resend Email</a>"]);
    }

    public function re_send_mail(){
    	Mail::to(Auth::user())->send(new \App\Mail\RegisterMail(Auth::user()));
    	return back()->with(['flash_status' => 200, 'flash_message' => 'Email Terkirim.']);
    }

    public function re_send_page(){
    	return view('auth.resend');
    }

    public function re_send_noauth(Request $request){
    	$status = 200;
    	$message = 'Kirim ulang email aktivasi berhasil.';
        $messages = [
            'required'  => ':attribute wajib diisi ',
            'min'       => ':attribute harus diisi minimal :min karakter ',
            'max'       => ':attribute harus diisi maksimal :max karakter ',
            'email'     =>  ':attribute harus berupa email yang valid.',
            'string'    =>  ':attribute harus berupa huruf',
        ];
        
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
        ], $messages);

    	$user = User::whereRaw('email = "'.$request->email.'"')->first();
        if(!$user || $user == null || empty($user)){
        	$status = 500;
        	$message = 'Email anda belum terdaftar.';
        }else{
    		Mail::to($user)->send(new \App\Mail\RegisterMail($user));
        }
    	return back()->with(['flash_status' => $status, 'flash_message' => $message]);
    }

}
