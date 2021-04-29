@extends('assets.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <form method="post" action="{{ route('transfer.update', $transfer) }}">
                    @csrf
                    <h4 class="text-center">Editing transfer's {{ $transfer->player->name }}</h4>
                    <div class="mb-3">
                        <i class="bi bi-calendar-check"></i>
                        <label class="form-label" id="transfer-date">Transfer Date</label>
                        <input type="date" name="transfer_date" class="form-control" id="transfer-date" value="{{ $transfer->transfer_date }}">
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-thermometer-sun"></i>
                        <label class="form-label" id="transfer-window">Transfer Window</label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="transfer_window" id="windowRadio" value="Winter" @if ($transfer->transfer_window == 'Winter') checked @endif>
                                <label class="form-check-label" for="windowRadio">Winter</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="transfer_window" id="windowRadio" value="Summer" @if ($transfer->transfer_window == 'Summer') checked @endif>
                                <label class="form-check-label" for="windowRadio">Summer</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-calendar-x"></i>
                        <label class="form-label" id="contract-expires">Contract Expires</label>
                        <input type="date" name="contract_expires" class="form-control" id="contract-expires" value="{{ $transfer->contract_expires }}">
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-hourglass-split"></i>
                        <label class="form-label" id="loan">Loaned transfer</label>
                        <div class="radio-switches">
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="loan" id="loanRadio" value="1" @if ($transfer->loan) checked @endif>
                                <label class="form-check-label" for="loanRadio">Yes</label>
                            </div>
                            <div class="form-check form-check-inline form-switch">
                                <input class="form-check-input" type="radio" name="loan" id="loanRadio" value="0" @if (!$transfer->loan) checked @endif>
                                <label class="form-check-label" for="loanRadio">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-wallet2"></i>
                        <label for="fee" class="form-label">Fee</label>
                        <input type="number" name="fee" class="form-control" placeholder="Fee" id="fee" value="{{ $transfer->fee }}">
                    </div>
                    <a class="btn btn-primary float-start" href="{{ route('transfer.show', $transfer) }}">
                        <div>
                            <i class="bi bi-arrow-left-circle"></i>
                            <span>Return back</span>
                        </div>
                    </a>
                    <button type="submit" class="btn btn-primary float-end">
                        <i class="bi bi-check2-circle"></i>
                        <span>Update transfer</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
