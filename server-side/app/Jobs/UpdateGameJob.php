<?php

namespace App\Jobs;

use App\Enums\ErrorCode;
use App\Enums\StatusCode;
use App\Http\Resources\Remote\GameResource;
use App\Models\Game;
use App\Models\Staff;
use Exception;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Illuminate\Support\Facades\Http;
use Throwable;

class UpdateGameJob extends Task
{
    public $game;

    public $model;

    public function __construct(Staff $model, Game $game)
    {
        $this->game = $game;
        $this->model = $model;
    }

    public function handle()
    {
        try {
            $request = Http::send('POST', '/api_m/get/300102', [
                'base_uri' => config('lottery.staff.base_uri'),
                'headers'  => [
                    'Authorization' => $this->model->access_token,
                ],
                'body'     => "gameId={$this->game->id}",
            ]);
            $content = $request->json();

            if ($content['err_code'] !== ErrorCode::Success) {
                throw new Exception($content['err_msg'], $content['err_code']);
            }

            $this->game->update(GameResource::make($content['data'])->resolve());
        } catch (Throwable $e) {
            if (in_array($e->getCode(), ErrorCode::Unauthorized)) {
                $this->model->update(['status' => StatusCode::Pending]);
            }
        }
    }
}
