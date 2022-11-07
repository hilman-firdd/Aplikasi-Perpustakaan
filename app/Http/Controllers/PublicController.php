<?php

namespace App\Http\Controllers;

use App\Models\Book;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if($request->category || $request->title) {
            $books = Book::where('title', 'like', '%'.$request->title.'%')->get();
        }else{
            $books = Book::all();
        }
        return view('books.book-list', compact('books', 'categories'));
}
