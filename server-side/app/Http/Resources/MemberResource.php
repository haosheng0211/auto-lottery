<?php

namespace App\Http\Resources;

use App\Models\Member;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Member */
class MemberResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->id,
            'agent'    => new AgentResource($this->whenLoaded('agent')),
            'nickname' => $this->nickname,
            'username' => $this->username,
        ];
    }
}
