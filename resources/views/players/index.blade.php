@extends('assets.layout')

@section('title', strtoupper('Players list'))

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="player-title">
                        <h4 class="card-title player-title text-center text-uppercase bg-indigo rounded p-1">
                            @isset($club)
                                <span class="me-2">Players – </span>
                                <img src="{{ asset($club->logo) }}" class="medium-logo me-2" alt="{{ $club->name }}" title="{{ $club->name }}">
                                <span>{{ $club->name }}</span>
                            @else
                                <span>Players list</span>
                            @endif
                        </h4>
                    </div>
                    @if(count($players) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
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
                                        <th scope="row">
                                            <span>{{ $player->number }}</span>
                                        </th>
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
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $player->birth_date }}
                                                @foreach($playersAge as $playerAge)
                                                    @if($playerAge->id == $player->id)
                                                        ({{ $playerAge->age }})
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $player->height }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $player->foot }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $player->joined }}</span>
                                        </td>
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
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $player->contract_expires }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">€ {{ $player->market_value }} m</span>
                                        </td>
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
                    @else
                        <h5 class="card-text text-center text-uppercase m-5">
                            <span class="p-1 bg-indigo rounded">This club has not any player</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new player -->
    @include('assets.add-player')
@endsection
