<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    protected $fillable = [
        'ip', 'platform', 'device', 'msg', 'status', 'user_id', 'user_name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'platform', 'device', 'user_id', 'updated_at', 'id'
    ];

    protected static function boot()
    {
        parent::boot();
        self::saved(function (self $loginHistory){
            $loginHistory->user()->update(['login_at'=>$loginHistory->created_at]);
        });
    }
}
