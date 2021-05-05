@extends('assets.layout')

@section('title', $club->name)

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="club-title">
                        <h5 class="mt-2">
                            <a href="{{ route('club.index', $club->league->id) }}">
                                <img src="{{ asset($club->league->logo) }}" class="medium-logo" alt="{{ $club->league->name }}" title="{{ $club->league->name }}">
                            </a>
                            <span>{{ $club->name }}</span>
                        </h5>
                    </div>
                    <div class="col-md-2 club-logo-column">
                        <div class="club-logo-item">
                            <img src="{{ asset($club->logo) }}" alt="{{ $club->name }}" title="{{ $club->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Squad size:</span>
                                <span>24</span>
                            </li>
                            <li class="list-group-item">
                                <span>Foreigners:</span>
                                <span>19 79.2%</span>
                            </li>
                            <li class="list-group-item">
                                <span>ø-age:</span>
                                <span>27.1</span>
                            </li>
                            <li class="list-group-item">
                                <span>ø-Market value:</span>
                                <span>€16.61m</span>
                            </li>
                            <li class="list-group-item">
                                <span>Most valuable player:</span>
                                <span>Harry Kane €120.00m</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Founded:</span>
                                <span>{{ $club->founded }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Address:</span>
                                <span>{{ $club->city }}, {{ $club->address }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Stadium:</span>
                                <span>{{ $club->stadium }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Capacity:</span>
                                <span>{{ $club->capacity }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Head coach:</span>
                                <span>{{ $club->head_coach }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 club-market-column">
                        <h5 class="card-title">Total Market Value:</h5>
                        <p class="card-text">€ 8.57 bn</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <h5 class="text-center">Players – {{ $club->name }}</h5>
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Player</th>
                                <th scope="col" class="text-center">Date of birth / Age</th>
                                <th scope="col" class="text-center">Nat.</th>
                                <th scope="col" class="text-center">Height</th>
                                <th scope="col" class="text-center">Foot</th>
                                <th scope="col" class="text-center">Joined</th>
                                <th scope="col" class="text-center">Signed from</th>
                                <th scope="col" class="text-center">Contract expires</th>
                                <th scope="col" class="text-center">Market value</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <th scope="row" class="text-center">{{ $player->number }}</th>
                                    <td class="text-center">
                                        <div class="player-container">
                                            <div class="player-photo">
                                                <img src="{{ asset($player->photo) }}" class="rounded" alt="{{ $player->name }}" title="{{ $player->name }}">
                                            </div>
                                            <div class="player-info">
                                                <a href="{{ route('player.show', $player->id) }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $player->name }}</span>
                                                </a>
                                                <small>{{ $player->main_position->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $player->birth_date }} (27)</td>
                                    <td class="text-center">
                                        <a href="{{ route('league.index', $player->nation->id) }}">
                                            <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $player->height }} m</td>
                                    <td class="text-center">{{ $player->foot }}</td>
                                    <td class="text-center">{{ $player->joined }}</td>
                                    <td class="text-center">Club</td>
                                    <td class="text-center">{{ $player->contract_expires }}</td>
                                    <td class="text-center">{{ $player->market_value }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
