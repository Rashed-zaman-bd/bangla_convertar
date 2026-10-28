@extends('admin.layout')
@section('title', 'Add Category')
@section('content')
    <h1>Add category</h1>
    <form class="form-card" method="POST" action="{{ route('admin.newspaper-categories.store') }}">@csrf
        @include('admin.categories._form')</form>
@endsection
