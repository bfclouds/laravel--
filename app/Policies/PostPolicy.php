<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判断用户是否可以创建请求。
     *
     * @param  \App\User  $user
     * @return bool
     * 不包含模型方法
     *
     */
    public function create(User $user)
    {
        //
    }
}
