<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;

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

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet, please contact admin!');
                return redirect('/login');
            }

            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('/users/profile');
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

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->slug = SlugService::createSlug(User::class, 'slug', $request->username);
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Register success, wait admin for approval');
        return redirect('/register');
    }
}
