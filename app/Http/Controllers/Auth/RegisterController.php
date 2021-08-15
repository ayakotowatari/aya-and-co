<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return Validator::make($data, [
            'user_type_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'integer'],
            'prefecture' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address_1' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->whereNull('deleted_at'),],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        return User::create([
            'user_type_id' => $data['user_type_id'],
            'name' => $data['name'],
            'kana' => $data['kana'],
            'zipcode' => $data['zipcode'],
            'prefecture' => $data['prefecture'],
            'city' => $data['city'],
            'address_1' => $data['address_1'],
            'building' => $data['building'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'life' => 1,
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return $user;
    }
}
