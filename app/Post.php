<?php

namespace App;

use Laravel\Scout\Searchable;
use App\Model;

//若不写则对应posts表，否则:protected $table = 'your_table_name';
class Post extends Model
{
    /**
     * 获取帖子的作者。关联
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    /**
     * 获取博客文章的评论
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
     * 和用户进行关联
     */
    public function zan($user_id) {
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }
    /**
     * 获取所有赞
     */
    public function zans() {
        return $this->hasMany('App\Zan');
    }

}
