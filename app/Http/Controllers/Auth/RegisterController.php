<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Role;
use App\Models\User_detail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_detail_jk' => 'required|string|max:255',
            'user_detail_phone' => 'required|string|max:255',
            'user_detail_province' => 'required|string|max:255',
            'user_detail_city' => 'required|string|max:255',
            'user_detail_subdist' => 'required|string|max:255',
            'user_detail_pos' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // update detail user
        if($user){
            $user_detail = User_detail::create([
                'user_detail_user_id' => $user->id,
                'user_detail_jk' => $data['user_detail_jk'],
                'user_detail_address' => "",//$data['user_detail_address'],
                'user_detail_phone' => $data['user_detail_phone'],
                'user_detail_province' => 1,//$data['user_detail_province'],
                'user_detail_city' => 1,//$data['user_detail_city'],
                'user_detail_subdist' => 1,//$data['user_detail_subdist'],
                'user_detail_pos' => $data['user_detail_pos'],
                'user_detail_token' => "",//$data['user_detail_status'],
                'user_detail_status' => 0//$data['user_detail_status'],
            ]);
        }

        // get role member
        $memberRole = Role::where('name', 'member')->pluck('name');
        $insert_role = $user->assignRole($memberRole);
        Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Periksa Email Anda Untuk Informasi Lebih Lanjut"
            ]);
        return $user;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register_green');
    }

}
