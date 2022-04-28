<?php

namespace App\Http\Resources;

use App\Enums\StatusCode;
use App\Models\Track;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Track */
class TrackResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'game'               => new GameResource($this->whenLoaded('game')),
            'staff'              => new StaffResource($this->whenLoaded('staff')),
            'trick'              => new TrickResource($this->whenLoaded('trick')),
            'member'             => new MemberResource($this->whenLoaded('member')),
            'cycle_no'           => $this->cycle_no,
            'status'             => $this->status,
            'status_description' => $this->stop_message ?: StatusCode::getDescription($this->status),
            'amount'             => $this->amount,
            'created_at'         => $this->created_at->toDateTimeString(),
            'updated_at'         => $this->updated_at->toDateTimeString(),
        ];
    }
}
