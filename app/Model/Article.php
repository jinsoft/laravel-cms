<?php

namespace App\Models;

use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['user_id', 'category_id', 'title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

}
