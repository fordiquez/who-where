@extends('assets.layout')

@section('title', strtoupper('Leagues list'))

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="league-title">
                        <h4 class="card-title league-title text-center text-uppercase bg-indigo rounded p-1">
                            @if($country)
                                <span class="me-2">Leagues – </span>
                                <img src="{{ asset($country->flag) }}" class="medium-logo me-2" alt="{{ $country->name }}" title="{{ $country->name }}">
                                <span>{{ $country->name }}</span>
                            @else
                                <span class="bg-indigo p-1">Leagues list</span>
                            @endif
                        </h4>
                    </div>
                    @if(count($leagues) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Competition</th>
                                    <th scope="col" class="text-center">Clubs</th>
                                    <th scope="col" class="text-center">Players</th>
                                    <th scope="col" class="text-center">ø age</th>
                                    <th scope="col" class="text-center">Foreigners</th>
                                    <th scope="col" class="text-center">Total market value</th>
                                    <th scope="col" class="text-center">ø market value</th>
                                    <th scope="col" class="text-center">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLeagueModal">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($leagues as $league)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('club.index', $league) }}" class="custom-link">
                                                <img src="{{ asset($league->logo) }}" class="medium-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                                                <span class="badge bg-primary rounded-pill">{{ $league->league_level }}</span>
                                                <span>{{ $league->name }}</span>
                                            </a>
                                        </th>
                                        <td class="text-center">
                                            @foreach($totalClubs as $club)
                                                @if($club->id == $league->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $club->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalPlayers as $player)
                                                @if($player->id == $league->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $player->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($avgAge as $player)
                                                @if($player->id == $league->id)
                                                    @if($player->avg_age != null)
                                                        <span class="badge bg-primary rounded-pill">{{ $player->avg_age }}</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($foreigners as $foreigner)
                                                @if($foreigner->id == $league->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $foreigner->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalMarketValue as $marketValue)
                                                @if($marketValue->id == $league->id)
                                                    @if($marketValue->sum_value != null)
                                                        <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->sum_value, 2) }} m</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($avgMarketValue as $marketValue)
                                                @if($marketValue->id == $league->id)
                                                    @if($marketValue->avg_value != null)
                                                        <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->avg_value, 2) }} m</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('league.show', $league) }}" class="btn btn-secondary me-1">
                                                <i class="bi bi-cursor-fill"></i>
                                            </a>
                                            <a href="{{ route('league.edit', $league) }}" class="btn btn-primary me-1">
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
                            <span class="p-1 bg-indigo rounded">This country has not any league</span>
                        </h5>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new league -->
    @include('assets.add-league')
@endsection
