<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/6/30 22:11
 */

return [
    'code_length' => env('PHONE_SMS_CODE_LENGTH', 6), //短信验证码的长度
    'url' => env('PHONE_SMS_URL', ''), // 短信地址
    'expire_time' => env('PHONE_SMS_CODE_EXPIRE', 60), // 短信验证码过期时间
    'send_limit' => env('PHONE_SMS_SEND_LIMIT', 10), //每个用户每天限制发送次数
];