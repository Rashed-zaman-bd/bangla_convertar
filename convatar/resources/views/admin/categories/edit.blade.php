@extends('admin.layout')
@section('title', 'Edit Category')
@section('content')
    <h1>Edit category</h1>
    <form class="form-card" method="POST" action="{{ route('admin.newspaper-categories.update', $category) }}">@csrf
        @method('PUT') @include('admin.categories._form')</form>
@endsection
