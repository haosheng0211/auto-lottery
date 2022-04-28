<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Game extends Model
{
    public $timestamps = false;

    protected $fillable = ['cycle_id', 'cycle_no', 'active', 'stopped_at'];

    public function scopeWhereUpcoming($query, int $seconds = 10)
    {
        $query->where('stopped_at', '<', Carbon::now()->addSeconds($seconds));
    }
}
