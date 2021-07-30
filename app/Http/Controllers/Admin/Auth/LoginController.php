<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    //
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
    protected $redirectTo = "/admin/orders-list";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //ログインフォームのviews
    public function showLoginForm()
    {
        return view ('admin/auth/login_vue');
    }

    //持たせるガードの名前
    protected function guard()
    {
        return Auth::guard ('admin');
    }

    protected function loggedOut(Request $reuqest)
    {
        return redirect ('/admin/login');
    }

    // protected function loggedOut(Request $reuqest)
    // {
    //     return redirect ('/');
    // }
}
