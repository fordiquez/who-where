@extends('assets.layout')

@section('title', 'Countries list')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="country-title">
                            <h4 class="card-title country-title text-center text-uppercase p-1 bg-indigo rounded">Countries list</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col" class="text-center">Leagues</th>
                                    <th scope="col">First Tier League</th>
                                    <th scope="col" class="text-center">Clubs</th>
                                    <th scope="col" class="text-center">Players</th>
                                    <th scope="col" class="text-center">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCountryModal">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $index = 0; @endphp
                                @foreach($countries as $country)
                                    @php $index++ @endphp
                                    <tr>
                                        <th scope="row" class="text-center">
                                            <span>{{ $index }}</span>
                                        </th>
                                        <td>
                                            <a href="{{ route('league.index', $country) }}">
                                                <img src="{{ asset($country->flag) }}" class="small-logo" alt="{{ $country->name }}" title="{{ $country->name }}">
                                                <span class="badge bg-primary rounded-pill">
                                                {{ $country->name }}
                                            </span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalLeagues as $league)
                                                @if ($league->id == $country->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $league->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($country->league)
                                                <a href="{{ route('league.show', $country->league) }}">
                                                    <img src="{{ asset($country->league->logo) }}" class="small-logo" alt="{{ $country->league->name }}" title="{{ $country->league->name }}">
                                                    <span class="badge bg-primary rounded-pill">{{ $country->league->name }}</span>
                                                </a>
                                            @else
                                                <span class="badge bg-primary rounded-pill">Undefined</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalClubs as $club)
                                                @if ($club->id == $country->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $club->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalPlayers as $player)
                                                @if ($player->id == $country->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $player->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('country.show', $country) }}" class="btn btn-secondary me-1">
                                                <i class="bi bi-cursor-fill"></i>
                                            </a>
                                            <a href="{{ route('country.edit', $country) }}" class="btn btn-primary me-1">
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
    </div>

    <!-- Modal for adding the new country -->
    @include('assets.add-country')
@endsection
