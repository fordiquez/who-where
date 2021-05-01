<div class="modal fade" id="addCountryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCountryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('country.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addCountryLabel">
                        <i class="bi bi-flag-fill"></i>
                        Adding the new country
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
                        <label for="name-input" class="input-group-text">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Country name" id="name-input">
                    </div>

                    <div class="input-group mb-3">
                        <label for="code-input" class="input-group-text">
                            <i class="bi bi-file-binary-fill"></i>
                            <span class="ms-1">Code</span>
                        </label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Country ISO 3166-2 code (e.g. Canada – CA)" id="code-input">
                    </div>

                    <div class="input-group mb-3">
                        <label for="flag-upload" class="input-group-text">
                            <i class="bi bi-file-earmark-image"></i>
                            <span class="ms-1">Flag image</span>
                        </label>
                        <input type="file" name="flag" class="form-control @error('flag') is-invalid @enderror" id="flag-upload">
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
