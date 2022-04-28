<?php

namespace App\Jobs\Timers;

use App\Jobs\UpdateMemberJob;
use App\Models\Agent;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

class MemberTimer extends CronJob
{
    protected $interval = 1000;

    protected $isImmediate = true;

    public function run()
    {
        $agents = Agent::whereRunning()->get();

        foreach ($agents as $agent) {
            Task::deliver(new UpdateMemberJob($agent));
        }
    }
}
