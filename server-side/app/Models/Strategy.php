<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Strategy extends Model
{
    protected $fillable = ['staff_id', 'member_id', 'min_limit', 'max_limit', 'tariff', 'active'];

    protected $casts = ['tariff' => 'float'];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
