<?php

namespace App\Http\Resources\Remote;

use App\Models\Game;
use App\Models\Trick;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class WagerResource extends JsonResource
{
    public function toArray($request): array
    {
        $game_cache_key = 'game:' . md5($this->resource['game']);

        return [
            'id'           => (int) $this->resource['id'],
            'game_id'      => (int) Cache::rememberForever($game_cache_key, fn () => Game::whereName($this->resource['game'])->firstOrFail()->id),
            'trick_id'     => (int) Cache::rememberForever($game_cache_key . ':' . md5($this->resource['name']), fn () => Trick::whereGameName($this->resource['game'])->whereName($this->resource['name'])->firstOrFail()->id),
            'cycle_no'     => (int) Str::replace('期', '', $this->resource['period']),
            'amount'       => (int) $this->resource['amount'],
            'created_at'   => Carbon::parse($this->resource['time'], 'Asia/Shanghai'),
        ];
    }
}
