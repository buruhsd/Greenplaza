<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\User_detail;
use Exception;
use Redirect;
use FunctionLib;
use App\Role;
use Validator;

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
        return view('auth.login_green')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
      public function login_gi(Request $request){
        $validator = Validator::make($request->all(), [
        'email' => 'required|string',
        'password' => 'required|string'
        ],[
        'email.required' => 'username dibutuhkan',
        'password.required' => 'password dibutuhkan',
        ]);
        if ($validator->fails()) {    
            return response()->json([
            'sucess' => false,
            'error' => $validator->messages()], 200);
        }
        if($request->email === "admin" || $request->email === "superadmin"){
        if ($this->attemptLogin($request)) {
            return response()->json(['sucess' => true], 200);
        }
        $this->incrementLoginAttempts($request);

        return response()->json([
            'sucess' => false,
            'error' => ['data' => "username atau password salah"]], 200);
        }
            
         try {
        $API_AUTH = "https://gicommunity.org/api/user/check"; 
        $attr = [
            'username' => $request->email,
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
            $username = $response['data']['username'];
            $findUser = User::where('username', $username)->get(); 
            $atr_rdm = $request->password;
            if(count($findUser) == 0){
                    $this->createResponse($response['data'], $atr_rdm);
            }else{
                    $this->updateResponse($response['data'], $atr_rdm);
            }
            if ($this->attemptLogin($request)) {
                    User::where('username', $request->email)->limit(1)->update(array('password' => null));
                    return response()->json(['sucess' => true], 200);
            }      
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
    protected function createResponse($response, $data)
    {
        $user = User::create([
                'username' => $response['username'],
                'name' => $response['name'],
                'email' => $response['email'],
                'password' => Hash::make($data),
                'active' => 1
        ]);
        if($user){
              $user_detail = User_detail::create([
                'user_detail_user_id' => $user->id
            ]);
        }
        $memberRole = Role::where('name', 'member')->pluck('name');
        $user->assignRole($memberRole);
    }
    protected function updateResponse($response, $data)
    {
        User::where('username', $response['username'])->limit(1)->update(['password' => Hash::make($data)]);
        
    }
      public function login(Request $request){
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

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function validateLogin(Request $request)
    {
        $message = [
            'required'  => ':attribute wajib diisi ',
            'min'       => ':attribute harus diisi minimal :min karakter ',
            'max'       => ':attribute harus diisi maksimal :max karakter ',
            'email'     =>  ':attribute harus berupa email yang valid.',
            'unique'    =>  ':attribute sudah ada gunakan email yang lain',
            'confirmed'  =>  'isi :attribute dengan benar',
            'string'    =>  ':attribute harus berupa huruf',
            'failed'   => 'Email atau password saldah.',
            'throttle' => 'Terlalu banyak usaha masuk. Silahkan coba lagi dalam :seconds detik.',
        ];

        $request->validate([
            $this->username() => 'required|string|failed',
            'password' => 'required|string|failed',
        ], $message);
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
