@extends('assets.layout')

@section('title', $club->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('club.update', $club) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Editing {{ $club->name }}</h3>
                        </div>
                        <div class="card-photo">
                            <img src="{{ asset($club->logo) }}" alt="{{ $club->name }}" title="{{ $club->name }}">
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
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $club->name }}" placeholder="Enter the club name">
                            </div>

                            <div class="mb-3">
                                <label for="country-select" class="form-label">
                                    <i class="bi bi-flag-fill"></i>
                                    <span class="ms-1">Country</span>
                                </label>
                                <select name="country_id" id="country-select" class="form-select @error('first_tier_league_id') is-invalid @enderror">
                                    <option selected disabled>Choose the country...</option>
                                    @foreach($countries as $country)
                                        @if($club->country_id == $country->id)
                                            <option value="{{ $country->id }}" selected>{{ $country->name }}</option>
                                        @else
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="league-select" class="form-label">
                                    <i class="bi bi-bookmark-plus-fill"></i>
                                    <span class="ms-1">League</span>
                                </label>
                                <select name="league_id" id="league-select" class="form-select @error('league_id') is-invalid @enderror">
                                    <option selected disabled>Choose the league...</option>
                                    @foreach($leagues as $league)
                                        @if($club->league_id == $league->id)
                                            <option value="{{ $league->id }}" selected>{{ $league->name }}</option>
                                        @else
                                            <option value="{{ $league->id }}">{{ $league->name }}</option>
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

                            <div class="mb-3">
                                <label for="founded" class="form-label">
                                    <i class="bi bi-clock-history"></i>
                                    <span>Founded</span>
                                </label>
                                <input type="number" name="founded" id="founded" class="form-control @error('founded') is-invalid @enderror" value="{{ old('founded') ? old('founded') : $club->founded }}" placeholder="Enter the league level">
                            </div>

                            <div class="mb-3">
                                <label for="stadium" class="form-label">
                                    <i class="bi bi-building"></i>
                                    <span class="ms-1">Stadium</span>
                                </label>
                                <input type="text" name="stadium" id="stadium" class="form-control @error('stadium') is-invalid @enderror" value="{{ old('stadium') ? old('stadium') : $club->stadium }}" placeholder="Enter the number">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span class="ms-1">Address</span>
                                </label>
                                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') ? old('address') : $club->address }}" placeholder="Enter the place number">
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">
                                    <i class="bi bi-signpost-2-fill"></i>
                                    <span class="ms-1">City</span>
                                </label>
                                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') ? old('city') : $club->city }}" placeholder="Enter the number of points">
                            </div>

                            <div class="mb-3">
                                <label for="capacity" class="form-label">
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span class="ms-1">Capacity</span>
                                </label>
                                <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') ? old('capacity') : $club->capacity }}" placeholder="Enter the number of points">
                            </div>

                            <div class="mb-3">
                                <label for="head_coach" class="form-label">
                                    <i class="bi bi-person-badge-fill"></i>
                                    <span class="ms-1">Head Coach</span>
                                </label>
                                <input type="text" name="head_coach" id="head_coach" class="form-control @error('head_coach') is-invalid @enderror" value="{{ old('head_coach') ? old('head_coach') : $club->head_coach }}" placeholder="Enter the number of points">
                            </div>
                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('club.show', $club) }}">
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
