<?php

namespace App\Models;

use App\Events\WagerCreatedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wager extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'game_id', 'trick_id', 'cycle_no', 'member_id', 'amount', 'created_at', 'monitor_at'];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function trick(): BelongsTo
    {
        return $this->belongsTo(Trick::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    protected static function booted()
    {
        static::created(function (self $model) {
            event(new WagerCreatedEvent($model));
        });
    }
}
