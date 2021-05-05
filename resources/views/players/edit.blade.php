@extends('assets.layout')

@section('title', $player->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('player.update', $player) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Editing {{ $player->name }}</h3>
                        </div>
                        <div class="card-photo">
                            <img src="{{ asset($player->photo) }}" alt="{{ $player->name }}" title="{{ $player->name }}">
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
                                <label for="name" class="form-label">
                                    <i class="bi bi-type"></i>
                                    <span>Name</span>
                                </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $player->name }}" placeholder="Enter the player name">
                            </div>

                            <div class="mb-3">
                                <label for="photo-file" class="form-label">
                                    <i class="bi bi-file-earmark-person"></i>
                                    <span>Photo Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="photo" id="photo-file" class="form-control @error('photo') is-invalid @enderror">
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">
                                    <i class="bi bi-sort-numeric-up-alt"></i>
                                    <span>Number</span>
                                </label>
                                <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') ? old('number') : $player->number }}" placeholder="Enter the player number">
                            </div>

                            <div class="mb-3">
                                <label for="birth-date" class="form-label">
                                    <i class="bi bi-calendar-date me-1"></i>
                                    <span>Birth Date</span>
                                </label>
                                <input type="date" name="birth_date" id="birth-date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') ? old('birth_date') : $player->birth_date }}">
                            </div>

                            <div class="mb-3">
                                <label for="birth-country-select" class="form-label">
                                    <i class="bi bi-flag me-1"></i>
                                    <span class="ms-1">Birth Country</span>
                                </label>
                                <select name="birth_country_id" id="birth-country-select" class="form-select @error('birth_country_id') is-invalid @enderror">
                                    <option selected disabled>Choose the country...</option>
                                    @foreach($countries as $country)
                                        @if($player->birth_country_id == $country->id)
                                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="height" class="form-label">
                                    <i class="bi bi-arrow-up-circle"></i>
                                    <span>Height</span>
                                    <span class="badge bg-primary rounded-pill">In meters</span>
                                </label>
                                <input type="text" name="height" id="height" class="form-control @error('height') is-invalid @enderror" value="{{ old('height') ? old('height') : $player->height }}" placeholder="Enter the player height">
                            </div>

                            <div class="mb-3">
                                <label for="citizenship-country-select" class="form-label">
                                    <i class="bi bi-flag me-1"></i>
                                    <span class="ms-1">Citizenship</span>
                                </label>
                                <select name="citizenship_country_id" id="citizenship-country-select" class="form-select @error('citizenship_country_id') is-invalid @enderror">
                                    <option selected disabled>Choose the country...</option>
                                    @foreach($countries as $country)
                                        @if($player->citizenship_country_id == $country->id)
                                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="position-select" class="form-label">
                                    <i class="bi bi-star me-1"></i>
                                    <span class="ms-1">Position</span>
                                </label>
                                <select name="position_id" id="position-select" class="form-select @error('position_id') is-invalid @enderror">
                                    <option selected disabled>Choose the position...</option>
                                    @foreach($positions as $position)
                                        @if($position->is_role == 1)
                                            @if($player->position_id == $position->id)
                                                <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                            @else
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="main-position-select" class="form-label">
                                    <i class="bi bi-bookmark-plus me-1"></i>
                                    <span class="ms-1">Main Position</span>
                                </label>
                                <select name="main_position_id" id="main-position-select" class="form-select @error('main_position_id') is-invalid @enderror">
                                    <option selected disabled>Choose the main position...</option>
                                    @foreach($positions as $position)
                                        @if($position->is_main == 1)
                                            @if($player->main_position_id == $position->id)
                                                <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                            @else
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="foot" class="form-label">
                                    <i class="bi bi-arrow-left-right me-1"></i>
                                    <span>Foot</span>
                                </label>
                                <div class="radio-switches">
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="foot" id="foot-left" class="form-check-input @error('foot') is-invalid @enderror" value="Left" @if ($player->foot == 'Left') checked @endif>
                                        <label class="form-check-label" for="foot-left">Left</label>
                                    </div>
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="foot" id="foot-right" class="form-check-input @error('foot') is-invalid @enderror" value="Right" @if ($player->foot == 'Right') checked @endif>
                                        <label class="form-check-label" for="foot-right">Right</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="club-select" class="form-label">
                                    <i class="bi bi-shop me-1"></i>
                                    <span class="ms-1">Current Club</span>
                                </label>
                                <select name="club_id" id="club-select" class="form-select @error('club_id') is-invalid @enderror">
                                    <option selected disabled>Choose the current club...</option>
                                    @foreach($clubs as $club)
                                        @if($player->club_id == $club->id)
                                            <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                        @else
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="signed-from-club-select" class="form-label">
                                    <i class="bi bi-arrow-right-square me-1"></i>
                                    <span class="ms-1">Signed from</span>
                                </label>
                                <select name="signed_from_club_id" id="signed-from-club-select" class="form-select @error('signed_from_club_id') is-invalid @enderror">
                                    <option selected disabled>Choose the signed from club...</option>
                                    @foreach($clubs as $club)
                                        @if($player->signed_from_club_id == $club->id)
                                            <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                        @else
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="joined" class="form-label">
                                    <i class="bi bi-calendar-check me-1"></i>
                                    <span>Joined</span>
                                </label>
                                <input type="date" name="joined" id="joined" class="form-control @error('joined') is-invalid @enderror" value="{{ old('joined') ? old('joined') : $player->joined }}">
                            </div>

                            <div class="mb-3">
                                <label for="contract-expires" class="form-label">
                                    <i class="bi bi-calendar-x me-1"></i>
                                    <span>Contract expires</span>
                                </label>
                                <input type="date" name="contract_expires" id="contract-expires" class="form-control @error('contract_expires') is-invalid @enderror" value="{{ old('contract_expires') ? old('contract_expires') : $player->contract_expires }}">
                            </div>

                            <div class="mb-3">
                                <label for="market-value" class="form-label">
                                    <i class="bi bi-clock-history"></i>
                                    <span class="ms-1">Market value</span>
                                    <span class="badge bg-primary rounded-pill">millions €</span>
                                </label>
                                <input type="text" name="market_value" id="market-value" class="form-control @error('market_value') is-invalid @enderror" value="{{ old('market_value') ? old('market_value') : $player->market_value }}" placeholder="Enter the player market value">
                            </div>

                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('player.show', $player) }}">
                                <div>
                                    <i class="bi bi-arrow-left-circle"></i>
                                    <span>Return back</span>
                                </div>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2-circle"></i>
                                <span>Update player</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
