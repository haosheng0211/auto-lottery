<?php

namespace App\Models;

use App\Enums\StatusCode;
use App\Events\StaffStoppedEvent;
use App\Jobs\LoginJob;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['username', 'password', 'status', 'stop_message', 'access_token'];

    public function scopeWhereRunning($query)
    {
        $query->where('status', StatusCode::Running);
    }

    protected static function booted()
    {
        static::updating(function (self $model) {
            if ($model->isDirty(['status'])) {
                if ($model->status !== StatusCode::Stopped) {
                    $model->stop_message = null;
                }

                if ($model->status !== StatusCode::Running) {
                    $model->access_token = null;
                }

                if ($model->status === StatusCode::Pending) {
                    Task::deliver(new LoginJob($model));
                }
            }
        });

        static::updated(function (self $model) {
            if ($model->isDirty(['status'])) {
                if ($model->status === StatusCode::Stopped) {
                    event(new StaffStoppedEvent($model));
                }
            }
        });
    }
}
