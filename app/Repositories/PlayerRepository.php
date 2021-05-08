<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PlayerRepository
{
    public function playersAge(): array
    {
        return DB::select('select id, dbo.getPlayersAge(birth_date) age from players');
    }

    public function playerAge($id): array
    {
        return DB::select('select id, dbo.getPlayersAge(birth_date) age from players where id = ' . $id);
    }

    public function YoungestPlayer($clubId): array
    {
        return DB::select('exec dbo.getTheYoungestPlayer ' . $clubId);
    }

    public function OldestPlayer($clubId): array
    {
        return DB::select('exec dbo.getTheOldestPlayer ' . $clubId);
    }
}
