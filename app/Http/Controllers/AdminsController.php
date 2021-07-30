<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
    
        return response()->json(['user'=>$user],200);
    }
}
