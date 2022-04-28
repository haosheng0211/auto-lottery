<?php

namespace App\Jobs\Timers;

use App\Jobs\UpdateGameJob;
use App\Models\Game;
use App\Models\Staff;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

class GameTimer extends CronJob
{
    protected $interval = 1000;

    protected $isImmediate = true;

    public function run()
    {
        if ($model = Staff::whereRunning()->first()) {
            $games = Game::whereUpcoming()->get();

            foreach ($games as $game) {
                Task::deliver(new UpdateGameJob($model, $game));
            }
        }
    }
}
