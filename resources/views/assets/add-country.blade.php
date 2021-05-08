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
                            <span class="badge bg-primary rounded-pill">ISO 3166-2</span>
                        </label>
                        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Enter the code (e.g. Canada – CA)">
                    </div>

                    <div class="input-group mb-3">
                        <label for="flag-upload" class="input-group-text">
                            <i class="bi bi-flag-fill"></i>
                            <span class="ms-1">Flag image</span>
                        </label>
                        <input type="file" name="flag" id="flag-upload" class="form-control @error('flag') is-invalid @enderror">
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-position" class="input-group-text">
                            <i class="bi bi-list-ol"></i>
                            <span class="ms-1 me-1">UEFA position</span>
                            <span class="badge bg-primary rounded-pill">Not required *</span>
                        </label>
                        <input type="number" name="uefa_position" id="uefa-position" class="form-control @error('uefa_position') is-invalid @enderror" value="{{ old('uefa_position') }}" placeholder="Enter the place number">
                    </div>

                    <div class="input-group mb-3">
                        <label for="uefa-coefficient-points" class="input-group-text">
                            <i class="bi bi-star-fill"></i>
                            <span class="ms-1 me-1">UEFA coefficient points</span>
                            <span class="badge bg-primary rounded-pill">Not required *</span>
                        </label>
                        <input type="text" name="uefa_coefficient_points" id="uefa-coefficient-points" class="form-control @error('uefa_coefficient_points') is-invalid @enderror" value="{{ old('uefa_coefficient_points') }}" placeholder="Enter the number">
                    </div>
                    <div class="alert alert-secondary" role="alert">
                        <span class="badge bg-primary rounded-pill">*</span>
                        <span>– only for European countries</span>
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
