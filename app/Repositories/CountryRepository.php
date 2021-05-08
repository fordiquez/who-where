<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CountryRepository
{
    public function getTotalLeagues(): array
    {
        return DB::select('exec getTotalLeaguesByCountries');
    }

    public function getTotalClubs(): array
    {
        return DB::select('exec getTotalClubsByCountries');
    }

    public function getTotalPlayers(): array
    {
        return DB::select('exec getTotalPlayersByCountries');
    }
}
