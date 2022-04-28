<?php

namespace App\Events;

use App\Http\Resources\AgentResource;
use App\Models\Agent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AgentStoppedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('agent');
    }

    public function broadcastWith(): array
    {
        return AgentResource::make($this->agent)->resolve();
    }

    public function broadcastAs(): string
    {
        return 'agent.stopped';
    }
}
