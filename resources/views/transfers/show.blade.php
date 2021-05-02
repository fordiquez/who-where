@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
            <h3 class="text-center">Player transfer information</h3>
            <div class="card">
                <h5 class="card-header">
                    <i class="bi bi-person-lines-fill"></i>
                    Player name: {{ $transfer->player->name }}
                </h5>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-calendar-check"></i>
                                <b>Transfer date:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->transfer_date }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-calendar-month"></i>
                                <b>Season:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->season->year }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-thermometer-sun"></i>
                                <b>Transfer window:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->transfer_window }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-calendar-x"></i>
                                <b>Contract expires:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->contract_expires }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-box-arrow-in-left"></i>
                                <b>Left club:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->left_club->name }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-box-arrow-right"></i>
                                <b>Joined club:</b> <span class="badge bg-primary rounded-pill">{{ $transfer->joined_club->name }}</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p class="card-text">
                                <i class="bi bi-shop-window"></i>
                                <b>Player's market value:</b> <span class="badge bg-primary rounded-pill">€ {{ $transfer->player->market_value }}m</span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            @if ($transfer->loan)
                                <p class="card-text">
                                    <i class="bi bi-wallet2"></i>
                                    <b>Loaned transfer for:</b> <span class="badge bg-primary rounded-pill">€ {{ $transfer->fee }}m</span>
                                </p>
                            @else
                                <p class="card-text">
                                    <i class="bi bi-wallet2"></i>
                                    <b>Fee value:</b> <span class="badge bg-primary rounded-pill">€ {{ $transfer->fee }}m</span>
                                </p>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="card-footer footer-links">
                    <a class="btn btn-primary float-start" href="{{ route('home.index') }}">
                        <div>
                            <i class="bi bi-arrow-left-circle"></i>
                            <span>Return back</span>
                        </div>
                    </a>
                    <a class="btn btn-primary float-end" href="{{ route('transfer.edit', $transfer) }}">
                        <div>
                            <i class="bi bi-pencil-fill"></i>
                            <span>Edit transfer</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
