@extends('assets.layout')

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
                                    <img src="{{ asset($club->logo) }}" width="50" height="50" alt="{{ $club->name }}" title="{{ $club->name }}">
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
                                    <td>
                                        <div class="player-container">
                                            <div class="player-photo">
                                                <img src="{{ asset($player->photo) }}" alt="{{ $player->name }}" title="{{ $player->name }}">
                                            </div>
                                            <div class="player-info">
                                                <a href="{{ route('player.show', $player) }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $player->name }}</span>
                                                </a>
                                                <span>{{ $player->main_position->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('club.show', $player->club->id) }}">
                                            <img src="{{ asset($player->club->logo) }}" width="50" height="50" alt="{{ $player->club->name }}" title="{{ $player->club->name }}">
                                            <span class="badge bg-primary rounded-pill">{{ $player->club->name }}</span>
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $player->birth_date }} (27)</td>
                                    <td class="text-center">
                                        <img src="{{ asset($player->nation->flag) }}" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                    </td>
                                    <td class="text-center">{{ $player->height }} m</td>
                                    <td class="text-center">{{ $player->foot }}</td>
                                    <td class="text-center">{{ $player->joined }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('club.show', $player->signed->id) }}" class="custom-link">
                                            <img src="{{ asset($player->signed->logo) }}" width="50" height="50" alt="{{ $player->signed->name }}" title="{{ $player->signed->name }}">
                                        </a>
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

    @include('assets.add-player')
@endsection
