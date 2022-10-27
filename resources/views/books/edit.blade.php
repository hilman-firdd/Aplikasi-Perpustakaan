@extends('layouts.master')
@section('title', 'Halaman Edit Book')

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
    <h1>Edit Book</h1>

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
        
        <form action="{{ route('books.update', $book->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div>
                <label for="name" class="form-label">Code</label>
                <input type="text" name="book_code" class="form-control" placeholder="Book Code" value="{{ $book->book_code }}">
            </div>
            <div>
                <label for="name" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Book Title" value="{{ $book->title }}">
            </div>
            <div>
                <label for="name" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" placeholder="Book Image">
            </div>

            <div>
                <label for="currentImage" class="form-label d-block">Current Image</label>
                @if($book->cover != "")
                    <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="" width="300">
                @else
                    <img src="{{ asset('images/image-not-found.jpg') }}" alt="" width="300">
                @endif
            </div>

            <div>
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                    @foreach ($categories as $key => $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3">
                <label for="currentCategory">Current Category</label>
                <ul>
                    @foreach ($book->categories as $data)
                        <li>{{ $data->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection 