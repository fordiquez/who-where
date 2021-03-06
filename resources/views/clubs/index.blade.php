@extends('assets.layout')

@isset($league)
    @section('icon')
        <link rel="icon" type="image/png" href="{{ asset($league->logo) }}">
    @endsection
@endisset

@isset($league)
    @section('title', strtoupper("$league->name clubs"))
@endisset

@empty($league)
    @section('title', strtoupper('Clubs list'))
@endempty

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header club-title">
                    <h4 class="card-title club-title text-center text-uppercase bg-indigo rounded p-2">
                        @isset($league)
                            <a href="{{ route('league.show', $league) }}">
                                <img src="{{ asset($league->logo) }}" class="medium-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                            </a>
                            <span class="ms-2 me-2">{{ $league->name }}</span>
                            <span>– Clubs</span>
                        @else
                            <span>Clubs list</span>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    @if(count($clubs) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Club</th>
                                    <th scope="col" class="text-center">Squad</th>
                                    <th scope="col" class="text-center">ø age</th>
                                    <th scope="col" class="text-center">Foreigners</th>
                                    <th scope="col" class="text-center">Total market value</th>
                                    <th scope="col" class="text-center">ø market value</th>
                                    <th scope="col" class="text-center">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClubModal">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clubs as $club)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('player.index', $club) }}" class="custom-link">
                                                <img src="{{ asset($club->logo) }}" class="small-logo" alt="{{ $club->name }}" title="{{ $club->name }}">
                                                <span class="badge bg-primary rounded-pill">{{ $club->name }}</span>
                                            </a>
                                        </th>
                                        <td class="text-center">
                                            @foreach($totalPlayers as $player)
                                                @if($player->id == $club->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $player->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($avgAge as $player)
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
                                            @foreach($foreigners as $foreigner)
                                                @if($foreigner->id == $club->id)
                                                    <span class="badge bg-primary rounded-pill">{{ $foreigner->total_count }}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @foreach($totalMarketValue as $marketValue)
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
                                            @foreach($avgMarketValue as $marketValue)
                                                @if($marketValue->id == $club->id)
                                                    @if($marketValue->avg_value != null)
                                                        <span class="badge bg-primary rounded-pill">€ {{ round($marketValue->avg_value, 2) }} m</span>
                                                    @else
                                                        <span class="badge bg-primary rounded-pill">Undefined</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('club.show', $club) }}" class="btn btn-secondary me-1">
                                                <i class="bi bi-cursor-fill"></i>
                                            </a>
                                            <a href="{{ route('club.edit', $club) }}" class="btn btn-primary me-1">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h5 class="card-text empty-title text-uppercase m-sm-5">
                            <span class="bg-indigo rounded p-2">This league has not any club</span>
                            <button type="button" class="btn btn-success flex-center mt-3 p-1" data-bs-toggle="modal" data-bs-target="#addClubModal">
                                <i class="bi bi-plus-circle"></i>
                                <span class="text-uppercase h5 mb-0 ms-2">Add the new club</span>
                            </button>
                        </h5>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                        {!! $clubs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new club -->
    @include('assets.add-club')
@endsection
