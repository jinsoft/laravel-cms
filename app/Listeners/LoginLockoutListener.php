<?php

namespace App\Listeners;

use App\Events\LockoutEvent;
use App\Model\Admin;
use App\Model\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginLockoutListener
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
     * @param  LockoutEvent $event
     * @return void
     */
    public function handle(LockoutEvent $event)
    {
        $login_name = $event->request->name;
        $user_type = $event->user_type;
        $attempts = $event->attempts;

        if ($user_type == 'member') $user = User::where('name', $login_name)->orWhere('phone', $login_name)->first();
        if ($user_type == 'admin') $user = Admin::where('email', $login_name)->orWhere('phone', $login_name)->first();

        if ($user) {
            $login_params = [
                'user_name' => $user->name,
                'user_id' => $user->id,
                'ip' => $event->request->ip(),
                'uuid' => $user->uuid,
                // -1 因为 登录密码错误的次数是从2开始算的
                'msg' => "登录失败，密码错误" . ($attempts-1) . "次",
                'status' => 0,
            ];
            $user->login_history()->create($login_params);
            $this->alarm_sms($user->name, $user->phone, $user->sf_group_id);
        }
    }
}
