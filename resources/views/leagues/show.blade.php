@extends('assets.layout')

@section('icon')
    <link rel="icon" type="image/png" href="{{ asset($league->logo) }}">
@endsection

@section('title', strtoupper($league->name))

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="league-title mb-2">
                        <h5 class="d-flex align-items-center text-uppercase mt-2 bg-indigo rounded p-2">
                            <a href="{{ route('league.index', $league->country->id) }}" class="me-2">
                                <img src="{{ asset($league->country->flag) }}" class="small-logo" alt="{{ $league->country->name }}" title="{{ $league->country->name }}">
                            </a>
                            <span>– {{ $league->name }}</span>
                        </h5>
                    </div>
                    <div class="col-md-2 league-logo-column">
                        <div class="league-logo-item">
                            <img src="{{ asset($league->logo) }}" class="full-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-graph-up"></i>
                                <b class="ms-1 me-1">League level:</b>
                                <span>
                                    <span class="badge bg-primary rounded-pill">{{ $league->league_level }}</span>
                                    <img src="{{ asset($league->country->flag) }}" class="tiny-logo" alt="{{ $league->country->name }}" title="{{ $league->country->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $league->country->name }}</span>
                                </span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-shop"></i>
                                <b class="ms-1 me-1">Number of teams:</b>
                                @foreach($totalClubs as $club)
                                    @if($club->id == $league->id)
                                        <span class="badge bg-primary rounded-pill">{{ $club->total_count }}</span>
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-people-fill"></i>
                                <b class="ms-1 me-1">Players:</b>
                                @foreach($totalPlayers as $player)
                                    @if($player->id == $league->id)
                                        <span class="badge bg-primary rounded-pill">{{ $player->total_count }}</span>
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-bar-chart-line-fill"></i>
                                <b class="ms-1 me-1">ø-Age:</b>
                                @foreach($avgAge as $age)
                                    @if($age->id == $league->id)
                                        @if($age->avg_age != null)
                                            <span class="badge bg-primary rounded-pill">{{ $age->avg_age }}</span>
                                        @else
                                            <span class="badge bg-primary rounded-pill">Undefined</span>
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill"></i>
                                <b class="ms-1 me-1">Foreigners:</b>
                                @foreach($foreigners as $foreigner)
                                    @if($foreigner->id == $league->id)
                                        <span class="badge bg-primary rounded-pill">{{ $foreigner->total_count }} players</span>
                                    @endif
                                @endforeach
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-star-fill"></i>
                                <b class="ms-1 me-1">UEFA coefficient:</b>
                                @if($league->country->uefa_position & $league->country->uefa_coefficient_points)
                                    <span class="badge bg-primary rounded-pill">{{ $league->country->uefa_position }}. Pos. {{ $league->country->uefa_coefficient_points }} Points</span>
                                @else
                                    <span class="badge bg-primary rounded-pill">Undefined</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-trophy-fill"></i>
                                <b class="ms-1 me-1">Record-holding champions:</b>
                                @if($league->record_holding_champion_id && $league->record_holding_times)
                                    <a href="{{ route('club.show', $league->record_holding_champion_id) }}" class="badge bg-primary rounded-pill custom-link">
                                        <span>{{ $league->record->name }} {{ $league->record_holding_times }} time(s)</span>
                                    </a>
                                @else
                                    <span class="badge bg-primary rounded-pill">Undefined</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-bell-fill"></i>
                                <b class="ms-1 me-1">Reigning champion:</b>
                                @if($league->reigning_champion_id)
                                    <a href="{{ route('club.show', $league->reigning_champion_id) }}" class="badge bg-primary rounded-pill custom-link">
                                        <span>{{ $league->reigning->name }}</span>
                                    </a>
                                @else
                                    <span class="badge bg-primary rounded-pill">Undefined</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="bi bi-circle-half"></i>
                                <b class="ms-1 me-1">ø-Market value:</b>
                                @foreach($avgMarketValue as $marketValue)
                                    @if($marketValue->id == $league->id)
                                        @if($marketValue->avg_value != null)
                                            <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->avg_value, 2) }} m</span>
                                        @else
                                            <span class="badge bg-primary rounded-pill">Undefined</span>
                                        @endif
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item">
                                <i class="bi bi-cash-stack"></i>
                                <b class="ms-1">Most valuable player(s):</b>
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
                                    <span class="badge bg-primary rounded-pill custom-link">Undefined</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 league-market-column bg-indigo rounded">
                        <h5 class="card-title fw-bold">Total Market Value:</h5>
                        @foreach($totalMarketValue as $marketValue)
                            @if($marketValue->id == $league->id)
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
                    @if(count($clubs) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <div class="league-title">
                                    <h5 class="text-center text-uppercase text-uppercase bg-indigo rounded p-2">
                                        <span>Clubs – {{ $league->name }}</span>
                                    </h5>
                                </div>
                                <thead>
                                <tr>
                                    <th scope="col">Club</th>
                                    <th scope="col" class="text-center">Squad</th>
                                    <th scope="col" class="text-center">ø age</th>
                                    <th scope="col" class="text-center">Foreigners</th>
                                    <th scope="col" class="text-center">Total market value</th>
                                    <th scope="col" class="text-center">ø market value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clubs as $club)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('club.show', $club) }}">
                                                <img src="{{ asset($club->logo) }}" class="medium-logo" alt="{{ $club->name }}" title="{{ $club->name }}">
                                                <span class="badge bg-primary rounded-pill">{{ $club->name }}</span>
                                            </a>
                                        </th>
                                        <td class="text-center">
                                            @foreach($totalClubsPlayers as $player)
                                                @if($player->id == $club->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $player->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalClubsAvgAge as $player)
                                                @if($player->id == $club->id)
                                                    @if($player->avg_age != null)
                                                        <span class="badge bg-primary rounded-pill">{{ $player->avg_age }}</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalClubsForeigners as $foreigner)
                                                @if($foreigner->id == $club->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $foreigner->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalClubsMarketValue as $marketValue)
                                                @if($marketValue->id == $club->id)
                                                    @if($marketValue->sum_value != null)
                                                        <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->sum_value, 2) }} m</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($avgClubsMarketValue as $marketValue)
                                                @if($marketValue->id == $club->id)
                                                    @if($marketValue->avg_value != null)
                                                        <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->avg_value, 2) }} m</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="card-text text-center text-uppercase m-5">
                            <span class="bg-indigo rounded p-2">This league has not any club</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
