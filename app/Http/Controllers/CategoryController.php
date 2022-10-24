<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function add()
    {
        return view('category.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:100'
        ]);

        Category::create($request->all());
        return redirect('categories')->with('status', 'Category Added Successfuly');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('categories')->with('status', 'Category Updated Successfuly');
    }
    
    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('categories')->with('status', 'Category Deleted Successfuly');
    }

    public function deleted()
    {
        $deleted = Category::onlyTrashed()->get();
        return view('category.deleted', compact('deleted'));
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('categories')->with('status', 'Category Restored Successfuly');
    }
}
