@extends('assets.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('league.update', $league) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Editing {{ $league->name }}</h3>
                        </div>
                        <div class="card-photo">
                            <img src="{{ asset($league->logo) }}" alt="{{ $league->name }}" title="{{ $league->name }}">
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
                                <label for="name-input" class="form-label">
                                    <i class="bi bi-type"></i>
                                    <span>Name</span>
                                </label>
                                <input type="text" name="name" id="name-input" class="form-control @error('name') is-invalid @enderror" value="{{ $league->name }}" placeholder="Enter the league name">
                            </div>

                            <div class="mb-3">
                                <label for="league-level-input" class="form-label">
                                    <i class="bi bi-file-binary-fill"></i>
                                    <span>League level</span>
                                </label>
                                <input type="text" name="league_level" id="league-level-input" class="form-control @error('code') is-invalid @enderror" value="{{ $league->league_level }}" placeholder="Enter the league level">
                            </div>

                            <div class="mb-3">
                                <label for="logo-file" class="form-label">
                                    <i class="bi bi-file-earmark-image"></i>
                                    <span>Logo Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="logo" id="logo-file" class="form-control @error('flag') is-invalid @enderror">
                            </div>

                            <div class="mb-3">
                                <label for="country-select" class="form-label">
                                    <i class="bi bi-list-ol"></i>
                                    <span class="ms-1">Country</span>
                                </label>
                                <select name="country_id" id="country-select" class="form-select @error('first_tier_league_id') is-invalid @enderror">
                                    <option selected disabled>Choose the country...</option>
                                    @foreach($countries as $country)
                                        @if($league->country_id == $country->id)
                                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('league.show', $league) }}">
                                <div>
                                    <i class="bi bi-arrow-left-circle"></i>
                                    <span>Return back</span>
                                </div>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check2-circle"></i>
                                <span>Update country</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
