<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Newspaper Admin')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="topbar">
    <div class="topbar-inner admin-header">
        <a class="brand" href="{{ route('home') }}">NEWSPAPER ADMIN<small>Manage website data</small></a>
        <nav class="menu admin-menu">
            <a href="{{ route('admin.newspaper-categories.index') }}">Categories</a>
            <a href="{{ route('admin.newspapers.index') }}">Newspapers</a>
            <a href="{{ route('home') }}">View website</a>
        </nav>
    </div>
</header>
<main class="wrap admin-wrap">
    @if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="alert error"><strong>Please fix these errors:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
</main>
<footer>Newspaper administration</footer>
</body>
</html>
