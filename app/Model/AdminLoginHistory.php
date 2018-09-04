<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminLoginHistory extends Model
{
    //
    protected $fillable = [
        'ip', 'platform', 'uuid', 'msg', 'status', 'admin_id', 'user_name'
    ];

    protected $hidden = [
        'platform', 'admin_id', 'updated_at', 'id', 'uuid'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Model\Admin');
    }
}
