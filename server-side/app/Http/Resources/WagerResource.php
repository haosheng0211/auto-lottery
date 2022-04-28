<?php

namespace App\Http\Resources;

use App\Models\Wager;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Wager */
class WagerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'game'       => new GameResource($this->whenLoaded('game')),
            'trick'      => new TrickResource($this->whenLoaded('trick')),
            'member'     => new MemberResource($this->whenLoaded('member')),
            'cycle_no'   => $this->cycle_no,
            'amount'     => $this->amount,
            'created_at' => $this->created_at,
            'monitor_at' => $this->monitor_at,
        ];
    }
}
