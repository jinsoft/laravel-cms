<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\Lib\PhoneSMSCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterNotify
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
     * @param  RegisterEvent $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        $user = $event->user;
        $array_email = explode(',', env('REGISTER_MAIL', ''));
        $array_phone = explode(',', env('REGISTER_PHONE', ''));
        if (env('APP_ENV') != 'test') {//测试环境不发
            //注册完发送邮件通知
            //注册完发送短信通知
            if (env('REGISTER_PHONE', '')) {
                PhoneSMSCode::send_mobile_message(trans('register.sms_notify'),
                    ['name' => $user->name, 'phone' => $user->phone]);
            }
        }
    }
}
