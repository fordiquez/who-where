@extends('assets.layout')

@section('title', $country->name)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <form method="post" action="{{ route('country.update', $country) }}" enctype="multipart/form-data">
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
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : $country->name }}" placeholder="Country name">
                            </div>

                            <div class="mb-3">
                                <label for="code" class="form-label">
                                    <i class="bi bi-file-binary-fill"></i>
                                    <span>Code</span>
                                    <span class="badge bg-primary rounded-pill">ISO 3166-2</span>
                                </label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') ? old('code') : $country->code }}" placeholder="Enter the ISO 3166-2 code (e.g. Canada – CA)">
                            </div>

                            <div class="mb-3">
                                <label for="flag" class="form-label">
                                    <i class="bi bi-file-earmark-image"></i>
                                    <span>Flag Image</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <input type="file" name="flag" id="flag" class="form-control @error('flag') is-invalid @enderror">
                            </div>

                            <div class="mb-3">
                                <label for="first-tier-league-select" class="form-label">
                                    <i class="bi bi-list-ol"></i>
                                    <span class="ms-1">First Tier League</span>
                                    <span class="badge bg-primary rounded-pill">Not required</span>
                                </label>
                                <select name="first_tier_league_id" id="first-tier-league-select" class="form-select @error('first_tier_league_id') is-invalid @enderror">
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
