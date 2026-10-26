@extends('admin.layout')
@section('title', 'Add Newspaper')
@section('content')
<h1>Add newspaper / website</h1>
<form class="form-card" method="POST" enctype="multipart/form-data" action="{{ route('admin.newspapers.store') }}">@csrf @include('admin.newspapers._form')</form>
@endsection
