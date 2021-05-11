<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icon -->
    @yield('icon')
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css') }}">
    <!-- Project main CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    @yield('custom-css')
    <title>@yield('title') – WHO-WHERE</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('/assets/images/front-end/brand-logo.png') }}" alt="Who Where logo" title="Who Where logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('root') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('country.index') }}">Countries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('league.index') }}">Leagues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('club.index') }}">Clubs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('player.index') }}">Players</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transfer.index') }}">Transfers</a>
                    </li>
                </ul>
                <form class="d-flex" method="get" action="{{ route('players.search') }}">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search players">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @if(session('message'))
        <div class="container-fluid">
            <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                    <use xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    <strong>{{ session('message') }}</strong>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container-fluid">
            <div class="alert alert-danger text-center" role="alert">
                <strong>{{session('error')}}</strong>
            </div>
        </div>
    @endif
</header>

<main>
    @yield('content')
</main>
<script src="{{ asset('/assets/js/popper.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.js') }}"></script>
@yield('custom-js')
</body>
</html>
