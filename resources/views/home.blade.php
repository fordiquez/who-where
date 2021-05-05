@extends('assets.layout')

@section('title', 'Countries')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <h4 class="text-center">Countries list</h4>
            @foreach($countries as $country)
                <div class="col-md-6 g-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="country-item">
                                <img src="{{ asset($country->flag) }}" class="flex-shrink-0 me-sm-3 country-flag" alt="{{ $country->name }}" title="{{ $country->name }}">
                                <div class="country-information">
                                    <h5 class="card-title">
                                        <i class="bi bi-flag-fill"></i>
                                        {{ $country->name }}
                                    </h5>
                                    <a href="{{ route('country.show', $country) }}" class="btn btn-primary">
                                        <i class="bi bi-info-circle"></i>
                                        <span>Information</span>
                                    </a>
                                    <a href="{{ route('league.index', $country) }}" class="btn btn-primary mt-2">
                                        <i class="bi bi-table"></i>
                                        <span>Leagues</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
