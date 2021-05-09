<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CountryRepository
{
    public function getTotalLeagues(): array
    {
        return DB::select('exec dbo.getTotalLeaguesByCountries');
    }

    public function getTotalClubs(): array
    {
        return DB::select('exec dbo.getTotalClubsByCountries');
    }

    public function getTotalPlayers(): array
    {
        return DB::select('exec dbo.getTotalPlayersByCountries');
    }
}
