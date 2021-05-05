<div class="modal fade" id="addLeagueModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addLeagueLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('league.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addLeagueLabel">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Adding the new league</span>
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
                        <label for="name" class="input-group-text">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter the league name">
                    </div>

                    <div class="input-group mb-3">
                        <label for="league-level" class="input-group-text">
                            <i class="bi bi-graph-up"></i>
                            <span class="ms-1">League level</span>
                        </label>
                        <input type="text" name="league_level" id="league-level" class="form-control @error('league_level') is-invalid @enderror" value="{{ old('league_level') }}" placeholder="Enter the league level">
                    </div>

                    <div class="input-group mb-3">
                        <label for="country-select" class="input-group-text">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Country</span>
                        </label>
                        <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country-select">
                            <option selected disabled>Choose country...</option>
                            @foreach($countries as $country)
                                @if($country->id == old('country_id'))
                                    <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                @else
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="logo-upload" class="input-group-text">
                            <i class="bi bi-file-earmark-image"></i>
                            <span class="ms-1">Logo image</span>
                        </label>
                        <input type="file" name="logo" id="logo-upload" class="form-control @error('logo') is-invalid @enderror">
                    </div>

                    <div class="input-group mb-3">
                        <label for="record-holding-club-select" class="input-group-text">
                            <i class="bi bi-trophy-fill"></i>
                            <span class="ms-1 me-1">Record-holding champion</span>
                            <span class="badge bg-primary rounded-pill">Not required</span>
                        </label>
                        <select class="form-select @error('record_holding_champion_id') is-invalid @enderror" name="record_holding_champion_id" id="record-holding-club-select">
                            <option selected disabled>Choose the club...</option>
                            @foreach($clubs as $club)
                                @if($club->id == old('record_holding_champion_id'))
                                    <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                @else
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="record-holding-times" class="input-group-text">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            <span class="ms-1 me-1">Number of championships</span>
                            <span class="badge bg-primary rounded-pill">Not required</span>
                        </label>
                        <input type="number" name="record_holding_times" id="record-holding-times" class="form-control @error('record_holding_times') is-invalid @enderror" value="{{ old('record_holding_times') }}" placeholder="Enter the times number">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="reigning-club-select">
                            <i class="bi bi-alarm-fill"></i>
                            <span class="ms-1 me-1">Reigning champion</span>
                            <span class="badge bg-primary rounded-pill">Not required</span>
                        </label>
                        <select class="form-select @error('reigning_champion_id') is-invalid @enderror" name="reigning_champion_id" id="reigning-club-select">
                            <option selected disabled>Choose the club...</option>
                            @foreach($clubs as $club)
                                @if($club->id == old('reigning_champion_id'))
                                    <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                @else
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-position" class="input-group-text">
                            <i class="bi bi-list-ol"></i>
                            <span class="ms-1 me-1">UEFA position</span>
                            <span class="badge bg-primary rounded-pill">Not required</span>
                        </label>
                        <input type="number" name="uefa_position" id="uefa-position" class="form-control @error('uefa_position') is-invalid @enderror" value="{{ old('uefa_position') }}" placeholder="Enter the place number">
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-coefficient-points" class="input-group-text">
                            <i class="bi bi-star-fill"></i>
                            <span class="ms-1 me-1">UEFA coefficient points</span>
                            <span class="badge bg-primary rounded-pill">Not required</span>
                        </label>
                        <input type="text" name="uefa_coefficient_points" id="uefa-coefficient-points" class="form-control @error('uefa_coefficient_points') is-invalid @enderror" value="{{ old('uefa_coefficient_points') }}" placeholder="Enter the number of points">
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
