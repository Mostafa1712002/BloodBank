<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Routing\Controller;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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

        $rules = [
            'name' => ['required', 'max:255',"min:10"],
            'email' => ['required',  'email', 'unique:users,email'],
            'password' => ['required',  'min:8', 'confirmed'],
        ];
        $messages = [
            "name.required" => "الاسم مطلوب",
            "name.max" => "الحد الأقصي من الحروف الاسم هو 255",
            "name.min" => "الحد الأدني من حروف الاسم هو 10",
            "email.required" => "البريد الالكتروني مطلوب",
            "email.unique" => "هذا البريد الالكتروني موجود من قبل",
            "email.email" => "هذا البريد الالكتروني غير صالح",
            "password.required" => "كلمة المرور مطلوبه",
            "password.min" => "الحد الادني من الحروف هو 8",
            "password.confirmed" => "كلمتي المرور غير مطباقين",
        ];
        return Validator::make($data,$rules,$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
