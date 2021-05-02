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
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="player-select">
                            <i class="bi bi-person-lines-fill me-1"></i>
                            <span>Player</span>
                        </label>
                        <select name="player_id" class="form-select" id="player-select">
                            <option selected disabled>Choose player...</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="season-select">
                            <i class="bi bi-calendar-month me-1"></i>
                            <span>Season</span>
                        </label>
                        <select name="season_id" class="form-select" id="season-select">
                            <option selected disabled>Choose season...</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}">{{ $season->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="transfer-date-input">
                            <i class="bi bi-calendar-check me-1"></i>
                            <span>Transfer Date</span>
                        </label>
                        <input type="date" name="transfer_date" id="transfer-date-input" class="form-control">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="transfer-window-radio">
                            <i class="bi bi-thermometer-sun me-1"></i>
                            <span>Transfer Window</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="transfer_window" id="transfer-window-winter" class="form-check-input" value="Winter">
                                <label class="form-check-label" for="transfer-window-winter">Winter</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="transfer_window" id="transfer-window-summer" class="form-check-input" value="Summer">
                                <label class="form-check-label" for="transfer-window-summer">Summer</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="contract-expires-input">
                            <i class="bi bi-calendar-x me-1"></i>
                            <span>Contract Expires</span>
                        </label>
                        <input type="date" name="contract_expires" id="contract-expires-input" class="form-control">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="joined-club-select">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            <span>Joined Club</span>
                        </label>
                        <select class="form-select" name="joined_club_id" id="joined-club-select">
                            <option selected disabled>Choose joined club...</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="fee-input">
                            <i class="bi bi-wallet2 me-1"></i>
                            <span>Fee</span>
                        </label>
                        <input type="number" name="fee" id="fee-input" class="form-control" placeholder="Enter the transfer fee">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="loaned-transfer-radio">
                            <i class="bi bi-hourglass-split me-1"></i>
                            <span>Loaned transfer</span>
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="loan" id="loaned-transfer-yes" class="form-check-input" value="1">
                                <label class="form-check-label" for="loaned-transfer-yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input type="radio" name="loan" id="loaned-transfer-no" class="form-check-input" value="0">
                                <label class="form-check-label" for="loaned-transfer-no">No</label>
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
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Add</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
