<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance.
     * form login blade
     * @return void
     */
    public function showLoginForm(Request $request, $token = null)
    {
        return view('auth.login')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Create a new controller instance.
     * jika memiliki session login (ter-authenticated)
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        // if ( $user->is_member() ) {// do your margic here
        if ( $user->is_member() ) {// do your margic here
            return redirect()->route('member.home');
        }
        if ( $user->is_admin() ) {// do your margic here
            return redirect()->route('admin.home');
        }
        if ( $user->is_superadmin() ) {// do your margic here
            return redirect()->route('superadmin.home');
        }

        return redirect('/home');
    }

    /**
     * credensial (username untuk login (username/email))
     *
     * @return void
     */
    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
