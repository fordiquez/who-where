@extends('assets.layout')

@section('content')
    <div class="container">
        <div class="col-12 col-md-6 offset-md-3">
            <h3 class="text-center">Player transfer information</h3>
            <div class="card">
                <h5 class="card-header">
                    <i class="bi bi-person-lines-fill"></i>
                    Player name: {{ $transfer->player->name }}
                </h5>
                <div class="card-body">
                    <p class="card-text">
                        <i class="bi bi-calendar-check"></i>
                        Transfer date: <b>{{ $transfer->transfer_date }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-calendar-month"></i>
                        Season: <b>{{ $transfer->season->year }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-thermometer-sun"></i>
                        Transfer window: <b>{{ $transfer->transfer_window }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-calendar-x"></i>
                        Contract expires: <b>{{ $transfer->contract_expires }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-box-arrow-in-left"></i>
                        Left club: <b>{{ $transfer->left_club->name }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-box-arrow-right"></i>
                        Joined club: <b>{{ $transfer->joined_club->name }}</b>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-shop-window"></i>
                        Player's market value: <b>{{ $transfer->player->market_value }}</b>
                    </p>
                    @if ($transfer->loan)
                        <p class="card-text">
                            <i class="bi bi-wallet2"></i>
                            Loaned transfer for: <b>{{ $transfer->fee }}</b>
                        </p>
                    @else
                        <p class="card-text">
                            <i class="bi bi-wallet2"></i>
                            Fee value: <b>{{ $transfer->fee }}</b>
                        </p>
                    @endif
                    <a class="btn btn-primary float-start" href="{{ route('home.index') }}">
                        <div>
                            <i class="bi bi-arrow-left-circle"></i>
                            <span>Return back</span>
                        </div>
                    </a>
                    <a class="btn btn-primary float-end" href="{{ route('transfer.edit', $transfer) }}">
                        <div>
                            <i class="bi bi-pencil"></i>
                            <span>Edit transfer</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
