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

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('/users/user-detail/'. $slug)->with('status', 'User Approved Successfuly');
    }
    
    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Deleted Successfuly');
    }
    
    public function bannedUser()
    {
        $bannedUser = User::onlyTrashed()->get();
        return view('users.user-banned', compact('bannedUser'));
    }
    
    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        
        return redirect()->route('users.index')->with('status', 'User Restored Successfuly');
    }
}
