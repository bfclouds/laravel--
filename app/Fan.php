<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    //粉丝用户
    public function fuser() {
        return $this->hasOne('App\User');
    }
    //明星用户
    public function suser() {
        return $this->hasOne('App\User','id','star_id');
    }

}
