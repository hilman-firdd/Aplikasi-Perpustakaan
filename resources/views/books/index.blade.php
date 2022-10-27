@extends('layouts.master')
@section('title', 'Halaman Book')

@section('content')
 <h1>Book List</h1>

 <div class="mt-5 d-flex justify-content-end">
    <a href="{{ route('books.deleted') }}" class="btn btn-primary me-2">View Deleted Data</a>
    <a href="{{ route('books.add') }}" class="btn btn-primary">Add Data</a>
 </div>

 <div class="mt-5">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>

 <div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->book_code }}</td>
                    <td>{{ $data->title }}</td>
                    <td>
                        @foreach ($data->categories as $item)
                            {{ $item->name }} <br>
                        @endforeach
                    </td>
                    <td>{{ $data->status }}</td>
                    <td>
                        <div class="d-flex">
                            <form method="POST" action="{{ route('books.delete', $data->slug) }}">
                                <a href="{{ route('books.edit', $data->slug) }}" class="btn btn-warning me-2">edit</a>
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('apakah yakin mau dihapus?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection