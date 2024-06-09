<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authentication extends Controller
{
    public function index()
    {
        return view('login.index',[
            'pageTitle' => 'Login'
        ]);
    }

    public function login(Request $request)
    { 
        if(auth()->guard('web')->attempt(['username' => $request->username, 'password' => $request->password])){
            if(auth()->user()->role == 'admin'){
                return redirect('/dashboard/admin');
            }else{
                return redirect('/dashboard/penjabat');
            }
        }else{
            return back()->with('loginFailed', 'Username atau Password anda salah');
        }

    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
