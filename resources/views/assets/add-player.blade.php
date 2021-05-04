<div class="modal fade" id="addPlayerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPlayerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('player.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPlayerLabel">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Adding the new player</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="name-input">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" id="name-input" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter the player name">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="photo-upload">
                            <i class="bi bi-file-earmark-person-fill"></i>
                            <span class="ms-1">Photo image</span>
                        </label>
                        <input type="file" name="photo" id="photo-upload" class="form-control @error('photo') is-invalid @enderror">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="number-input">
                            <i class="bi bi-sort-numeric-up-alt"></i>
                            <span class="ms-1">Number</span>
                        </label>
                        <input type="number" name="number" id="number-input" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" placeholder="Enter the player number">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="birth-date-input">
                            <i class="bi bi-calendar-date-fill me-1"></i>
                            <span>Birth date</span>
                        </label>
                        <input type="date" name="birth_date" id="birth-date-input" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="birth-country-select">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Birth country</span>
                        </label>
                        <select class="form-select @error('birth_country_id') is-invalid @enderror" name="birth_country_id" id="birth-country-select">
                            <option selected disabled>Choose the country...</option>
                            @foreach($countries as $country)
                                @if($country->id == old('birth_country_id'))
                                    <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                @else
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="height-input">
                            <i class="bi bi-arrow-up-circle-fill"></i>
                            <span class="ms-1">Height</span>
                        </label>
                        <input type="text" name="height" id="height-input" class="form-control @error('height') is-invalid @enderror" value="{{ old('height') }}" placeholder="Enter the player height">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="citizenship-select">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Citizenship</span>
                        </label>
                        <select class="form-select @error('citizenship_country_id') is-invalid @enderror" name="citizenship_country_id" id="citizenship-select">
                            <option selected disabled>Choose the country...</option>
                            @foreach($countries as $country)
                                @if($country->id == old('citizenship_country_id'))
                                    <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                @else
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="position-select">
                            <i class="bi bi-star-fill me-1"></i>
                            <span>Position</span>
                        </label>
                        <select class="form-select @error('position_id') is-invalid @enderror" name="position_id" id="position-select">
                            <option selected disabled>Choose the player role...</option>
                            @foreach($positions as $position)
                                @if($position->is_role == 1)
                                    @if($position->id == old('position_id'))
                                        <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                    @else
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="main-position-select">
                            <i class="bi bi-bookmark-plus-fill me-1"></i>
                            <span>Main position</span>
                        </label>
                        <select class="form-select @error('main_position_id') is-invalid @enderror" name="main_position_id" id="main-position-select">
                            <option selected disabled>Choose the main position...</option>
                            @foreach($positions as $position)
                                @if($position->is_main == 1)
                                    @if($position->id == old('main_position_id'))
                                        <option value="{{ $position->id }}" selected>{{ $position->name }}</option>
                                    @else
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="foot-radio">
                            <i class="bi bi-arrow-left-right me-1"></i>
                            <span>Foot</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="foot" id="foot-left" class="form-check-input @error('foot') is-invalid @enderror" value="Left" {{ old('foot') == 'Left' ? 'checked' : '' }}>
                                <label class="form-check-label" for="transfer-window-winter">Left</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="foot" id="foot-right" class="form-check-input @error('foot') is-invalid @enderror" value="Right" {{ old('foot') == 'Right' ? 'checked' : '' }}>
                                <label class="form-check-label" for="transfer-window-summer">Right</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="club-select">
                            <i class="bi bi-shop me-1"></i>
                            <span>Current club</span>
                        </label>
                        <select class="form-select @error('club_id') is-invalid @enderror" name="club_id" id="club-select">
                            <option selected disabled>Choose the current club...</option>
                            @foreach($clubs as $club)
                                @if($club->id == old('club_id'))
                                    <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                @else
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="signed-from-club-select">
                            <i class="bi bi-arrow-right-square-fill me-1"></i>
                            <span>Signed from</span>
                        </label>
                        <select class="form-select @error('signed_from_club_id') is-invalid @enderror" name="signed_from_club_id" id="signed-from-club-select">
                            <option selected disabled>Choose the signed from club...</option>
                            @foreach($clubs as $club)
                                @if($club->id == old('signed_from_club_id'))
                                    <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                @else
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="joined-date">
                            <i class="bi bi-calendar-check-fill me-1"></i>
                            <span>Joined</span>
                        </label>
                        <input type="date" name="joined" id="joined-date" class="form-control @error('joined') is-invalid @enderror" value="{{ old('joined') }}">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="contract-expires-date">
                            <i class="bi bi-calendar-x-fill me-1"></i>
                            <span>Contract Expires</span>
                        </label>
                        <input type="date" name="contract_expires" id="contract-expires-date" class="form-control @error('contract_expires') is-invalid @enderror" value="{{ old('contract_expires') }}">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="market-value-input">
                            <i class="bi bi-clock-history"></i>
                            <span class="ms-1">Market value</span>
                        </label>
                        <input type="text" name="market_value" id="market-value-input" class="form-control @error('market_value') is-invalid @enderror" value="{{ old('market_value') }}" placeholder="Enter the player market value">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x"></i>
                        <span>Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus"></i>
                        <span>Add</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
