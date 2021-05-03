@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('league.update', $league) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Editing {{ $league->name }}</h3>
                        </div>
                        <div class="card-photo">
                            <img src="{{ asset($league->logo) }}" alt="{{ $league->name }}" title="{{ $league->name }}">
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label" for="name-input">
                                    <i class="bi bi-type"></i>
                                    <span>Name</span>
                                </label>
                                <input type="text" name="name" id="name-input" class="form-control @error('name') is-invalid @enderror" value="{{ $league->name }}" placeholder="Enter the league name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="league-level-input">
                                    <i class="bi bi-graph-up"></i>
                                    <span>League level</span>
                                </label>
                                <input type="text" name="league_level" id="league-level-input" class="form-control @error('league_level') is-invalid @enderror" value="{{ $league->league_level }}" placeholder="Enter the league level">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="country-select">
                                    <i class="bi bi-flag-fill"></i>
                                    <span class="ms-1">Country</span>
                                </label>
                                <select name="country_id" id="country-select" class="form-select @error('country_id') is-invalid @enderror">
                                    <option selected disabled>Choose the country...</option>
                                    @foreach($countries as $country)
                                        @if($league->country_id == $country->id)
                                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="logo-file">
                                    <i class="bi bi-file-earmark-image"></i>
                                    <span>Logo Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="logo" id="logo-file" class="form-control @error('logo') is-invalid @enderror">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="club-select">
                                    <i class="bi bi-trophy-fill me-1"></i>
                                    <span>Record-holding champion</span>
                                </label>
                                <select name="record_holding_champion_id" class="form-select @error('record_holding_champion_id') is-invalid @enderror" id="club-select">
                                    <option selected disabled>Choose the club...</option>
                                    @foreach($clubs as $club)
                                        @if($club->id == $league->record_holding_champion_id)
                                            <option value="{{ $league->record->id }}" selected>{{ $league->record->name }}</option>
                                        @else
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="record-holding-times-input">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    <span class="ms-1">Number of championships</span>
                                </label>
                                <input type="number" name="record_holding_times" id="record-holding-times-input" class="form-control @error('record_holding_times') is-invalid @enderror" value="{{ $league->record_holding_times }}" placeholder="Enter the number">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="club-select">
                                    <i class="bi bi-alarm-fill me-1"></i>
                                    <span>Reigning champion</span>
                                </label>
                                <select name="reigning_champion_id" class="form-select @error('reigning_champion_id') is-invalid @enderror" id="club-select">
                                    <option selected disabled>Choose the club...</option>
                                    @foreach($clubs as $club)
                                        @if($club->id == $league->reigning_champion_id)
                                            <option value="{{ $league->reigning->id }}" selected>{{ $league->reigning->name }}</option>
                                        @else
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="uefa-position-input">
                                    <i class="bi bi-list-ol"></i>
                                    <span class="ms-1">UEFA position</span>
                                    <span class="badge bg-primary rounded-pill">Only European countries</span>
                                </label>
                                <input type="number" name="uefa_position" id="uefa-position-input" class="form-control @error('uefa_position') is-invalid @enderror" value="{{ $league->uefa_position }}" placeholder="Enter the place number">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="uefa-coefficient-points-input">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="ms-1">UEFA coefficient points</span>
                                    <span class="badge bg-primary rounded-pill">Only European countries</span>
                                </label>
                                <input type="text" name="uefa_coefficient_points" id="uefa-coefficient-points-input" class="form-control @error('uefa_coefficient_points') is-invalid @enderror" value="{{ $league->uefa_coefficient_points }}" placeholder="Enter the number of points">
                            </div>
                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('league.show', $league) }}">
                                <div>
                                    <i class="bi bi-arrow-left-circle"></i>
                                    <span>Return back</span>
                                </div>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2-circle"></i>
                                <span>Update league</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
