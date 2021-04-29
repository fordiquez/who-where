@extends('assets.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('home.index') }}">
                    <select class="form-select" name="country" aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select" name="club" aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                        @foreach($clubs as $club)
                            <option value="{{ $club->id }}">{{ $club->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Sub</button>
                    <button type="reset">fgf</button>
                </form>
            </div>
        </div>
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
        </tr>
        </thead>
        <tbody>
        <?php $index = 0; ?>
        @foreach($transfers as $transfer)
            <?php $index++; ?>
            <tr>
                <th scope="row" class="text-center">{{ $index }}</th>
                <td>{{ $transfer->player_id }}</td>
                <td class="text-center">{{ $transfer->player_id }}</td>
                <td class="text-center">{{ $transfer->player_id }}</td>
                <td>{{ $transfer->left_club_id }}</td>
                <td>{{ $transfer->joined_club_id }}</td>
                <td class="text-center">{{ $transfer->fee }}m</td>
                <td class="text-center">{{ $transfer->fee }}m</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
