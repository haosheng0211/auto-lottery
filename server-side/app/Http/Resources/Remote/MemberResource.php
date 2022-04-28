<?php

namespace App\Http\Resources\Remote;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'       => $this->resource['user']['id'],
            'nickname' => $this->resource['user']['nickname'],
            'username' => $this->resource['user']['username'],
        ];
    }
}
