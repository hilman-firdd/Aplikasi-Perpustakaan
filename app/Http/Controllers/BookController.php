<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function add()
    {
      $categories = Category::all();
      return view('books.add', compact('categories'));  
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_code' => 'required|unique:books|max:100',
            'title' => 'required|max:255',
        ]);

        $newImage = '';
        if($request->file('image')) {
            $exten = $request->file('image')->getClientOriginalExtension();
            $newImage = $request->title.'-'.now()->timestamp.'.'.$exten;
            $request->file('image')->storeAs('cover', $newImage);
        }

        $request['cover'] = $newImage;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfully');
    }
}
