<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $request->session()->flush();
        dd('halaman admin user');
    }
}
