
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Newspaper</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .register-container {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
        }

        .register-container h1 {
            text-align: center;
        }

        .register-container label {
            display: block;
            margin: 15px 0 6px;
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .register-container button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            color: white;
            background: #1d4ed8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
        }

        .register-container .links {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h1>Create Account</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label for="name">Full Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
            autocomplete="name"
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
            autocomplete="username"
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
            autocomplete="new-password"
        >

        <label for="password_confirmation">Confirm Password</label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
            autocomplete="new-password"
        >

        <button type="submit">Register</button>
    </form>

    <div class="links">
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </div>
</div>

</body>
</html>
