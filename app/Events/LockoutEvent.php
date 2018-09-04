<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LockoutEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;

    public $user_type;

    public $attempts;

    public $max_attempts;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request, $user_type, $attempts)
    {
        //
        $this->request = $request;
        $this->user_type = $user_type;
        $this->attempts = $attempts;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return [];
    }
}
