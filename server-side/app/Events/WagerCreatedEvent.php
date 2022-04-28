<?php

namespace App\Events;

use App\Models\Wager;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WagerCreatedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $wager;

    public function __construct(Wager $wager)
    {
        $this->wager = $wager;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('wager');
    }

    public function broadcastAs(): string
    {
        return 'wager.created';
    }
}
