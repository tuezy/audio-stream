<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customers')->except('logout');
    }

    public function showLoginForm(){
        return view('index.pages.auth.login');
    }

    public function showResetPasswordForm(){
        return view('index.pages.auth.reset-pass');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('customers')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' =>  __('dashboard.errors.login.email'),
            'password' =>  __('dashboard.errors.login.password'),
        ]);
    }
    public function logout(Request $request){

        Auth::guard('customers')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
