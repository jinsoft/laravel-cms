<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/6/30 16:31
 */

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LogoutEvent extends Event
{
    use SerializesModels;

    public $user;

    public $ip;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($user, $ip)
    {
        $this->user = $user;
        $this->ip = $ip;
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