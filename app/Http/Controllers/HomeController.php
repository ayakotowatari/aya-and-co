<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//test
use App\Models\Guest;
use App\Models\Order;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('main');
        return redirect('/');
    }

    public function email()
    {
        $user = Guest::where('id', 105)->first();

        $order = Order::where("id", 176) ->first();
        
        return view('emails.email_design', ['user' => $user, 'order' => $order]);
    }
    

    public function adminLogin()
    {
        return view('admin.auth.login_vue');
    }

    public function adminRegister()
    {
        return view('admin.auth.register_vue');
    }
}
