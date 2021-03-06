@extends('assets.layout')

@section('title', strtoupper($player->name))

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="league-header mb-2">
                        <a href="{{ route('player.index', $player->club_id) }}" class="btn btn-primary">
                            <h5 class="d-flex align-items-center justify-content-between mb-0">
                                <i class="bi bi-arrow-left-circle"></i>
                                <span class="ms-2">Return to club players list</span>
                            </h5>
                        </a>
                        <h5 class="player-title text-uppercase bg-indigo rounded mt-2 p-2">
                            <a href="{{ route('club.show', $player->club->id) }}" class="me-2">
                                <img src="{{ asset($player->club->logo) }}" class="medium-logo" alt="{{ $player->club->name }}" title="{{ $player->club->name }}">
                            </a>
                            <span class="me-2"># {{ $player->number }} –</span>
                            <span>{{ $player->name }}</span>
                        </h5>
                        <a href="{{ route('player.edit', $player) }}" class="btn btn-primary">
                            <h5 class="d-flex align-items-center justify-content-between mb-0">
                                <i class="bi bi-pencil-fill"></i>
                                <span class="ms-2">Edit player information</span>
                            </h5>
                        </a>
                    </div>
                    <div class="col-md-2 player-photo-column">
                        <div class="player-photo-item">
                            <img src="{{ asset($player->photo) }}" class="rounded" alt="{{ $player->name }}" title="{{ $player->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-calendar-date-fill"></i>
                                <b class="ms-1 me-1">Date of birth / Age:</b>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $player->birth_date }}
                                    @foreach($playerAge as $age)
                                        ({{ $age->age }})
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-flag-fill"></i>
                                <b class="ms-1 me-1">Birth country:</b>
                                <a href="{{ route('league.index', $player->birth->id) }}">
                                    <img src="{{ asset($player->birth->flag) }}" class="tiny-logo" alt="{{ $player->birth->name }}" title="{{ $player->birth->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $player->birth->name }}</span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-flag-fill"></i>
                                <b class="ms-1 me-1">Citizenship:</b>
                                <a href="{{ route('league.index', $player->nation->id) }}">
                                    <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $player->nation->name }}</span>
                                </a>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-arrow-up-circle-fill"></i>
                                <b class="ms-1 me-1">Height:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->height }} m</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-arrow-left-right"></i>
                                <b class="ms-1 me-1">Foot:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->foot }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-star-fill"></i>
                                <b class="ms-1 me-1">Role:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->position->name }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-bookmark-plus-fill"></i>
                                <b class="ms-1 me-1">Main position:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->main_position->name }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-calendar-check-fill"></i>
                                <b class="ms-1 me-1">Joined date:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->joined }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-arrow-right-square-fill"></i>
                                <b class="ms-1 me-1">Signed from:</b>
                                @if($player->signed_from_club_id)
                                    <a href="{{ route('club.show', $player->signed->id) }}">
                                        <img src="{{ asset($player->signed->logo) }}" class="tiny-logo" alt="{{ $player->signed->name }}" title="{{ $player->signed->name }}">
                                        <span class="badge bg-primary rounded-pill">{{ $player->signed->name }}</span>
                                    </a>
                                @else
                                    <span class="badge bg-primary rounded-pill">Undefined</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-calendar-x-fill"></i>
                                <b class="ms-1 me-1">Contract expires:</b>
                                <span class="badge bg-primary rounded-pill">{{ $player->contract_expires }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 player-market-column bg-indigo rounded">
                        <h5 class="card-title fw-bold">Market value:</h5>
                        <p class="card-text text-uppercase display-6">€ {{ round($player->market_value, 2) }} m</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    @if(count($transfers) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <div class="player-title">
                                    <h5 class="text-center text-uppercase text-uppercase bg-indigo rounded p-2">
                                        <span>Transfer History – {{ $player->name }}</span>
                                    </h5>
                                </div>
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">Season</th>
                                    <th scope="col" class="text-center">Date</th>
                                    <th scope="col" class="text-center">Left</th>
                                    <th scope="col" class="text-center">Joined</th>
                                    <th scope="col" class="text-center">Fee</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transfers as $transfer)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $transfer->season->year }}</span>
                                        </th>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">{{ $transfer->transfer_date }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('club.show', $transfer->left_club_id) }}">
                                                <img src="{{ asset($transfer->left_club->logo) }}" class="small-logo" alt="{{ $transfer->left_club->name }}" title="{{ $transfer->left_club->name }}">
                                                <span class="badge bg-primary rounded-pill">{{ $transfer->left_club->name }}</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('club.show', $transfer->joined_club_id) }}">
                                                <img src="{{ asset($transfer->joined_club->logo) }}" class="small-logo" alt="{{ $transfer->joined_club->name }}" title="{{ $transfer->joined_club->name }}">
                                                <span class="badge bg-primary rounded-pill">{{ $transfer->joined_club->name }}</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">€ {{ $transfer->fee }} m</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="card-text text-center text-uppercase m-5">
                            <span class="bg-indigo rounded p-2">This player has not any completed transfer</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
