<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css') }}">
    <!-- Project main CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    @yield('custom-css')
    <title>Transfers List</title>
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @if(session('message'))
        <div class="container-fluid">
            <div class="alert alert-success text-center" role="alert">
                <strong>{{ session('message') }}</strong>
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
