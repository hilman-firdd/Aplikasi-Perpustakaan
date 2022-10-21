<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoriCount = Category::count();
        $userCount = User::count();
        return view('dashboard', compact('bookCount', 'categoriCount', 'userCount'));
    }
}
