@extends('layouts.master')
@section('title', 'Profile')

@section('content')
<div class="mt-5">
    <h4>Your Rent Log</h4>
    <x-rent-log-table :rentlog='$rentlogs' />
</div>
@endsection