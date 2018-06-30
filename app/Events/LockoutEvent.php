<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/6/30 16:34
 */

namespace App\Events;

use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LockoutEvent extends Event
{
    use SerializesModels;

    public $request;

    public $attempts;

    public $max_attempts;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct(Request $request, $attempts)
    {
        $this->request = $request;
        $this->attempts = $attempts;
    }

    /**
     * Get the channels the event should be broadcast on.
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}