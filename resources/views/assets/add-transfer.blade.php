<div class="modal fade" id="addTransferModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTransferLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('transfer.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransferLabel">
                        <i class="bi bi-person-plus-fill me-1"></i>
                        <span>Creating the new transfer</span>
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
                        <label for="player-select" class="input-group-text">
                            <i class="bi bi-person-lines-fill me-1"></i>
                            <span>Player</span>
                        </label>
                        <select class="form-select @error('player_id') is-invalid @enderror" name="player_id" id="player-select">
                            <option selected disabled>Choose the player...</option>
                            @foreach($players as $player)
                                @if($player->id == old('player_id'))
                                    <option value="{{ $player->id }}" selected>{{ $player->name }}</option>
                                @else
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="season-select" class="input-group-text">
                            <i class="bi bi-calendar-month-fill me-1"></i>
                            <span>Season</span>
                        </label>
                        <select class="form-select @error('season_id') is-invalid @enderror" name="season_id" id="season-select">
                            <option selected disabled>Choose the season...</option>
                            @foreach($seasons as $season)
                                @if($season->id == old('season_id'))
                                    <option value="{{ $season->id }}" selected>{{ $season->year }}</option>
                                @else
                                    <option value="{{ $season->id }}">{{ $season->year }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="transfer-date" class="input-group-text">
                            <i class="bi bi-calendar-check-fill me-1"></i>
                            <span>Transfer Date</span>
                        </label>
                        <input type="date" name="transfer_date" id="transfer-date" class="form-control @error('transfer_date') is-invalid @enderror" value="{{ old('transfer_date') }}">
                    </div>

                    <div class="input-group mb-3">
                        <label for="transfer-window" class="input-group-text">
                            <i class="bi bi-thermometer-sun me-1"></i>
                            <span>Transfer Window</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="transfer_window" id="transfer-window-winter" class="form-check-input @error('transfer_window') is-invalid @enderror" value="Winter" {{ old('transfer_window') == 'Winter' ? 'checked' : '' }}>
                                <label for="transfer-window-winter" class="form-check-label">Winter</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="transfer_window" id="transfer-window-summer" class="form-check-input @error('transfer_window') is-invalid @enderror" value="Summer" {{ old('transfer_window') == 'Summer' ? 'checked' : '' }}>
                                <label for="transfer-window-summer" class="form-check-label">Summer</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label for="contract-expires" class="input-group-text">
                            <i class="bi bi-calendar-x-fill me-1"></i>
                            <span>Contract Expires</span>
                        </label>
                        <input type="date" name="contract_expires" id="contract-expires" class="form-control @error('contract_expires') is-invalid @enderror" value="{{ old('contract_expires') }}">
                    </div>

                    <div class="input-group mb-3">
                        <label for="joined-club-select" class="input-group-text">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            <span>Joined Club</span>
                        </label>
                        <select class="form-select @error('joined_club_id') is-invalid @enderror" name="joined_club_id" id="joined-club-select">
                            <option selected disabled>Choose joined club...</option>
                            @foreach($clubs as $club)
                                @if($club->id == old('joined_club_id'))
                                    <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                @else
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label for="fee" class="input-group-text">
                            <i class="bi bi-cash me-1"></i>
                            <span>Fee</span>
                        </label>
                        <input type="number" name="fee" id="fee" class="form-control @error('fee') is-invalid @enderror" value="{{ old('fee') }}" placeholder="Enter the transfer fee">
                    </div>

                    <div class="input-group mb-3">
                        <label for="loaned-transfer-radio" class="input-group-text">
                            <i class="bi bi-hourglass-split me-1"></i>
                            <span>Loaned transfer</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="loan" id="loaned-transfer-yes" class="form-check-input @error('loan') is-invalid @enderror" value="1" {{ old('loan') == '1' ? 'checked' : '' }}>
                                <label for="loaned-transfer-yes" class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="loan" id="loaned-transfer-no" class="form-check-input @error('loan') is-invalid @enderror" value="0" {{ old('loan') == '0' ? 'checked' : '' }}>
                                <label for="loaned-transfer-no" class="form-check-label">No</label>
                            </div>
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
