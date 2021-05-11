<div class="modal fade" id="addCountryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCountryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('country.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryLabel">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Adding the new country</span>
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
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter the country name">
                    </div>

                    <div class="input-group mb-3">
                        <label for="code" class="input-group-text">
                            <i class="bi bi-file-binary-fill"></i>
                            <span class="ms-1 me-1">Code</span>
                            <span class="badge bg-primary rounded-pill">ISO 3166-2 *</span>
                        </label>
                        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Enter the code (e.g. Canada – CA)">
                    </div>

                    <div class="input-group mb-3">
                        <label for="flag-upload" class="input-group-text">
                            <i class="bi bi-flag-fill"></i>
                            <span class="ms-1 me-1">Flag image</span>
                            <span class="badge bg-primary rounded-pill">**</span>
                        </label>
                        <input type="file" name="flag" id="flag-upload" class="form-control @error('flag') is-invalid @enderror">
                    </div>

                    <div class="input-group mb-3">
                        <label for="is-european-country" class="input-group-text">
                            <i class="bi bi-info-circle-fill"></i>
                            <span class="ms-1">European country</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="is_european_country" id="european-country-true" class="form-check-input @error('is_european_country') is-invalid @enderror" value="1" {{ old('is_european_country') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="european-country-true">Yes</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="is_european_country" id="european-country-false" class="form-check-input @error('is_european_country') is-invalid @enderror" value="0" {{ old('is_european_country') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="european-country-false">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-position" class="input-group-text">
                            <i class="bi bi-list-ol"></i>
                            <span class="ms-1 me-1">UEFA position</span>
                            <span class="badge bg-primary rounded-pill">***</span>
                        </label>
                        <input type="number" name="uefa_position" id="uefa-position" class="form-control @error('uefa_position') is-invalid @enderror" value="{{ old('uefa_position') }}" placeholder="Enter the position number">
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-coefficient-points" class="input-group-text">
                            <i class="bi bi-star-fill"></i>
                            <span class="ms-1 me-1">UEFA coefficient points</span>
                            <span class="badge bg-primary rounded-pill">***</span>
                        </label>
                        <input type="text" name="uefa_coefficient_points" id="uefa-coefficient-points" class="form-control @error('uefa_coefficient_points') is-invalid @enderror" value="{{ old('uefa_coefficient_points') }}" placeholder="Enter the points number">
                    </div>
                    <div class="alert" role="alert">
                        <div class="list-group">
                            <a href="https://en.wikipedia.org/wiki/ISO_3166-2" target="_blank" class="list-group-item list-group-item-action">
                                <span class="badge bg-primary rounded-pill">*</span>
                                <span class="ms-2 fw-bold">Click for full list of ISO 3166-2 country codes</span>
                            </a>
                            <a class="list-group-item list-group-item-action disabled">
                                <span class="badge bg-primary rounded-pill">**</span>
                                <span class="ms-2 fw-bold">The full list of .svg flag images located in: public/assets/images/countries</span>
                            </a>
                            <a href="https://ru.uefa.com/memberassociations/uefarankings/country/#/yr/2021" target="_blank" class="list-group-item list-group-item-action">
                                <span class="badge bg-primary rounded-pill">***</span>
                                <span class="ms-2 fw-bold">Required only for European countries</span>
                                <div>
                                    <span class="fw-bold">Click for full list of UEFA association club rankings</span>
                                </div>
                            </a>
                        </div>
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
