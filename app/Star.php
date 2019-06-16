<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    //
    public function suser() {
        return $this->hasOne('App\User','id','fan_id');
    }
}
