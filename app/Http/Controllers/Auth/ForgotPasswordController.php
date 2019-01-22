<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use SendEmail;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use FunctionLib;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function change_password($token=null){
        $user = User::whereRaw('token_register = "'.$token.'"')->first();
        if($user){
            $status = 200;
            $message = 'Password berhasil di reset!, silahkan cek email anda untuk password baru anda.';

            $password = FunctionLib::str_rand(9);
            $user->password = Hash::make($password);
            $user->token_register = str_random(190);
            $user->save();
            if(!$user){
                $status = 500;
                $message = 'Password tidak berhasil di reset!';
                return redirect('login')
                    ->with(['flash_status' => $status,'flash_message' => $message]);
            }

            // send email
            $config = [
                'to' => $user->email,
                'subject' => 'Reset Password Greenplaza',
                'view' => 'email.new-password',
                'data' => [
                    'password' => $password,
                ]
            ];
            SendEmail::html($config);

            return redirect('login')
                ->with(['flash_status' => $status,'flash_message' => $message]);
        }
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // $this->validateEmail($request);
        $this->validate($request, ['email' => 'required|exists:users,email']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $response = $this->broker()->sendResetLink(
        //     $request->only('email')
        // );
        $user = User::whereEmail($request->only('email'))->first();
        $config = [
            'to' => $request->email,
            'subject' => 'Reset Password Greenplaza',
            'view' => 'email.reset-link',
            'data' => [
                'link' => route('password.change', $user->token_register),
            ]
        ];
        SendEmail::html($config);

        return back()->with(['flash_status' => 200, 'flash_message' => 'Link Reset Password terkirim, silahkan buka email anda.']);
    }

}
