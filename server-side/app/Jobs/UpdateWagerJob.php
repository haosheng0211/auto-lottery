<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Http\Resources\Remote\WagerResource;
use App\Models\Agent;
use App\Models\Member;
use App\Models\Track;
use App\Models\Wager;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class UpdateWagerJob extends Task
{
    public $model;

    public $member;

    public function __construct(Agent $model, Member $member)
    {
        $this->model = $model;
        $this->member = $member;
    }

    public function handle()
    {
        try {
            $request = Http::send('POST', '/api_e/page/120004', [
                'base_uri' => config('lottery.agent.base_uri'),
                'headers'  => ['Authorization' => $this->model->access_token],
                'body'     => "userId={$this->member->id}&liquidated=0&pageInfo=0*1000",
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }

            $items = WagerResource::collection($content['data']['list'])->resolve();

            foreach ($items as $item) {
                $this->createWager($item);
                $this->createTrack($item);
            }
        } catch (Throwable $e) {
            if (in_array($e->getCode(), ErrorCode::Unauthorized)) {
                $this->model->update(['status' => StatusCode::Pending]);
            }
        }
    }

    public function createWager($item): void
    {
        if (! Wager::find($item['id'])) {
            $item['member_id'] = $this->member->id;
            $item['monitor_at'] = Carbon::now();

            try {
                Wager::create($item);
            } catch (Throwable $e) {
            }
        }
    }

    public function createTrack($item)
    {
        foreach ($this->member->strategies()->whereActive(true)->get() as $strategy) {
            $track_cache_key = 'track:' . md5($strategy->id . $item['id']);

            if (Cache::has($track_cache_key)) {
                continue;
            }

            Cache::set($track_cache_key, $track_cache_key);

            $amount = (int) round($item['amount'] * $strategy->tariff);
            $status = StatusCode::Pending;
            $stop_message = null;

            if ($amount < $strategy->min_limit || $amount > $strategy->max_limit) {
                $status = StatusCode::Stopped;
                $stop_message = '超出限额';
            }

            $track = Track::create([
                'game_id'      => $item['game_id'],
                'staff_id'     => $strategy->staff_id,
                'wager_id'     => $item['id'],
                'trick_id'     => $item['trick_id'],
                'cycle_no'     => $item['cycle_no'],
                'member_id'    => $this->member->id,
                'strategy_id'  => $strategy->id,
                'amount'       => $amount,
                'status'       => $status,
                'stop_message' => $stop_message,
            ]);
            Task::deliver(new PublishTrack($strategy->staff, $track));
        }
    }
}
