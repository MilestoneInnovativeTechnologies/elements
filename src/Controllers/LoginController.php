<?php

namespace Milestone\Elements\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login (Request $request) {

        if(Auth::attempt($request->validate(['email' => ['required', 'email'],'password' => ['required']]))){
            $request->session()->regenerate();
            return redirect()->route(Auth::user()->role === 'executive' ? 'index' : 'index');
        }

        return redirect()->route('login');

    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
