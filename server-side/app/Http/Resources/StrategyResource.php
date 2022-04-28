<?php

namespace App\Http\Resources;

use App\Models\Strategy;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Strategy */
class StrategyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'staff'      => new StaffResource($this->whenLoaded('staff')),
            'member'     => new MemberResource($this->whenLoaded('member')),
            'min_limit'  => $this->min_limit,
            'max_limit'  => $this->max_limit,
            'tariff'     => $this->tariff,
            'active'     => $this->active,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
