@extends('layouts.master')
@section('title', 'Banned Users')

@section('content')
    <h1>Banned User List</h1>

    <div class="mt-5">
        <a href="{{ route('category.deleted') }}" class="btn btn-primary">View Banned Users</a>
        <a href="{{ route('users.registered') }}" class="btn btn-primary">Registered Users</a>
    </div>

    <div class="mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Username</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bannedUser as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ ($data->phone == true ? $data->phone : '-') }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="/users/user-restore/{{ $data->slug }}" class="btn btn-warning">Restore</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection