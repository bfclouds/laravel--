<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected  $fillable = [
      'name','email','password'
    ];

    //用户的文章列表
    public function posts() {
        return $this->hasMany('App\Post','user_id','id');
    }
    //关注我的粉丝
    public function fans() {
        //我是明星
        return $this->hasMany('App\Fan','star_id','id');
    }
    //我关注的
    public function stars() {
        //我是粉丝
        return $this->hasMany('App\Star','fan_id','id');
    }
    //我关注某人（动作）
    public function doFan($uId) {
        $fan = new Fan();
        $fan->star_id = $uId;
        return $this->stars()->save($fan);
    }
    //我取消关注某人
    public function doUnFan($uId) {
        $fan = new Fan();
        $fan->star_id = $uId;
        return $this->stars()->delete($uId);
    }
    //当前用户是否被$uId关注
    public function hasFan($uId)
    {
        return $this->fans()->where('fan_id',$uId)->count();
    }

    //当前用户是否关注了uId用户
    public function hasStar($uId)
    {
        return $this->stars()->where('star_id',$uId)->count();
    }
}
