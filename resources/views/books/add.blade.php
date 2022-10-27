@extends('layouts.master')
@section('title', 'Halaman Book')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('script')
<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endpush
@section('content')
    <h1>Add New Book</h1>

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

        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="form-label">Code</label>
                <input type="text" name="book_code" class="form-control" placeholder="Book Code" value="{{ old('book_code') }}">
            </div>
            <div>
                <label for="name" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Book Title" value="{{ old('title') }}">
            </div>
            <div>
                <label for="name" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" placeholder="Book Image">
            </div>

            <div>
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                    <option value="">Choose Category</option>
                    @foreach ($categories as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection 