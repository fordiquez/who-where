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
                        <label class="input-group-text" for="name-input">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" id="name-input" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter the club name">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="country-select">
                            <i class="bi bi-flag-fill me-1"></i>
                            <span>Country</span>
                        </label>
                        <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country-select">
                            <option selected disabled>Choose the country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="league-select">
                            <i class="bi bi-bookmark-plus-fill me-1"></i>
                            <span>League</span>
                        </label>
                        <select class="form-select @error('league_id') is-invalid @enderror" name="league_id" id="league-select">
                            <option selected disabled>Choose the league...</option>
                            @foreach($leagues as $league)
                                <option value="{{ $league->id }}">{{ $league->name }}</option>
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
                        <label class="input-group-text" for="founded-input">
                            <i class="bi bi-clock-history"></i>
                            <span class="ms-1">Founded</span>
                        </label>
                        <input type="number" name="founded" id="founded-input" class="form-control @error('founded') is-invalid @enderror" value="{{ old('founded') }}" placeholder="Enter the founded year">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="stadium-input">
                            <i class="bi bi-building"></i>
                            <span class="ms-1">Stadium</span>
                        </label>
                        <input type="text" name="stadium" id="stadium-input" class="form-control @error('stadium') is-invalid @enderror" value="{{ old('stadium') }}" placeholder="Enter the stadium name">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="address-input">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span class="ms-1">Address</span>
                        </label>
                        <input type="text" name="address" id="address-input" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Enter the stadium address">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="city-input">
                            <i class="bi bi-signpost-2-fill"></i>
                            <span class="ms-1">City</span>
                        </label>
                        <input type="text" name="city" id="city-input" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" placeholder="Enter the city name">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="capacity-input">
                            <i class="bi bi-person-lines-fill"></i>
                            <span class="ms-1">Capacity</span>
                        </label>
                        <input type="number" name="capacity" id="capacity-input" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" placeholder="Enter the capacity of stadium">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="head-coach-input">
                            <i class="bi bi-person-badge-fill"></i>
                            <span class="ms-1">Head coach</span>
                        </label>
                        <input type="text" name="head_coach" id="head-coach-input" class="form-control @error('head_coach') is-invalid @enderror" value="{{ old('head_coach') }}" placeholder="Enter the name of head coach">
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
