<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use App\Role;
use App\Models\Province;
use App\Models\City;
use App\Models\Subdistrict;
use App\Models\User_detail;
use App\Models\User_address;
use App\Models\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use FunctionLib;

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
    protected $redirectTo = '/';

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

        $messages = [
            'required'  => ':attribute wajib diisi ',
            'min'       => ':attribute harus diisi minimal :min karakter ',
            'max'       => ':attribute harus diisi maksimal :max karakter ',
            'email'     =>  ':attribute harus berupa email yang valid.',
            'unique'    =>  ':attribute sudah ada gunakan :attribute yang lain',
            'confirmed'  =>  'isi :attribute dengan benar',
            'string'    =>  ':attribute harus berupa huruf',
        ];
        
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_detail_jk' => 'required|string|max:255',
            'user_detail_phone' => 'required|string|max:20',
            'user_detail_province' => 'required|string|max:10',
            'user_detail_city' => 'required|string|max:10',
            'user_detail_subdist' => 'required|string|max:10',
            'user_detail_pos' => 'required|string|max:10',
        ], $messages);
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
            'reff_code' => FunctionLib::str_rand(3).'-'.rand(0, 999999),
            'token_register'=>str_random(190)
        ]);

        $sponsor = 2;
        if($data['code_reveral'] !== null && $data['code_reveral'] !== ''){
            $code = User::whereRaw('reff_code LIKE "%'.$data['code_reveral'].'%"');
            $sponsor = ($code->exists())?$code->first()->id:$sponsor;
        }

        // update detail user
        if($user){
            $user_detail = User_detail::create([
                'user_detail_user_id' => $user->id,
                'user_detail_pass_trx' => $user->password,
                'user_detail_jk' => $data['user_detail_jk'],
                // 'user_detail_address' => $data['user_detail_address'],
                'user_detail_phone' => $data['user_detail_phone'],
                'user_detail_province' => $data['user_detail_province'],
                'user_detail_city' => $data['user_detail_city'],
                'user_detail_subdist' => $data['user_detail_subdist'],
                'user_detail_pos' => $data['user_detail_pos'],
                'user_detail_token' => "",//$data['user_detail_status'],
                'user_detail_status' => 0//$data['user_detail_status'],
            ]);
            $user_sponsor = Sponsor::create([
                'user_tree_user_id' => $user->id,
                'user_tree_sponsor_id' => $sponsor,
            ]);
            $user_address = User_address::create([
                'user_address_user_id' => $user->id,
                'user_address_label' => 'Saya',
                'user_address_owner' => $data['name'],
                'user_address_address' => " ",
                'user_address_phone' => $data['user_detail_phone'],
                'user_address_province' => $data['user_detail_province'],
                'user_address_city' => $data['user_detail_city'],
                'user_address_subdist' => $data['user_detail_subdist'],
                'user_address_pos' => $data['user_detail_pos'],
            ]);
            // insert config user
            $arr = FunctionLib::UserConfigArr();
            foreach ($arr as $item) {
                $param = [
                    'id' => $user->id,
                    'name' => $item['name'],
                    'value' => $item['value'],
                    'note' => $item['note'],
                ];
                $create = FunctionLib::CreateUserConfig($param);
                $status = ($create['status'] == 200)?'berhasil':'gagal';
            }
        }

        // get role member
        $memberRole = Role::where('name', 'member')->pluck('name');
        $insert_role = $user->assignRole($memberRole);
        Session::flash("flash_status", 200);
        Session::flash("flash_message","Periksa Email Anda Untuk Informasi Lebih Lanjut");
        return $user;

    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data['province'] = Province::all();
        $data['city'] = City::all();
        $data['subdistrict'] = Subdistrict::all();
        $data['sponsor'] = User::limit(3)->get();
        return view('auth.register_green', $data);
    }

    public function activating($token)
    {
        Auth::logout();
        $date = date('Y-m-d H:i:s');
        $model = User::where('token_register', $token)->first();
        if(!empty($model)){
            $model->email_verified_at = $date;
            $model->active = true;
            $model->save();
            return redirect('login')
                ->with(['flash_status' => 200, 'flash_message' => 'akun anda telah aktif silahkan login.']);
        }
        Auth::login($model);
        return redirect('login')
            ->with(['flash_status' => 500, 'flash_message' => 'Verifikasi gagal.']);
    }

}
