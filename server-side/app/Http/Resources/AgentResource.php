<?php

namespace App\Http\Resources;

use App\Enums\StatusCode;
use App\Models\Agent;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Agent */
class AgentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'username'           => $this->username,
            'status'             => $this->status,
            'status_description' => $this->stop_message ?: StatusCode::getDescription($this->status),
            'members_count'      => $this->when(isset($this->members_count), $this->members_count),
            'created_at'         => $this->created_at->toDateTimeString(),
            'updated_at'         => $this->updated_at->toDateTimeString(),
        ];
    }
}
