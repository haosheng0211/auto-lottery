<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Game */
class GameResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'cycle_id'   => $this->cycle_id,
            'cycle_no'   => $this->cycle_no,
            'active'     => $this->active,
            'stopped_at' => $this->stopped_at,
        ];
    }
}
