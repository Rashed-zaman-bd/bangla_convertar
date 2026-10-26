@extends('admin.layout')
@section('title', 'Edit Newspaper')
@section('content')
<h1>Edit newspaper / website</h1>
<form class="form-card" method="POST" enctype="multipart/form-data" action="{{ route('admin.newspapers.update', $newspaper) }}">@csrf @method('PUT') @include('admin.newspapers._form')</form>
@endsection
