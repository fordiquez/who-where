@extends('assets.layout')

@section('title', strtoupper($country->name))

@section('content')
    <div class="container-fluid">
        <div class="row row-cols-1 col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <div class="card">
                <img src="{{ asset($country->flag) }}" class="card-img-top mt-3" alt="{{ $country->name }}" title="{{ $country->name }}">
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
                                    <i class="bi bi-file-binary"></i>
                                    <b>ISO 3166-2 code:</b>
                                    <span class="badge bg-primary rounded-pill">{{ $country->code }}</span>
                                </p>
                            </li>
                            @if($country->uefa_position)
                                <li class="list-group-item">
                                    <p class="card-text">
                                        <i class="bi bi-list-ol"></i>
                                        <b>UEFA position:</b>
                                        <span class="badge bg-primary rounded-pill">{{ $country->uefa_position }}</span>
                                    </p>
                                </li>
                            @endif
                            @if($country->uefa_coefficient_points)
                                <li class="list-group-item">
                                    <p class="card-text">
                                        <i class="bi bi-star-fill"></i>
                                        <b>UEFA coefficient points:</b>
                                        <span class="badge bg-primary rounded-pill">{{ $country->uefa_coefficient_points }}</span>
                                    </p>
                                </li>
                            @endif
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-bookmark-star-fill"></i>
                                    <b>Total leagues:</b>
                                    <span class="badge bg-primary rounded-pill">
                                        @foreach($totalLeagues as $league)
                                            @if ($league->id == $country->id)
                                                <span>{{ $league->total_count }}</span>
                                            @endif
                                        @endforeach
                                    </span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-list-ol"></i>
                                    <b>First Tier League:</b>
                                    <span class="badge bg-primary rounded-pill">
                                        @if ($country->league)
                                            <a href="{{ route('league.show', $country->league->id) }}" class="custom-link">
                                                {{ $country->league->name }}
                                            </a>
                                        @else
                                            Undefined
                                        @endif
                                    </span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-shop"></i>
                                    <b>Total clubs:</b>
                                    <span class="badge bg-primary rounded-pill">
                                        @foreach($totalClubs as $club)
                                            @if ($club->id == $country->id)
                                                {{ $club->total_count }}
                                            @endif
                                        @endforeach
                                    </span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <p class="card-text">
                                    <i class="bi bi-people-fill"></i>
                                    <b>Total players:</b>
                                    <span class="badge bg-primary rounded-pill">
                                        @foreach($totalPlayers as $player)
                                            @if ($player->id == $country->id)
                                                {{ $player->total_count }}
                                            @endif
                                        @endforeach
                                    </span>
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
