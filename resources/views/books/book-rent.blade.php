@extends('layouts.master')
@section('title', 'Book Rent')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-5">Book Rent Form</h1>

        <div class="mt-5">
            @if (session('alert-class'))
                <div class="alert {{ session('alert-class') }}">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <form action="{{ route('book-rent.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="" class="form-control inputbox">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book</label>
                <select name="book_id" id="" class="form-control inputbox">
                    <option value="">Select Book</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.inputbox').select2();
        });
    </script>
    @endpush
@endsection