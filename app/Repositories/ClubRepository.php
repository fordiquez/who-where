<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ClubRepository
{
    public function getTotalPlayers(): array
    {
        return DB::select('exec dbo.getTotalPlayersByClubs');
    }

    public function getAvgAge(): array
    {
        return DB::select('exec dbo.getAvgAgeByClubs');
    }

    public function getForeigners(): array
    {
        return DB::select('exec getForeignersByClubs');
    }

    public function getTotalMarketValue(): array
    {
        return DB::select('exec dbo.getTotalMarketValueByClubs');
    }

    public function getAvgMarketValue(): array
    {
        return DB::select('exec dbo.getAvgMarketValueByClubs');
    }

    public function getMostValuablePlayer($clubId): array
    {
        return DB::select('exec dbo.getMostValuablePlayerByClub ' . $clubId);
    }
}
