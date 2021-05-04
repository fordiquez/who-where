@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('transfer.update', $transfer) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">{{ $transfer->player->name }} transfer editing</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-calendar-check"></i>
                                <label class="form-label" id="transfer-date">Transfer Date</label>
                                <input type="date" name="transfer_date" id="transfer-date" class="form-control" value="{{ $transfer->transfer_date }}">
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-thermometer-sun"></i>
                                <label class="form-label" id="transfer-window">Transfer Window</label>
                                <div class="radio-switches">
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="transfer_window" id="windowRadio" class="form-check-input" value="Winter" @if ($transfer->transfer_window == 'Winter') checked @endif>
                                        <label class="form-check-label" for="windowRadio">Winter</label>
                                    </div>
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="transfer_window" id="windowRadio" class="form-check-input" value="Summer" @if ($transfer->transfer_window == 'Summer') checked @endif>
                                        <label class="form-check-label" for="windowRadio">Summer</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-calendar-x"></i>
                                <label class="form-label" id="contract-expires">Contract Expires</label>
                                <input type="date" name="contract_expires" id="contract-expires" class="form-control" value="{{ $transfer->contract_expires }}">
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-hourglass-split"></i>
                                <label class="form-label" id="loan">Loaned transfer</label>
                                <div class="radio-switches">
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="loan" id="loanRadio" class="form-check-input" value="1" @if ($transfer->loan) checked @endif>
                                        <label class="form-check-label" for="loanRadio">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline form-switch">
                                        <input type="radio" name="loan" id="loanRadio" class="form-check-input" value="0" @if (!$transfer->loan) checked @endif>
                                        <label class="form-check-label" for="loanRadio">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <i class="bi bi-wallet2"></i>
                                <label for="fee" class="form-label">
                                    <span>Fee</span>
                                    <span class="badge bg-primary rounded-pill">millions €</span>
                                </label>
                                <input type="number" name="fee" id="fee" class="form-control" value="{{ $transfer->fee }}" placeholder="Fee">
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
