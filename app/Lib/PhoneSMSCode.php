<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/6/30 22:09
 */

namespace App\Lib;

use App;

class PhoneSMSCode
{
    static function generate()
    {
        $num = config('php_sms_code.code_length');
        $code = '';
        for ($i = 0; $i < $num; $i++) {
            $code .= mt_rand(0, 9);
        }
        return $code;
    }

    static function send_mobile_message($message, $mobile)
    {
        if (empty($mobile)) return false;
        if (App::environment('test') || env('SMS_DEBUG', false)) return true;
        \Log::info('发送短信' . $message . '到手机' . $mobile);
        return true;
    }
}