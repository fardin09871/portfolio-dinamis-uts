
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') — Fardin.dev</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #080a10;
            color: #f5f5f5;
            font-family: 'Inter', sans-serif;
        }

        .admin-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: #0d1019;
            border-right: 1px solid rgba(255,255,255,.08);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-family: 'Anton', sans-serif;
            font-size: 28px;
            letter-spacing: 1px;
            margin-bottom: 50px;
        }

        .brand span {
            color: #e62429;
        }

        .nav-label {
            font-size: 9px;
            font-weight: 900;
            letter-spacing: 2px;
            color: #686d7c;
            margin-bottom: 15px;
        }

        .nav-link {
            display: block;
            padding: 13px 15px;
            margin-bottom: 7px;
            color: #92929c;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid transparent;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background: rgba(230,36,41,.12);
            border-color: rgba(230,36,41,.25);
        }

        .nav-link.active {
            border-left: 3px solid #e62429;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 20px;
        }

        .admin-profile {
            margin-bottom: 20px;
        }

        .admin-profile strong {
            display: block;
            font-size: 12px;
        }

        .admin-profile small {
            color: #777d8d;
            font-size: 10px;
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: transparent;
            border: 1px solid rgba(230,36,41,.4);
            color: #ff555b;
            font-weight: 800;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #e62429;
            color: white;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            padding: 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .topbar h1 {
            font-family: 'Anton', sans-serif;
            font-size: 38px;
            font-weight: 400;
        }

        .topbar p {
            color: #858b9b;
            font-size: 11px;
            margin-top: 5px;
        }

        .topbar-badge {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #8affbd;
            border: 1px solid rgba(138,255,189,.25);
            padding: 10px 14px;
        }

        .alert {
            padding: 15px 18px;
            margin-bottom: 25px;
            font-size: 12px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(98,230,161,.08);
            border-color: rgba(98,230,161,.3);
            color: #8affbd;
        }

        .alert-error {
            background: rgba(230,36,41,.08);
            border-color: rgba(230,36,41,.3);
            color: #ff7378;
        }

        @media(max-width: 750px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
            }

            .brand {
                margin-bottom: 20px;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .main-content {
                padding: 25px 18px;
            }

            .topbar h1 {
                font-size: 30px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="admin-wrapper">

    <aside class="sidebar">

        <div class="brand">
            FARDIN<span>.</span>DEV
        </div>

        <div class="nav-label">MAIN MENU</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.about.index') }}"
           class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
            About
        </a>

        <a href="{{ route('admin.tech-stacks.index') }}"
           class="nav-link {{ request()->routeIs('admin.tech-stacks.*') ? 'active' : '' }}">
            Skills
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            Projects
        </a>

        <a href="{{ route('admin.contact.index') }}"
           class="nav-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
            Contact
        </a>

        <div class="sidebar-bottom">

            <div class="admin-profile">
                <strong>{{ $admin->name ?? 'Admin' }}</strong>
                <small>{{ $admin->email ?? '' }}</small>
            </div>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    SIGN OUT
                </button>
            </form>

        </div>

    </aside>

    <main class="main-content">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

@stack('scripts')

</body>
</html>
