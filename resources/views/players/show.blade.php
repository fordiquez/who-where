@extends('assets.layout')

@section('title', $player->name)

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="player-title">
                        <h5 class="mt-2">
                            <a href="{{ route('club.show', $player->club->id) }}">
                                <img src="{{ asset($player->club->logo) }}" class="medium-logo" alt="{{ $player->club->name }}" title="{{ $player->club->name }}">
                            </a>
                            <span># {{ $player->number }}</span>
                            <span>{{ $player->name }}</span>
                        </h5>
                    </div>
                    <div class="col-md-2 player-photo-column">
                        <div class="player-photo-item">
                            <img src="{{ asset($player->photo) }}" class="rounded" alt="{{ $player->name }}" title="{{ $player->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Date of birth / Age:</span>
                                <span>{{ $player->birth_date }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Birth country:</span>
                                <a href="{{ route('league.index', $player->birth->id) }}">
                                    <img src="{{ asset($player->birth->flag) }}" class="tiny-logo" alt="{{ $player->birth->name }}" title="{{ $player->birth->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $player->birth->name }}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Citizenship:</span>
                                <a href="{{ route('league.index', $player->nation->id) }}">
                                    <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $player->nation->name }}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Height:</span>
                                <span>{{ $player->height }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Foot:</span>
                                <span>{{ $player->foot }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>Role:</span>
                                <span>{{ $player->position->name }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Main position:</span>
                                <span>{{ $player->main_position->name }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Joined:</span>
                                <span>{{ $player->joined }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Signed from:</span>
                                <a href="{{ route('club.show', $player->signed->id) }}">
                                    <img src="{{ asset($player->signed->logo) }}" class="tiny-logo" alt="{{ $player->signed->name }}" title="{{ $player->signed->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $player->signed->name }}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Contract expires:</span>
                                <span>{{ $player->contract_expires }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 player-market-column">
                        <h5 class="card-title">Market value:</h5>
                        <p class="card-text">€ {{ $player->market_value }} m</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <h5 class="text-center">Transfer History – {{ $player->name }}</h5>
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
{{--                            @foreach($players as $player)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{ $player->number }}</th>--}}
{{--                                    <td>--}}
{{--                                        <div class="player-container">--}}
{{--                                            <div class="player-photo">--}}
{{--                                                <img src="{{ asset($player->photo) }}" alt="{{ $player->name }}" title="{{ $player->name }}">--}}
{{--                                            </div>--}}
{{--                                            <div class="player-info">--}}
{{--                                                <span class="badge bg-primary rounded-pill">{{ $player->name }}</span>--}}
{{--                                                <span>{{ $player->main_position->name }}</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                    <td class="text-center">{{ $player->birth_date }} (27)</td>--}}
{{--                                    <td class="text-center">--}}
{{--                                        <img src="{{ asset($player->nation->flag) }}" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">--}}
{{--                                    </td>--}}
{{--                                    <td class="text-center">{{ $player->height }} m</td>--}}
{{--                                    <td class="text-center">{{ $player->foot }}</td>--}}
{{--                                    <td class="text-center">{{ $player->joined }}</td>--}}
{{--                                    <td class="text-center">Club</td>--}}
{{--                                    <td class="text-center">{{ $player->contract_expires }}</td>--}}
{{--                                    <td class="text-center">{{ $player->market_value }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
