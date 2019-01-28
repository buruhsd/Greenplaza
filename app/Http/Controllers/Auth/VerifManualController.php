<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Http\Controllers\Controller;
use Auth;

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
            $model->save();
        	Auth::login($model);
            return redirect('login')
                ->with(['flash_status' => 200, 'flash_message' => 'akun anda telah aktif silahkan login.']);
        }
        return redirect('login')
            ->with(['flash_status' => 500, 'flash_message' => 'Verifikasi gagal.']);
    }

}
