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
                    <div class="input-group mb-3">
                        <label for="name-input" class="input-group-text">
                            <i class="bi bi-type"></i>
                            <span class="ms-1">Name</span>
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Transfer fee" id="name-input">
                    </div>

                    <div class="input-group mb-3">
                        <label for="code-input" class="input-group-text">
                            <i class="bi bi-file-binary-fill"></i>
                            <span class="ms-1">Code</span>
                        </label>
                        <input type="text" name="code" class="form-control" placeholder="Transfer fee" id="code-input">
                    </div>

                    <div class="input-group mb-3">
                        <label for="flag-upload" class="input-group-text">
                            <i class="bi bi-file-earmark-image"></i>
                            <span class="ms-1">Flag image</span>
                        </label>
                        <input class="form-control" type="file" id="flag-upload" name="flag">
                    </div>

                    <div class="input-group mb-3">
                        <label for="first-tier-club-select" class="input-group-text">
                            <i class="bi bi-list-ol"></i>
                            <span class="ms-1">First Tier League</span>
                        </label>
                        <select name="first_tier_club_id" class="form-select" id="first-tier-club-select">
                            <option selected disabled>Choose the first tier league...</option>
                            @foreach($leagues as $league)
                                <option value="{{ $league->id }}">{{ $league->name }}</option>
                            @endforeach
                        </select>
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
