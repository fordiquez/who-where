@extends('assets.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('country.update', 1) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Editing country {{ $country->name }}</h3>
                        </div>
                        <img src="{{ asset($country->flag) }}" class="card-img-top" alt="{{ $country->name }}" title="{{ $country->name }}">
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
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Country name" id="name" value="{{ $country->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="code" class="form-label">
                                    <i class="bi bi-file-binary-fill"></i>
                                    <span>Code</span>
                                    <span class="badge bg-primary rounded-pill">ISO 3166-2</span>
                                </label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter the ISO 3166-2 code (e.g. Canada – CA)" id="code" value="{{ $country->code }}">
                            </div>

                            <div class="mb-3">
                                <label for="flag" class="form-label">
                                    <i class="bi bi-file-earmark-image"></i>
                                    <span>Flag Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="flag" class="form-control @error('flag') is-invalid @enderror" id="flag">
                            </div>

                            <div class="mb-3">
                                <label for="first-tier-league-select" class="form-label">
                                    <i class="bi bi-list-ol"></i>
                                    <span class="ms-1">First Tier League</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <select name="first_tier_league_id" class="form-select @error('first_tier_league_id') is-invalid @enderror" id="first-tier-league-select">
                                    <option selected disabled>Choose the first tier league...</option>
                                    @foreach($leagues as $league)
                                        @if($league->id == $country->first_tier_league_id)
                                            <option value="{{ $league->id }}" selected>{{ $league->name }}</option>
                                        @else
                                            <option value="{{ $league->id }}">{{ $league->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer footer-links">
                            <a class="btn btn-primary float-start" href="{{ route('country.show', $country) }}">
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
