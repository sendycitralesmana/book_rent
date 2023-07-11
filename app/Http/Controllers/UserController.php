<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', '!=', 1)->where('status', 'active')->get();
        return view('users/index', [
            'user' => $user
        ]);
    }

    public function registeredUser()
    {
        $user = User::where('role_id', '!=', 1)->where('status', 'inactive')->get();
        return view('users/registered-user', [
            'user' => $user
        ]);
    }

    public function profile()
    {
        $rent = RentLog::with(['user', 'book'])->where('user_id', auth()->user()->id)->get();
        return view('users/profile', [
            'rent' => $rent
        ]);
    }

    public function detail($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $rent = RentLog::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('users/detail', [
            'user' => $user,
            'rent' => $rent
        ]);
    }

    public function approveUser($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = "active";
        $user->update();
        
        Session::flash('status', 'success');
        Session::flash('message', 'Approved user successfully');
        return redirect('/users'.$slug.'/detail');
    }

    public function banned($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'User banned successfully');
        return redirect('/users');
    }

    public function showBanned()
    {
        $user = User::onlyTrashed()->get();
        return view('users/show-banned', [
            'user' => $user
        ]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        Session::flash('status', 'success');
        Session::flash('message', 'User restore successfully');
        return redirect('/users');
    }
}
