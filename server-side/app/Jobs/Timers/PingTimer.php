<?php

namespace App\Jobs\Timers;

use App\Jobs\StaffPingJob;
use App\Models\Staff;
use Hhxsv5\LaravelS\Swoole\Task\Task;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

class PingTimer extends CronJob
{
    protected $interval = 1000;

    protected $isImmediate = true;

    public function run()
    {
        $staffs = Staff::whereRunning()->get();

        foreach ($staffs as $staff) {
            Task::deliver(new StaffPingJob($staff));
        }
    }
}
