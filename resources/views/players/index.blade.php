@extends('assets.layout')

@section('title', 'Players list')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <h3 class="text-center">
                                @if($club)
                                    <span>Players – </span>
                                    <img src="{{ asset($club->logo) }}" class="medium-logo" alt="{{ $club->name }}" title="{{ $club->name }}">
                                    <span>{{ $club->name }}</span>
                                @else
                                    <span>Full list players</span>
                                @endif
                            </h3>
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Player</th>
                                <th scope="col" class="text-center">Club</th>
                                <th scope="col" class="text-center">Date of birth / Age</th>
                                <th scope="col" class="text-center">Nat.</th>
                                <th scope="col" class="text-center">Height</th>
                                <th scope="col" class="text-center">Foot</th>
                                <th scope="col" class="text-center">Joined</th>
                                <th scope="col" class="text-center">Signed from</th>
                                <th scope="col" class="text-center">Contract expires</th>
                                <th scope="col" class="text-center">Market value</th>
                                <th scope="col" class="text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPlayerModal">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <th scope="row">{{ $player->number }}</th>
                                    <td class="text-center">
                                        <div class="player-container">
                                            <div class="player-photo">
                                                <img src="{{ asset($player->photo) }}" class="rounded" alt="{{ $player->name }}" title="{{ $player->name }}">
                                            </div>
                                            <div class="player-info">
                                                <a href="{{ route('player.show', $player) }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $player->name }}</span>
                                                </a>
                                                <small>{{ $player->main_position->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="club-container">
                                            <div class="club-logo">
                                                <a href="{{ route('club.show', $player->club->id) }}">
                                                    <img src="{{ asset($player->club->logo) }}" class="medium-logo" alt="{{ $player->club->name }}" title="{{ $player->club->name }}">
                                                </a>
                                            </div>
                                            <div class="club-name">
                                                <a href="{{ route('club.show', $player->club->id) }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $player->club->name }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $player->birth_date }} (27)</td>
                                    <td class="text-center">
                                        <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                    </td>
                                    <td class="text-center">{{ $player->height }} m</td>
                                    <td class="text-center">{{ $player->foot }}</td>
                                    <td class="text-center">{{ $player->joined }}</td>
                                    <td>
                                        <div class="club-container">
                                            <div class="club-logo">
                                                <a href="{{ route('club.show', $player->signed->id) }}">
                                                    <img src="{{ asset($player->signed->logo) }}" class="medium-logo" alt="{{ $player->signed->name }}" title="{{ $player->signed->name }}">
                                                </a>
                                            </div>
                                            <div class="club-name">
                                                <a href="{{ route('club.show', $player->signed->id) }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $player->signed->name }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $player->contract_expires }}</td>
                                    <td class="text-center">{{ $player->market_value }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('player.edit', $player) }}" class="btn btn-primary me-1">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new player -->
    @include('assets.add-player')
@endsection
