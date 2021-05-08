<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Championship extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'last_championship_season_id');
    }
}
