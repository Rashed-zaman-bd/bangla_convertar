
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .login-container {
            max-width: 420px;
            margin: 70px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .login-container h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-container label {
            display: block;
            margin: 15px 0 6px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #1d4ed8;
            color: white;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-error {
            color: #dc2626;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>Admin Login</h1>

    @if ($errors->any())
        <div class="login-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            autocomplete="username"
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="current-password"
        >

        <label>
            <input
                type="checkbox"
                name="remember"
                value="1"
                style="width: auto;"
            >
            Remember me
        </label>

        <button type="submit">Login</button>
    </form>
    <p style="text-align: center; margin-top: 20px;">
        Don't have an account?
        <a href="{{ route('register') }}">Register</a>
    </p>
</div>

</body>
</html>
