<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ClubRepository
{
    public function getTotalPlayers(): array
    {
        return DB::select('exec getTotalPlayersByClubs');
    }

    public function getAvgAge(): array
    {
        return DB::select('exec getAvgAgeByClubs');
    }

    public function getForeigners(): array
    {
        return DB::select('exec getForeignersByClubs');
    }

    public function getTotalMarketValue(): array
    {
        return DB::select('exec getTotalMarketValueByClubs');
    }

    public function getAvgMarketValue(): array
    {
        return DB::select('exec getAvgMarketValueByClubs');
    }

    public function getMostValuablePlayer($clubId): array
    {
        return DB::select('exec getMostValuablePlayerByClub ' . $clubId);
    }
}
