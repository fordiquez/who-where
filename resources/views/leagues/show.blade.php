@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="league-title">
                        <h5 class="mt-2">
                            <span>{{ $league->name }}</span>
                            <a href="{{ route('league.index', $league->country->id) }}">
                                <img src="{{ asset($league->country->flag) }}" class="league-logo" alt="{{ $league->country->name }}" title="{{ $league->country->name }}">
                            </a>
                        </h5>
                    </div>
                    <div class="col-md-2 league-logo-column">
                        <div class="league-logo-item">
                            <img src="{{ asset($league->logo) }}" alt="{{ $league->name }}" title="{{ $league->name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>League level:</span>
                                <span>{{ $league->league_level }} – </span>
                                <img src="{{ asset($league->country->flag) }}" class="country-flag-small" alt="{{ $league->country->name }}" title="{{ $league->country->name }}">
                                <span>{{ $league->country->name }}</span>
                            </li>
                            <li class="list-group-item">
                                <span>Number of teams:</span>
                                <span>20</span>
                            </li>
                            <li class="list-group-item">
                                <span>Players:</span>
                                <span>516</span>
                            </li>
                            <li class="list-group-item">
                                <span>Foreigners:</span>
                                <span>326 Players  63.2%</span>
                            </li>
                            <li class="list-group-item">
                                <span>ø-Market value:</span>
                                <span>€16.61m</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span>UEFA coefficient:</span>
                                <span>1. Pos. 98.283 Points</span>
                            </li>
                            <li class="list-group-item">
                                <span>Record-holding champions:</span>
                                <span>Manchester United 20 time(s)</span>
                            </li>
                            <li class="list-group-item">
                                <span>ø-Age:</span>
                                <span>27.3</span>
                            </li>
                            <li class="list-group-item">
                                <span>Reigning champion:</span>
                                <span>Liverpool FC</span>
                            </li>
                            <li class="list-group-item">
                                <span>Most valuable player:</span>
                                <span>Harry Kane €120.00m</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2" style="display: flex; flex-direction: column; justify-content: center; text-align: center">
                        <h5 class="card-title">Total Market Value:</h5>
                        <p class="card-text">€ 8.57 bn</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-dark table-hover">
                        <h5 class="text-center">Clubs – {{ $league->name }}</h5>
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
                                    <img src="{{ asset($club->logo) }}" class="club-logo" alt="{{ $club->name }}" title="{{ $club->name }}">
                                    <span class="badge bg-primary rounded-pill">{{ $club->name }}</span>
                                </th>
                                <td class="text-center">
                                    24
                                </td>
                                <td class="text-center">27.1</td>
                                <td class="text-center">19</td>
                                <td class="text-center">€ 1.03bn</td>
                                <td class="text-center">€ 42.79m</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
