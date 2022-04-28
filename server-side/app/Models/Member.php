<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    public $timestamps = false;

    protected $fillable = ['id', 'agent_id', 'nickname', 'username'];

    public function strategies(): HasMany
    {
        return $this->hasMany(Strategy::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
