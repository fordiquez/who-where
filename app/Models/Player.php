<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function signed(): BelongsTo {
        return $this->belongsTo(Club::class, 'signed_from_club_id');
    }

    public function birth(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'birth_country_id');
    }

    public function nation(): BelongsTo {
        return $this->belongsTo(Country::class, 'citizenship_country_id');
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function main_position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'main_position_id');
    }
}
