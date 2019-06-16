<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //个人设置页面
    public function setting() {
        return view('user/seeting');
    }

    //个人设置行为
    public function settingStore() {

    }

    //个人中心页面
    public function show(User $user) {
        //这个人的信息，包含关注/粉丝/文章shu
        $user = User::withCount();
        //这个人的文章列表,qian 10

        //这个人关注的用户，包含关注用户的 关注/粉丝/文章shu

        //这个人的粉丝用户，包含粉丝用户的 关注/粉丝/文章shu

        return view('user/show',compact(['posts','user','fans','stars']));
    }

    //关注用户
    public function fan(User $user)
    {
        User::dofun($user->id);
    }

    //取消关注
    public function unFan()
    {

    }

    //
}