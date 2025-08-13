<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="mb-4 navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Laravel Shop</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @guest('admin')
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('admin.login')) active @endif" 
                           href="{{ route('admin.login') }}">Admin Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="px-3 nav-link btn btn-link text-light" type="submit">Admin Logout</button>
                        </form>
                    </li>
                    @endguest

                    @guest
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('login')) active @endif" 
                           href="{{ route('login') }}">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('register')) active @endif" 
                           href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-3 nav-link btn btn-link text-light" type="submit">Logout</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>