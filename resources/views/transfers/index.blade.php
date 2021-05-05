@extends('assets.layout')

@section('title', 'Transfers list')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-3">
                <h5 class="card-title text-center">Transfers filters</h5>
            </div>
            <form method="get" action="{{ route('transfer.index') }}" class="row g-3 col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="col-md-6">
                    <label class="form-label" for="season">
                        <i class="bi bi-calendar-month"></i>
                        <span>Season:</span>
                    </label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="season_id" id="season">
                        <option selected disabled>Choose the season...</option>
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}">{{ $season->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="window-select">
                        <i class="bi bi-thermometer-sun"></i>
                        <span>Transfer window:</span>
                    </label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="transfer_window" id="window-select">
                        <option selected disabled>Choose the transfer window...</option>
                        <option value="Winter">Winter</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="loan-select">
                        <i class="bi bi-hourglass-split"></i>
                        <span>Loans:</span>
                    </label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="loan" id="loan-select">
                        <option value="0" selected>All transfers</option>
                        <option value="1">Only include loans</option>
                    </select>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary full-width">
                        <i class="bi bi-list-nested"></i>
                        <span>Display selection</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title text-center">Transfers list</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Player</th>
                        <th scope="col" class="text-center">Age</th>
                        <th scope="col" class="text-center">Nat.</th>
                        <th scope="col" class="text-center">Left</th>
                        <th scope="col" class="text-center">Joined</th>
                        <th scope="col" class="text-center">Market value</th>
                        <th scope="col" class="text-center">Fee</th>
                        <th scope="col" class="text-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransferModal">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; ?>
                    @foreach($transfers as $transfer)
                        <?php $index++; ?>
                        <tr>
                            <th scope="row" class="text-center">{{ $index }}</th>
                            <td class="text-center">
                                <div class="player-container">
                                    <div class="player-photo">
                                        <img src="{{ asset($transfer->player->photo) }}" class="rounded" alt="{{ $transfer->player->name }}" title="{{ $transfer->player->name }}">
                                    </div>
                                    <div class="player-info">
                                        <a>
                                            <span class="badge bg-primary rounded-pill">{{ $transfer->player->name }}</span>
                                        </a>
                                        <small>{{ $transfer->player->main_position->name }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @foreach($playersAge as $playerAge)
                                    @if ($transfer->player_id == $playerAge->id)
                                        <span>{{ $playerAge->age }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <th class="text-center">
                                <img src="{{ asset($transfer->player->nation->flag) }}" class="tiny-logo" alt="{{ $transfer->player->nation->name }}" title="{{ $transfer->player->nation->name }}">
                            </th>
                            <td class="text-center">
                                <div class="club-container m-2">
                                    <img src="{{ asset($transfer->left_club->logo) }}" class="small-logo" alt="{{ $transfer->left_club->name }}" title="{{ $transfer->left_club->name }}">
                                    <a href="{{ route('club.show', $transfer->left_club->id) }}" class="m-auto">
                                        <span class="badge bg-primary rounded-pill">{{ $transfer->left_club->name }}</span>
                                    </a>
                                </div>
                                <div class="club-container m-2">
                                    <img src="{{ asset($transfer->left_club->league->logo) }}" class="small-logo" alt="{{ $transfer->left_club->league->name }}" title="{{ $transfer->left_club->league->name }}">
                                    <a href="{{ route('league.show', $transfer->left_club->league->id) }}" class="m-auto">
                                        <span class="badge bg-primary rounded-pill">{{ $transfer->left_club->league->name }}</span>
                                    </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="club-container m-2">
                                    <img src="{{ asset($transfer->joined_club->logo) }}" class="small-logo" alt="{{ $transfer->joined_club->name }}" title="{{ $transfer->joined_club->name }}">
                                    <a href="{{ route('club.show', $transfer->joined_club->id) }}" class="m-auto">
                                        <span class="badge bg-primary rounded-pill">{{ $transfer->joined_club->name }}</span>
                                    </a>
                                </div>
                                <div class="club-container m-2">
                                    <img src="{{ asset($transfer->joined_club->league->logo) }}" class="small-logo" alt="{{ $transfer->joined_club->league->name }}" title="{{ $transfer->joined_club->league->name }}">
                                    <a href="{{ route('league.show', $transfer->joined_club->league->id) }}" class="m-auto">
                                        <span class="badge bg-primary rounded-pill">{{ $transfer->joined_club->league->name }}</span>
                                    </a>
                                </div>
                            </td>
                            <td class="text-center">
                                <small>€ {{ $transfer->player->market_value }} m</small>
                            </td>
                            <td class="text-center">
                                @if ($transfer->fee == 0)
                                    <span>Free</span>
                                @else
                                    <small>€ {{ $transfer->fee }} m</small>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('transfer.show', $transfer) }}" class="btn btn-secondary me-1">
                                    <i class="bi bi-cursor-fill"></i>
                                </a>
                                <a href="{{ route('transfer.edit', $transfer) }}" class="btn btn-primary me-1">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="{{ route('transfer.delete', $transfer) }}" class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for adding the new transfer -->
    @include('assets.add-transfer')
@endsection
