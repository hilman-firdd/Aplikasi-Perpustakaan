<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', 2)->where('status', 'active')->get();
        return view('users.user', compact('user'));
    }

    public function profile()
    {
        return view('users.profile');
    }

    public function registeredUser()
    {
        $registered = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('users.registered', compact('registered'));
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('users.user-detail', compact('user'));
    }
}
