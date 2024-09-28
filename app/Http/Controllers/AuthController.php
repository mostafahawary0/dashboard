<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{
    function login()
    {
     
        if (Auth::guard('web')->check()){
            return redirect(route('home'));
        }
        return view('dashboard.auth.login');
    }

    function loginpost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request -> only ('email' , 'password');
        if(Auth::guard('web')->attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error","Login error");
     }

     function logout(){
        Auth::guard('web')->logout();
        return redirect(route('login'));
     }
     
}
