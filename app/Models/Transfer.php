<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function player(): BelongsTo {
        return $this->belongsTo(Player::class);
    }

    public function season(): BelongsTo {
        return $this->belongsTo(Season::class);
    }

    public function left_club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'left_club_id');
    }

    public function joined_club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'joined_club_id');
    }
}
