<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel App')</title>

    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            {{-- Brand points admins to /admin, others to home --}}
            <a class="navbar-brand" 
               href="@auth {{ auth()->user()->type === 'admin' ? route('admin.posts.index') : url('/') }} @else {{ url('/') }} @endauth">
               Assignment 2 COSC360/COSC560
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    {{-- Dashboard --}}
                    @auth
                        @if(auth()->user()->type === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/admin') }}">Dashboard</a>
                            </li>

                            {{-- Admin-only links --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                            </li>
                        @else
                            {{-- Regular user: public posts (optional, if you added them) --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/posts') }}">Posts</a>
                            </li>
                        @endif
                    @endauth

                    {{-- Auth links --}}
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- GLOBAL FLASH MESSAGES --}}
    @if(session('success') || session('error'))
        <div class="container mt-3">
            @if(session('success'))
                <div class="alert alert-success mb-0">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-0">{{ session('error') }}</div>
            @endif
        </div>
    @endif

    {{-- PAGE CONTENT --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="text-center text-muted py-3 border-top">
        <small>&copy; {{ now()->year }} Assignment 2 COSC360/COSC560</small>
    </footer>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
