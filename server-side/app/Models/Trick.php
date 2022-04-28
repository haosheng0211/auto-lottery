<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trick extends Model
{
    public $timestamps = false;

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function scopeWhereGameName($query, string $game_name)
    {
        $query->whereHas('game', function ($query) use ($game_name) {
            $query->where('name', $game_name);
        });
    }
}
