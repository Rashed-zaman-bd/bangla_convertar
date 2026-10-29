
@extends('admin.layout')

@section('title', 'Edit Advertisement')

@section('content')
    <h1>Edit Advertisement</h1>

    <form
        action="{{ route('admin.advertisements.update', $advertisement) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.advertisements._form')

    </form>
@endsection
