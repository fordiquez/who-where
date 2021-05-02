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
                        <label class="input-group-text" for="name-input">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" id="name-input" class="form-control @error('name') is-invalid @enderror" placeholder="Enter the league name">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="league-level-input">
                            <i class="bi bi-graph-up"></i>
                            <span class="ms-1">League level</span>
                        </label>
                        <input type="text" name="league_level" id="league-level-input" class="form-control @error('league_level') is-invalid @enderror" placeholder="Enter the league level">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="country-select">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Country</span>
                        </label>
                        <select name="country_id" class="form-select" id="country-select">
                            <option selected disabled>Choose country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="logo-upload">
                            <i class="bi bi-file-earmark-image"></i>
                            <span class="ms-1">Logo image</span>
                        </label>
                        <input type="file" name="logo" id="logo-upload" class="form-control @error('logo') is-invalid @enderror">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="club-select">
                            <i class="bi bi-trophy-fill me-1"></i>
                            <span>Record-holding champion</span>
                        </label>
                        <select name="record_holding_champion_id" class="form-select" id="club-select">
                            <option selected disabled>Choose the club...</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="record-holding-times-input">
                            <i class="bi bi-arrow-counterclockwise"></i>
                            <span class="ms-1">Number of championships</span>
                        </label>
                        <input type="number" name="record_holding_times" id="record-holding-times-input" class="form-control @error('record_holding_times') is-invalid @enderror" placeholder="Enter the number">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="club-select">
                            <i class="bi bi-alarm-fill me-1"></i>
                            <span>Reigning champion</span>
                        </label>
                        <select name="reigning_champion_id" class="form-select" id="club-select">
                            <option selected disabled>Choose the club...</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="uefa-position-input">
                            <i class="bi bi-list-ol"></i>
                            <span class="ms-1">UEFA position</span>
                        </label>
                        <input type="number" name="uefa_position" id="uefa-position-input" class="form-control @error('uefa_position') is-invalid @enderror" placeholder="Enter the place number">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="uefa-coefficient-points-input">
                            <i class="bi bi-star-fill"></i>
                            <span class="ms-1">UEFA coefficient points</span>
                        </label>
                        <input type="text" name="uefa_coefficient_points" id="uefa-coefficient-points-input" class="form-control @error('uefa_coefficient_points') is-invalid @enderror" placeholder="Enter the number of points">
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
