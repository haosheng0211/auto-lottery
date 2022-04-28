<?php

namespace App\Services;

use App\Models\Wager;

class WagerService implements WagerServiceInterface
{
    public function all(int $limit)
    {
        $wagers = Wager::query()->with(['game', 'trick', 'member.agent'])->orderByDesc('created_at')->limit($limit);

        return $wagers->get();
    }
}
