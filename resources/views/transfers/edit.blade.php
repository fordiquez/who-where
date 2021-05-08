@extends('assets.layout')

@section('title', $transfer->player->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('transfer.update', $transfer) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header player-title">
                            <h5 class="card-title player-title text-center text-uppercase p-1 bg-indigo rounded">
                                <span>Editing  transfer's {{ $transfer->player->name }}</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="season-select" class="form-label">
                                    <i class="bi bi-calendar-month me-1"></i>
                                    <span>Season</span>
                                </label>
                                <select class="form-select @error('season_id') is-invalid @enderror" name="season_id" id="season-select">
                                    <option selected disabled>Choose the season...</option>
                                    @foreach($seasons as $season)
                                        @if ($season->id == $transfer->season_id)
                                            <option value="{{ $season->id }}" selected>{{ $season->year }}</option>
                                        @else
                                            <option value="{{ $season->id }}">{{ $season->year }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="transfer-date" class="form-label">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>Transfer Date</span>
                                </label>
                                <input type="date" name="transfer_date" id="transfer-date" class="form-control" value="{{ old('transfer_date') ? old('transfer_date') : $transfer->transfer_date }}">
                            </div>

                            <div class="mb-3">
                                <label for="transfer-window" class="form-label">
                                    <i class="bi bi-thermometer-sun"></i>
                                    <span>Transfer Window</span>
                                </label>
                                <div class="radio-switches">
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="transfer_window" id="transfer-window-winter" class="form-check-input" value="Winter" @if ($transfer->transfer_window == 'Winter') checked @endif>
                                        <label for="transfer-window-winter" class="form-check-label">Winter</label>
                                    </div>
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="transfer_window" id="transfer-window-summer" class="form-check-input" value="Summer" @if ($transfer->transfer_window == 'Summer') checked @endif>
                                        <label for="transfer-window-summer" class="form-check-label">Summer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="contract-expires" class="form-label">
                                    <i class="bi bi-calendar-x"></i>
                                    <span>Contract Expires</span>
                                </label>
                                <input type="date" name="contract_expires" id="contract-expires" class="form-control" value="{{ $transfer->contract_expires }}">
                            </div>

                            <div class="mb-3">
                                <label for="joined-club-select" class="form-label">
                                    <i class="bi bi-calendar-month me-1"></i>
                                    <span>Joined club</span>
                                </label>
                                <select class="form-select @error('joined_club_id') is-invalid @enderror" name="joined_club_id" id="joined-club-select">
                                    <option selected disabled>Choose the joined club...</option>
                                    @foreach($clubs as $club)
                                        @if($club->id == $transfer->joined_club_id)
                                            <option value="{{ $club->id }}" selected>{{ $club->name }}</option>
                                        @else
                                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="loan" class="form-label">
                                    <i class="bi bi-hourglass-split"></i>
                                    <span>Loaned transfer</span>
                                </label>
                                <div class="radio-switches">
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="loan" id="loan-true" class="form-check-input" value="1" @if ($transfer->loan) checked @endif>
                                        <label for="loan-true" class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="loan" id="loan-false" class="form-check-input" value="0" @if (!$transfer->loan) checked @endif>
                                        <label for="loan-false" class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fee" class="form-label">
                                    <i class="bi bi-cash"></i>
                                    <span>Fee</span>
                                    <span class="badge bg-primary rounded-pill">millions €</span>
                                </label>
                                <input type="number" name="fee" id="fee" class="form-control" value="{{ $transfer->fee }}" placeholder="Enter the transfer fee">
                            </div>
                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('transfer.show', $transfer) }}">
                                <div>
                                    <i class="bi bi-arrow-left-circle"></i>
                                    <span>Return back</span>
                                </div>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2-circle"></i>
                                <span>Update transfer</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
