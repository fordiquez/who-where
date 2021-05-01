@extends('assets.layout')

@section('content')
    <div class="container">
        <div class="row row-cols-1 col-lg-6 offset-lg-3">
            <div class="card">
                <img src="{{ $country->flag }}" class="card-img-top" alt="{{ $country->name }}" title="{{ $country->name }}">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-flag-fill"></i>
                                {{ $country->name }}
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-shop-window"></i>
                                    <b>Total leagues:</b> <span class="badge bg-primary rounded-pill">0</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-shop-window"></i>
                                    <b>First Tier League:</b> <span class="badge bg-primary rounded-pill">
                                        @if ($country->league)
                                            {{ $country->league->name }}
                                        @else
                                            Undefined
                                        @endif
                                    </span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-shop-window"></i>
                                    <b>Total clubs:</b> <span class="badge bg-primary rounded-pill">0</span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-shop-window"></i>
                                    <b>Total players:</b> <span class="badge bg-primary rounded-pill">0</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-footer footer-links">
                    <a href="{{ route('country.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span>Return back</span>
                    </a>
                    <a href="{{ route('league.index', $country) }}" class="btn btn-primary float-end">
                        <i class="bi bi-table"></i>
                        <span>Leagues</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
