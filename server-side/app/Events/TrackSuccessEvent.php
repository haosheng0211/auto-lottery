<?php

namespace App\Events;

use App\Models\Track;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrackSuccessEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $track;

    public function __construct(Track $track)
    {
        $this->track = $track;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('track');
    }

    public function broadcastAs(): string
    {
        return 'track.success';
    }
}
