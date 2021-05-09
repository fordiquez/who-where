@extends('assets.layout')

@section('icon')
    <link rel="icon" type="image/png" href="{{ asset($club->logo) }}">
@endsection

@section('title', strtoupper($club->name))

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="club-title mb-2">
                        <h5 class="d-flex align-items-center text-uppercase mt-2 bg-indigo rounded p-2">
                            <a href="{{ route('club.index', $club->league->id) }}">
                                <img src="{{ asset($club->league->logo) }}" class="medium-logo" alt="{{ $club->league->name }}" title="{{ $club->league->name }}">
                            </a>
                            <span>– {{ $club->name }}</span>
                        </h5>
                    </div>
                    <div class="col-md-2 club-logo-column">
                        <div class="club-logo-item">
                            <img src="{{ asset($club->logo) }}" alt="{{ $club->name }}" title="{{ $club->name }}">
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Squad size:</span>
                                @foreach($totalPlayers as $player)
                                    @if($player->id == $club->id)
                                        <span class="badge bg-primary rounded-pill">{{ $player->total_count }} players</span>
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Foreigners:</span>
                                @foreach($foreigners as $foreigner)
                                    @if($foreigner->id == $club->id)
                                        <span class="badge bg-primary rounded-pill">{{ $foreigner->total_count }} players</span>
                                    @endif
                                @endforeach
                            </li>
                            @foreach($youngestPlayer as $player)
                                @if($player->id)
                                    <li class="list-group-item d-flex align-items-center justify-content-sm-between">
                                        <span class="me-1 fw-bold">The youngest player:</span>
                                        <a href="{{ route('player.show', $player->id) }}" class="custom-link youngest-player">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $player->name }}
                                            </span>
                                            <span class="badge bg-primary rounded-pill mt-1">
                                                Years: {{ $player->years }} – Months: {{ $player->months }} – Days: {{ $player->days }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            @foreach($oldestPlayer as $player)
                                @if($player->id)
                                    <li class="list-group-item d-flex align-items-center justify-content-between">
                                        <span class="me-1 fw-bold">The oldest player:</span>
                                        <a href="{{ route('player.show', $player->id) }}" class="custom-link oldest-player">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $player->name }}
                                            </span>
                                            <span class="badge bg-primary rounded-pill mt-1">
                                                Years: {{ $player->years }} – Months: {{ $player->months }} – Days: {{ $player->days }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">ø-age:</span>
                                @foreach($avgAge as $age)
                                    @if($age->id == $club->id)
                                        @if($age->avg_age != null)
                                            <span class="badge bg-primary rounded-pill">{{ $age->avg_age }}</span>
                                        @else
                                            <span class="badge bg-primary rounded-pill">Undefined</span>
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">ø-Market value:</span>
                                @foreach($avgMarketValue as $marketValue)
                                    @if($marketValue->id == $club->id)
                                        @if($marketValue->avg_value != null)
                                            <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->avg_value, 2) }} m</span>
                                        @else
                                            <span class="badge bg-primary rounded-pill">Undefined</span>
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item">
                                <span class="fw-bold">Most valuable player(s):</span>
                                @if(count($mostValuablePlayer) > 0)
                                    @foreach($mostValuablePlayer as $player)
                                        @if($loop->first)
                                            @php $max = $player->market_value @endphp
                                        @endif
                                        @if($player->market_value == $max)
                                            <a href="{{ route('player.show', $player->id) }}" class="badge bg-primary rounded-pill custom-link">
                                                <span>{{ $player->name }} € {{ $player->market_value }} m</span>
                                            </a>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="badge bg-primary rounded-pill">Undefined</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Founded:</span>
                                <span class="badge bg-primary rounded-pill">{{ $club->founded }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Address:</span>
                                <span class="badge bg-primary rounded-pill">{{ $club->city }}, {{ $club->address }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Stadium:</span>
                                <span class="badge bg-primary rounded-pill">{{ $club->stadium }}</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Capacity:</span>
                                <span class="badge bg-primary rounded-pill">{{ $club->capacity }} seats</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="me-1 fw-bold">Head coach:</span>
                                <span class="badge bg-primary rounded-pill">{{ $club->head_coach }}</span>
                            </li>
                            @foreach($championships as $championship)
                                @if($championship)
                                    <li class="list-group-item d-flex align-items-center">
                                        <span class="me-1 fw-bold">Championships number:</span>
                                        <span class="badge bg-primary rounded-pill">{{ $championship->championships_number }}</span>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <span class="me-1 fw-bold">The last championship season:</span>
                                        <span class="badge bg-primary rounded-pill">{{ $championship->season->year }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-2 club-market-column bg-indigo rounded">
                        <h5 class="card-title fw-bold">Total Market Value:</h5>
                        @foreach($totalMarketValue as $marketValue)
                            @if($marketValue->id == $club->id)
                                @if($marketValue->sum_value != null)
                                    <p class="card-text text-uppercase display-6">€ {{ round($marketValue->sum_value, 2) }} m</p>
                                @else
                                    <h4 class="card-text text-uppercase">Undefined</h4>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    @if(count($players) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <div class="club-title">
                                    <h5 class="text-center text-uppercase text-uppercase bg-indigo rounded p-1">
                                        <span>Players – {{ $club->name }}</span>
                                    </h5>
                                </div>
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
                                        <th scope="row" class="text-center">
                                            <span>{{ $player->number }}</span>
                                        </th>
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
                                        <td class="text-center">
                                            <span>
                                                {{ $player->birth_date }}
                                                @foreach($playersAge as $playerAge)
                                                    @if($playerAge->id == $player->id)
                                                        ({{ $playerAge->age }})
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('league.index', $player->nation->id) }}">
                                                <img src="{{ asset($player->nation->flag) }}" class="tiny-logo" alt="{{ $player->nation->name }}" title="{{ $player->nation->name }}">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $player->height }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $player->foot }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $player->joined }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($player->signed_from_club_id)
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
                                            @else
                                                <div class="club-container">
                                                    <div class="club-logo">
                                                    </div>
                                                    <div class="club-name">
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span>{{ $player->contract_expires }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span>€ {{ $player->market_value }} m</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="card-text text-center text-uppercase m-5">
                            <span class="bg-indigo rounded p-2">This club has not any player</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
