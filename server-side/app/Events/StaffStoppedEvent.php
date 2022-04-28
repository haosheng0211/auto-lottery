<?php

namespace App\Events;

use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StaffStoppedEvent implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('staff');
    }

    public function broadcastWith(): array
    {
        return StaffResource::make($this->staff)->resolve();
    }

    public function broadcastAs(): string
    {
        return 'staff.stopped';
    }
}
