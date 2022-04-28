<?php

namespace App\Models;

use App\Enums\StatusCode;
use App\Events\TrackCreatedEvent;
use App\Events\TrackStoppedEvent;
use App\Events\TrackSuccessEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    protected $fillable = ['game_id', 'staff_id', 'wager_id', 'trick_id', 'cycle_no', 'member_id', 'strategy_id', 'amount', 'status', 'stop_message'];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
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
            event(new TrackCreatedEvent($model));
        });

        static::updated(function (self $model) {
            if ($model->isDirty(['status'])) {
                if ($model->status == StatusCode::Stopped) {
                    event(new TrackStoppedEvent($model));
                }

                if ($model->status == StatusCode::Success) {
                    event(new TrackSuccessEvent($model));
                }
            }
        });
    }
}
