
@extends('layouts.admin')

@section('title', 'Create Advertisement')

@section('content')
    <h1>Create Advertisement</h1>

    <form
        action="{{ route('admin.advertisements.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        @include('admin.advertisements._form')

    </form>
@endsection
