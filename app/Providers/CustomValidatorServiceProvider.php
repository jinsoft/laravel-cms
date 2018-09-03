<?php
/**
 * Created by PhpStorm.
 * User: xiaojin
 * Email: job@ainiok.com
 * Date: 2018/9/3 23:53
 */

use Illuminate\Support\ServiceProvider;
use Validator;

class CustomValidatorServiceProvider extends ServiceProvider
{
    const SAFE_CHARTERS_REG = '/[\\\">()=?#|\'&;%<\/!\+`\$\*]/';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 匹配URL
        Validator::extend('link', function ($attribute, $value, $parameters, $validator) {
            return filter_var($value, FILTER_VALIDATE_URL);
        });
        Validator::replacer('link', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':attribute'], $attribute, $message);
        });
        // 安全邮箱验证
        Validator::extend('safe_email', function ($attribute, $value, $parameters, $validator) {
            return !preg_match(self::SAFE_CHARTERS_REG, $value);
        });
        Validator::replacer('safe_email', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':attribute'], $attribute, $message);
        });
        //图片后缀名合法性
        Validator::extend('image_extension', function ($attribute, $value, $parameters) {
            return in_array(strtolower($value->getClientOriginalExtension()), $parameters);
        });
        Validator::replacer('image_extension', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':attribute', ':extensions'], [$attribute, join(',', $parameters)], $message);
        });
        //电话号码校验
        Validator::extend('telephone', function ($attribute, $value, $parameters) {
            return preg_match('/^((1[36789][0-9]|15[012356789]|14[57]|100)[0-9]{8})$|^(\d{7,8}|\d{3,4}-\d{7,8}|\d{3,4}-\d{7,8}-\d{1,4}|\d{7,8}-\d{1,4})$/', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}