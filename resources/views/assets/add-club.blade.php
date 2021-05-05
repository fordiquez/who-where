<div class="modal fade" id="addClubModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addClubLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('club.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClubLabel">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Adding the new club</span>
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
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter the club name">
                    </div>

                    <div class="input-group mb-3">
                        <label for="country-select" class="input-group-text">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Country</span>
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
                        <label for="league-select" class="input-group-text">
                            <i class="bi bi-bookmark-plus-fill me-1"></i>
                            <span>League</span>
                        </label>
                        <select class="form-select @error('league_id') is-invalid @enderror" name="league_id" id="league-select">
                            <option selected disabled>Choose the league...</option>
                            @foreach($leagues as $league)
                                @if($league->id == old('league_id'))
                                    <option value="{{ $league->id }}" selected>{{ $league->name }}</option>
                                @else
                                    <option value="{{ $league->id }}">{{ $league->name }}</option>
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
                        <label for="founded" class="input-group-text">
                            <i class="bi bi-clock-history"></i>
                            <span class="ms-1">Founded</span>
                        </label>
                        <input type="number" name="founded" id="founded" class="form-control @error('founded') is-invalid @enderror" value="{{ old('founded') }}" placeholder="Enter the founded year">
                    </div>

                    <div class="input-group mb-3">
                        <label for="stadium" class="input-group-text">
                            <i class="bi bi-building"></i>
                            <span class="ms-1">Stadium</span>
                        </label>
                        <input type="text" name="stadium" id="stadium" class="form-control @error('stadium') is-invalid @enderror" value="{{ old('stadium') }}" placeholder="Enter the stadium name">
                    </div>

                    <div class="input-group mb-3">
                        <label for="address" class="input-group-text">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="ms-1">Address</span>
                        </label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Enter the stadium address">
                    </div>

                    <div class="input-group mb-3">
                        <label for="city" class="input-group-text">
                            <i class="bi bi-signpost-2-fill"></i>
                            <span class="ms-1">City</span>
                        </label>
                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="Enter the city name">
                    </div>

                    <div class="input-group mb-3">
                        <label for="capacity" class="input-group-text">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="ms-1">Capacity</span>
                        </label>
                        <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" placeholder="Enter the capacity of stadium">
                    </div>

                    <div class="input-group mb-3">
                        <label for="head-coach" class="input-group-text">
                            <i class="bi bi-person-badge-fill"></i>
                            <span class="ms-1">Head coach</span>
                        </label>
                        <input type="text" name="head_coach" id="head-coach" class="form-control @error('head_coach') is-invalid @enderror" value="{{ old('head_coach') }}" placeholder="Enter the name of head coach">
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
