<?php

namespace App\Http\Resources\Remote;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class GameResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'cycle_id'   => (int) $this->resource['periodId'],
            'cycle_no'   => (int) $this->resource['period'],
            'active'     => $this->resource['stopTime'] > 0,
            'stopped_at' => Carbon::now()->addSeconds($this->resource['stopTime']),
        ];
    }
}
