<?php

namespace App\Listeners;

use App\Events\LogoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LogoutEvent $event
     * @return void
     */
    public function handle(LogoutEvent $event)
    {
        $user = $event->user;
        $logout_info = [
            'user_name' => $user->name,
            'ip' => $event->ip,
            'msg' => '登出成功',
            'status' => 1
        ];
        try {
            $user->login_history()->create($logout_info);
        } catch (\Exception $e) {
        }
    }
}
