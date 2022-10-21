<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        return view('rent_log');
    }
}
