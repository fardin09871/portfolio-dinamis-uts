
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login — Fardin.dev</title>

    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            background:
                radial-gradient(ellipse at 10% 20%, rgba(230,36,41,.15), transparent 40%),
                radial-gradient(ellipse at 90% 90%, rgba(25,60,120,.15), transparent 40%),
                #05070d;
            color: white;
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 45px;
            background: #0d1019;
            border: 1px solid rgba(255,255,255,.12);
            box-shadow: 12px 12px 0 rgba(230,36,41,.15);
        }

        .brand {
            font-family: 'Anton', sans-serif;
            font-size: 35px;
            margin-bottom: 45px;
        }

        .brand span {
            color: #e62429;
        }

        .eyebrow {
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 3px;
            color: #e62429;
        }

        h1 {
            margin-top: 12px;
            font-family: 'Anton', sans-serif;
            font-size: 55px;
            font-weight: 400;
        }

        .description {
            margin-top: 8px;
            margin-bottom: 35px;
            color: #858b9b;
            font-size: 12px;
            line-height: 1.8;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 15px;
            background: #080a10;
            border: 1px solid rgba(255,255,255,.13);
            outline: none;
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            transition: .2s;
        }

        input:focus {
            border-color: #e62429;
        }

        .error {
            display: block;
            margin-top: 8px;
            color: #ff7378;
            font-size: 11px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px;
            background: rgba(230,36,41,.1);
            border: 1px solid rgba(230,36,41,.3);
            color: #ff7378;
            font-size: 11px;
        }

        .login-btn {
            width: 100%;
            margin-top: 10px;
            padding: 16px;
            background: #e62429;
            border: 1px solid #e62429;
            color: white;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 2px;
            cursor: pointer;
            transition: .3s;
        }

        .login-btn:hover {
            background: transparent;
            color: #ff4248;
        }

        .footer {
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.1);
            color: #686d7c;
            font-size: 9px;
            letter-spacing: 1px;
            text-align: center;
        }

        @media(max-width: 480px) {
            .login-card {
                padding: 30px 24px;
            }
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="brand">
        FARDIN<span>.</span>DEV
    </div>

    <div class="eyebrow">RESTRICTED ACCESS / 001</div>

    <h1>ADMIN LOGIN<span style="color:#e62429">.</span></h1>

    <p class="description">
        Welcome back, administrator.
        Sign in to manage your portfolio universe.
    </p>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">EMAIL ADDRESS</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="admin@fardin.dev"
                value="{{ old('email') }}"
                autocomplete="username"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="password">PASSWORD</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >
        </div>

        <button type="submit" class="login-btn">
            ACCESS DASHBOARD →
        </button>
    </form>

    <div class="footer">
        FARDIN.DEV — ADMIN CONTROL CENTER
    </div>

</div>

</body>
</html>
