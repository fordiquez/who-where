@extends('assets.layout')

@section('content')
    <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Leagues list</h3>
                        <table class="table table-dark table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Competition</th>
                                <th scope="col" class="text-center">Clubs</th>
                                <th scope="col" class="text-center">Players</th>
                                <th scope="col" class="text-center">Avg. age</th>
                                <th scope="col" class="text-center">Foreigners</th>
                                <th scope="col" class="text-center">Total value</th>
                                <th scope="col" class="text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTransferModal">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leagues as $league)
                                <tr>
                                    <th scope="row">
                                        <img src="{{ asset($league->logo) }}" height="35" width="35">
                                        <span class="badge bg-primary rounded-pill">First Tier</span>
                                        <span>{{ $league->name }}</span>
                                    </th>
                                    <td class="text-center">
                                        20
                                    </td>
                                    <td class="text-center">3</td>
                                    <td class="text-center">25.3</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">333</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-primary me-1">
                                            <i class="bi bi-cursor"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection
