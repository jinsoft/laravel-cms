<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/9/12 23:57
 */

namespace App\Helpers;

class TokenHelper
{

    public static $tokenExpire = 3600 * 24;


    public static function set($token, $value)
    {
        $tokenKey = 'token:' . $token;
        $redis = app('redis');
        return $redis->set($tokenKey, json_encode($value), 'ex', self::$tokenExpire);
    }

    public static function get($token)
    {
        $tokenKey = 'token:' . $token;
        $redis = app('redis');
        $redisRawContent = $redis->get($tokenKey);
        if (empty($redisRawContent)) {
            return null;
        }
        return json_decode($redisRawContent, true);
    }
}