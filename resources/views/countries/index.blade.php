@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Countries list</h3>
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
                                    <td class="text-center">{{ $index }}</td>
                                    <td>
                                        <a href="{{ route('league.index', $country) }}">
                                            <img src="{{ $country->flag }}" class="country-flag" alt="{{ $country->name }}" title="{{ $country->name }}">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $country->name }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="text-center">3</td>
                                    <td>
                                        @if($country->league)
                                            <a href="{{ route('league.show', $country->league) }}">
                                                <img src="{{ $country->league->logo }}" class="league-logo" alt="{{ $country->league->name }}" title="{{ $country->league->name }}">
                                                <span class="badge bg-primary rounded-pill">
                                                {{ $country->league->name }}
                                                </span>
                                            </a>
                                        @else
                                            <span class="badge bg-primary rounded-pill">
                                                Undefined
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">333</td>
                                    <td class="text-center">
                                        <a href="{{ route('country.show', $country) }}" class="btn btn-primary me-1">
                                            <i class="bi bi-cursor"></i>
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

    @include('assets.add-country')
@endsection
