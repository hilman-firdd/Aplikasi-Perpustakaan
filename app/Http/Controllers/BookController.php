<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', 1);
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
        if ($request->file('image')) {
            $exten = $request->file('image')->getClientOriginalExtension();
            $newImage = $request->title . '-' . now()->timestamp . '.' . $exten;
            $request->file('image')->storeAs('cover', $newImage);
        }

        $request['cover'] = $newImage;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfully');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update($slug, Request $request)
    {
        if ($request->file('image')) {
            $exten = $request->file('image')->getClientOriginalExtension();
            $newImage = $request->title . '-' . now()->timestamp . '.' . $exten;
            $request->file('image')->storeAs('cover', $newImage);
            $request['cover'] = $newImage;
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfully');
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('books')->with('status', 'Book Deleted Successfully');
    }

    public function deleted()
    {
        $book = Book::onlyTrashed()->get();
        return view('books.deleted', compact('book'));
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('books')->with('status', 'Book Restored Successfully');
    }
}
