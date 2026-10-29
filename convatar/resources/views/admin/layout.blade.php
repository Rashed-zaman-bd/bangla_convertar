
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Newspaper Admin')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin: 24px 0;
        }

        .stat-card {
            padding: 20px;
            border-radius: 10px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
        }

        .stat-card h3 {
            margin: 0 0 10px;
            font-size: 14px;
            color: #475569;
        }

        .stat-card p {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }

        .admin-user {
            font-size: 14px;
            color: #475569;
        }

        .logout-button {
            padding: 8px 14px;
            border: 0;
            border-radius: 5px;
            background: #dc2626;
            color: white;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #b91c1c;
        }
    </style>

    @stack('styles')
</head>

<body>

<header class="topbar">
    <div class="topbar-inner admin-header">

        <a class="brand" href="{{ route('home') }}">
            NEWSPAPER ADMIN
            <small>Manage website data</small>
        </a>

        <nav class="menu admin-menu">
            <a href="{{ route('admin.newspaper-categories.index') }}">
                Categories
            </a>

            <a href="{{ route('admin.newspapers.index') }}">
                Newspapers
            </a>

            <a href="{{ route('admin.advertisements.index') }}">
                Advertisements
            </a>

            <a href="{{ route('home') }}">
                View Website
            </a>

            <span class="admin-user">
                {{ auth()->user()->name ?? 'Admin' }}
            </span>

            <form action="{{ route('logout') }}"
                  method="POST"
                  style="display: inline;">
                @csrf

                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </nav>

    </div>
</header>

<main class="wrap admin-wrap">

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert error">
            <strong>Please fix these errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Visitor statistics --}}
    @php
        $totalVisitors = \App\Models\Visitor::count();

        $todayVisitors = \App\Models\Visitor::whereDate(
            'created_at',
            today()
        )->count();
    @endphp

    <section class="admin-stats">
        <div class="stat-card">
            <h3>Total Page Views</h3>
            <p>{{ number_format($totalVisitors) }}</p>
        </div>

        <div class="stat-card">
            <h3>Today's Page Views</h3>
            <p>{{ number_format($todayVisitors) }}</p>
        </div>
    </section>

    {{-- Page content --}}
    @yield('content')

</main>

<footer>
    <p style="text-align: center; padding: 20px;">
        Newspaper Administration &copy; {{ date('Y') }}
    </p>
</footer>

@stack('scripts')

</body>
</html>
