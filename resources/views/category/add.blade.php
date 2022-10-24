@extends('layouts.master')
@section('title', 'Halaman Kategori')

@section('content')
    <h1>Add New Category</h1>

    <div class="mt-5 w-50">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Category Name">
            </div>
            <div class="mt-3">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection