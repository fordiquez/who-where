@extends('assets.layout')

@section('icon')
    <link rel="icon" type="image/png" href="{{ asset($league->logo) }}">
@endsection

@section('title', strtoupper($league->name))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('league.update', $league) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header league-title">
                            <h5 class="card-title league-title text-center text-uppercase p-2 bg-indigo rounded">
                                <span>Editing information about {{ $league->name }}</span>
                            </h5>
                        </div>
                        <div class="card-photo mt-3">
                            <a href="{{ route('league.show', $league) }}">
                                <img src="{{ asset($league->logo) }}" class="full-logo" alt="{{ $league->name }}" title="{{ $league->name }}">
                            </a>
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
                                <label for="name" class="form-label">
                                    <i class="bi bi-type"></i>
                                    <span>Name</span>
                                </label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $league->name }}" placeholder="Enter the league name">
                            </div>

                            <div class="mb-3">
                                <label for="league-level" class="form-label">
                                    <i class="bi bi-graph-up"></i>
                                    <span>League level</span>
                                </label>
                                <input type="text" name="league_level" id="league-level" class="form-control @error('league_level') is-invalid @enderror" value="{{ old('league_level') ? old('league_level') : $league->league_level }}" placeholder="Enter the league level">
                            </div>

                            <div class="mb-3">
                                <label for="country-select" class="form-label">
                                    <i class="bi bi-flag-fill"></i>
                                    <span class="ms-1">Country</span>
                                </label>
                                <select class="form-select @error('country_id') is-invalid @enderror" name="country_id" id="country-select">
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

                            <div class="mb-3">
                                <label for="logo-file" class="form-label">
                                    <i class="bi bi-file-earmark-image"></i>
                                    <span>Logo Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="logo" id="logo-file" class="form-control @error('logo') is-invalid @enderror">
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
                                <span>Update league</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
