<?php

namespace App\Http\Resources;

use App\Models\Trick;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Trick */
class TrickResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'game' => new GameResource($this->whenLoaded('game')),
            'name' => $this->name,
        ];
    }
}
