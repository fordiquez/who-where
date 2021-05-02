<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class League extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function record(): HasOne
    {
        return $this->hasOne(Club::class, 'id', 'record_holding_champion_id');
    }

    public function reigning(): HasOne
    {
        return $this->hasOne(Club::class, 'id', 'reigning_champion_id');
    }
}
