<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class LeagueRepository
{
    public function getTotalClubs(): array
    {
        return DB::select('exec dbo.getTotalClubsByLeagues');
    }

    public function getTotalPlayers(): array
    {
        return DB::select('exec dbo.getTotalPlayersByLeagues');
    }

    public function getAvgAge(): array
    {
        return DB::select('exec dbo.getAvgAgeByLeagues');
    }

    public function getForeigners(): array
    {
        return DB::select('exec dbo.getForeignersByLeagues');
    }

    public function getTotalMarketValue(): array
    {
        return DB::select('exec dbo.getTotalMarketValueByLeagues');
    }

    public function getAvgMarketValue(): array
    {
        return DB::select('exec dbo.getAvgMarketValueByLeagues');
    }

    public function getMostValuablePlayer($leagueId): array
    {
        return DB::select('exec dbo.getMostValuablePlayerByLeague ' . $leagueId);
    }

    public function getRecordHoldingChampions($leagueId): array
    {
        return DB::select('exec dbo.getRecordHoldingChampions ' . $leagueId);
    }

    public function getReigningChampion($leagueId): array
    {
        return DB::select('exec dbo.getReigningChampion ' . $leagueId);
    }
}
