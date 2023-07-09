<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths/login');
    }

    public function register()
    {
        return view('auths/register');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            if (Auth::user()->status != 'active') {
                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet, please contact admin!');
                return redirect('/login');
            }

            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('/user/profile');
            }
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login invalid');
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
