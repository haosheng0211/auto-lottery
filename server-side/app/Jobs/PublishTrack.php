<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Models\Game;
use App\Models\Staff;
use App\Models\Track;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Http;
use Throwable;

class PublishTrack extends Task
{
    public Staff $model;

    public Track $track;

    public function __construct(Staff $model, Track $track)
    {
        $this->model = $model;
        $this->track = $track;
    }

    public function handle()
    {
        try {
            $this->model->refresh();
            $this->track->refresh();

            if ($this->model->status !== StatusCode::Running) {
                $this->track->update(['status' => StatusCode::Stopped, 'stop_message' => '跟注帳號未運行']);

                return;
            }

            if (! $game = Game::find($this->track->game_id)) {
                $this->track->update(['status' => StatusCode::Stopped, 'stop_message' => '遊戲不存在']);

                return;
            }

            if ($game->cycle_no !== $this->track->cycle_no) {
                $this->track->update(['status' => StatusCode::Stopped, 'stop_message' => '開獎期數不匹配']);

                return;
            }

            $request = Http::send('POST', '/api_m/get/300001', [
                'base_uri' => config('lottery.staff.base_uri'),
                'headers'  => [
                    'Authorization' => $this->model->access_token,
                ],
                'body'     => "periodId={$game->cycle_id}&ignoreOdd=1&betList={$this->track->trick_id}_1_{$this->track->amount}_",
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }

            $this->track->update(['status' => StatusCode::Success]);
        } catch (Throwable $e) {
            $this->track->update(['status' => StatusCode::Stopped, 'stop_message' => $e->getMessage()]);
        }
    }
}
