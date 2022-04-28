<?php

namespace App\Services;

use App\Models\Track;

class TrackService implements TrackServiceInterface
{
    public function all(int $limit)
    {
        $tracks = Track::query()->with(['game', 'staff', 'trick', 'member', 'member.agent'])->orderByDesc('created_at')->limit($limit);

        return $tracks->get();
    }
}
