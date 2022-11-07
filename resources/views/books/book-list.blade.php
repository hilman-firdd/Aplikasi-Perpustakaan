@extends('layouts.master')
@section('title', 'Halaman Book')

@section('content')
 <form action="">
     <div class="row">
        <div class="col-12 col-sm-6">
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="title" placeholder="search books..">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
     </div>
 </form>

 <div class="my-5">
    <div class="row">
        @foreach ($books as $item)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card h-100">
                <img src="{{ $item->cover != null ? asset('storage/cover/'. $item->cover) : asset('images/image-not-found.jpg') }}" class="card-img-top h-100" alt="..." draggable="false">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->book_code }}</h5>
                    <p class="card-text">{{ $item->title }}</p>
                    <p class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">
                        {{ $item->status }}
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>       
        </div>
        @endforeach
    </div>
 </div>
@endsection