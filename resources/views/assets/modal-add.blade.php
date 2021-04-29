<div class="modal fade" id="addTransferModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addTransferLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('transfer.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransferLabel">
                        <i class="bi bi-person-plus-fill me-1"></i>
                        Creating the new transfer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="player-id-select">
                            <i class="bi bi-person-lines-fill me-1"></i>
                            Player
                        </label>
                        <select name="player_id" class="form-select" id="player-id-select">
                            <option selected disabled>Choose player...</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="season-id-select">
                            <i class="bi bi-calendar-month me-1"></i>
                            Season
                        </label>
                        <select name="season_id" class="form-select" id="season-id-select">
                            <option selected disabled>Choose season...</option>
                            @foreach($seasons as $season)
                                <option value="{{ $season->id }}">{{ $season->year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="transfer-date-input">
                            <i class="bi bi-calendar-check me-1"></i>
                            Transfer Date
                        </label>
                        <input type="date" name="transfer_date" class="form-control" id="transfer-date-input">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="transfer-window-radio">
                            <i class="bi bi-thermometer-sun me-1"></i>
                            Transfer Window
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="transfer_window" id="transfer-window-winter" value="Winter">
                                <label class="form-check-label" for="transfer-window-winter">Winter</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="transfer_window" id="transfer-window-summer" value="Summer">
                                <label class="form-check-label" for="transfer-window-summer">Summer</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="contract-expires-input">
                            <i class="bi bi-calendar-x me-1"></i>
                            Contract Expires
                        </label>
                        <input type="date" name="contract_expires" class="form-control" id="contract-expires-input">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="joined-club-select">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Joined Club
                        </label>
                        <select name="joined_club_id" class="form-select" id="joined-club-select">
                            <option selected disabled>Choose joined club...</option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="fee-input">
                            <i class="bi bi-wallet2 me-1"></i>
                            Fee
                        </label>
                        <input type="number" name="fee" class="form-control" placeholder="Transfer fee" id="fee-input">
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="loaned-transfer-radio">
                            <i class="bi bi-hourglass-split me-1"></i>
                            Loaned transfer
                        </label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="loan" id="loaned-transfer-yes" value="1">
                                <label class="form-check-label" for="loaned-transfer-yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="loan" id="loaned-transfer-no" value="0">
                                <label class="form-check-label" for="loaned-transfer-no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill"></i>
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
