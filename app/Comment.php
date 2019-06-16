<?php

namespace App;

use App\Model;
//use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //no and more
    //fan xiang guan lian
    public function post()
    {
        return $this->belongsTo('App\Post')->orderBy('created_at','desc');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
