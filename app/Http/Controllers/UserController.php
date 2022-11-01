<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', 2)->get();
        return view('users.user', compact('user'));
    }

    public function profile()
    {
        return view('users.profile');
    }
}
