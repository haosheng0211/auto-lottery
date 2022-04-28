<?php

namespace App\Http\Resources;

use App\Enums\StatusCode;
use App\Models\Staff;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Staff */
class StaffResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'username'           => $this->username,
            'status'             => $this->status,
            'status_description' => $this->stop_message ?: StatusCode::getDescription($this->status),
            'created_at'         => $this->created_at->toDateTimeString(),
            'updated_at'         => $this->updated_at->toDateTimeString(),
        ];
    }
}
