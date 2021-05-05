@extends('assets.layout')

@section('title', 'Clubs list')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">
                        @if ($league)
                            <span>Clubs –</span>
                            <img src="{{ asset($league->logo) }}" class="medium-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                            <span>{{ $league->name }}</span>
                        @else
                            <span>Full clubs list</span>
                        @endif
                    </h3>
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
                                        <a href="{{ route('club.show', $club) }}" class="custom-link">
                                            <img src="{{ asset($club->logo) }}" class="small-logo" alt="{{ $club->name }}" title="{{ $club->name }}">
                                            <span class="badge bg-primary rounded-pill">{{ $club->name }}</span>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new club -->
    @include('assets.add-club')
@endsection
