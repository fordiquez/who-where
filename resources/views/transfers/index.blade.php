@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-3">
                <h5 class="card-title text-center">Transfers filters</h5>
            </div>
            <form method="get" action="{{ route('transfer.index') }}" class="row g-3 col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="col-md-6">
                    <i class="bi bi-calendar-month"></i>
                    <label for="season-select" class="form-label">Season:</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="season_id" id="season-select">
                        <option selected disabled>Chose the season...</option>
                        @foreach($seasons as $season)
                            <option value="{{ $season->id }}">{{ $season->year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <i class="bi bi-thermometer-sun"></i>
                    <label for="season-select" class="form-label">Transfer window:</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="transfer_window" id="transfer-windows">
                        <option selected disabled>Chose the window...</option>
                        <option value="Winter">Winter</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <i class="bi bi-hourglass-split"></i>
                    <label for="transfer-windows" class="form-label">Loans:</label>
                </div>
                <div class="col-md-6">
                    <select class="form-select" name="loan" id="loan">
                        <option value="0" selected>All transfers</option>
                        <option value="1">Only include loans</option>
                    </select>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary full-width">
                        <i class="bi bi-list-nested"></i>
                        Display selection</button>
                </div>
            </form>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title text-center">Transfers list</h5>
            </div>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Player</th>
                    <th scope="col" class="text-center">Age</th>
                    <th scope="col" class="text-center">Nat.</th>
                    <th scope="col">Left</th>
                    <th scope="col">Joined</th>
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
                        <td>
                            <table>
                                <tbody>
                                <tr>
                                    <td rowspan="2" class="photo-container">
                                        <img src="{{ asset($transfer->player->photo) }}" class="photo-player" alt="{{ $transfer->player->name }}" title="{{ $transfer->player->name }}">
                                    </td>
                                    <td>{{ $transfer->player->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $transfer->player->main_position->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="text-center">
                            @foreach($playersAge as $playerAge)
                                @if ($transfer->player_id == $playerAge->id)
                                    {{ $playerAge->age }}
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            <img src="{{ asset($transfer->player->nation->flag) }}" class="player-nation-flag" alt="{{ $transfer->player->nation->name }}" title="{{ $transfer->player->nation->name }}">
                        </td>
                        <td>
                            <table class="inline-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ asset($transfer->left_club->logo) }}" alt="{{ $transfer->left_club->name }}" title="{{ $transfer->left_club->name }}">
                                        <a>{{ $transfer->left_club->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset($transfer->left_club->country->flag) }}" alt="{{ $transfer->left_club->country->name }}" title="{{ $transfer->left_club->country->name }}">
                                        <a>{{ $transfer->left_club->league->name }}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table class="inline-table">
                                <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ asset($transfer->joined_club->logo) }}" alt="{{ $transfer->joined_club->name }}" title="{{ $transfer->joined_club->name }}">
                                        <a>{{ $transfer->joined_club->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset($transfer->joined_club->country->flag) }}" alt="{{ $transfer->joined_club->country->name }}" title="{{ $transfer->joined_club->country->name }}">
                                        <a>{{ $transfer->joined_club->league->name }}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="text-center">€ {{ $transfer->player->market_value }}m</td>
                        <td class="text-center">
                            @if ($transfer->fee == 0)
                                Free
                            @else
                                € {{ $transfer->fee }}m
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

    <!-- Modal for adding the new transfer -->
    @include('assets.add-transfer')
@endsection
