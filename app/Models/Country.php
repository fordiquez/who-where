<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function league(): HasOne
    {
        return $this->hasOne(League::class, 'id', 'first_tier_league_id');
    }
}
