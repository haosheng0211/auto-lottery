<?php

namespace App\Jobs\Timers;

use App\Jobs\UpdateWagerJob;
use App\Models\Agent;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

class WagerTimer extends CronJob
{
    protected $interval = 200;

    protected $isImmediate = true;

    public function run()
    {
        $agents = Agent::with(['members'])->whereRunning()->get();

        foreach ($agents as $agent) {
            foreach ($agent->members as $member) {
                if ($member->strategies()->whereActive(true)->count()) {
                    Task::deliver(new UpdateWagerJob($agent, $member));
                }
            }
        }
    }
}
