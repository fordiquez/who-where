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
                            <i class="bi bi-flag-fill"></i>
                            <span class="ms-1">Country</span>
                        </label>
                        <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country-select">
                            <option selected disabled>Choose the country...</option>
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
