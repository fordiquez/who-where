@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">Leagues list</h3>
                    <table class="table table-dark table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Competition</th>
                            <th scope="col" class="text-center">Clubs</th>
                            <th scope="col" class="text-center">Players</th>
                            <th scope="col" class="text-center">ø age</th>
                            <th scope="col" class="text-center">Foreigners</th>
                            <th scope="col" class="text-center">Total value</th>
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
                                    <a href="{{ route('league.show', $league) }}" class="custom-link">
                                        <img src="{{ asset($league->logo) }}" class="league-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                                        <span class="badge bg-primary rounded-pill">First Tier</span>
                                        <span>{{ $league->name }}</span>
                                    </a>
                                </th>
                                <td class="text-center">
                                    20
                                </td>
                                <td class="text-center">3</td>
                                <td class="text-center">25.3</td>
                                <td class="text-center">20</td>
                                <td class="text-center">333</td>
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
            </div>
        </div>
    </div>

    @include('assets.add-league')
@endsection
