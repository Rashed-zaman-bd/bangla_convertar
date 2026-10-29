<!doctype html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'All Bangla Newspapers')</title>
    <meta name="description" content="@yield('description', 'Bangla newspapers, e-papers, TV channels, radio and news websites in one place.')">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>

<body>
    @include('components.header')
    <main class="wrap">
        @include('components.advertisement', [
            'slot' => 'home-top',
            'className' => 'ad-leader',
            'label' => 'Advertisement · 970×90',
        ])
        @yield('content')
        @include('components.advertisement', [
            'slot' => 'home-bottom',
            'className' => 'ad-bottom',
            'label' => 'Advertisement · 970×90',
        ])
    </main>
    @include('components.footer')
</body>

</html>
