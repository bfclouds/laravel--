<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //这个人的文章列表,qian 10
        $posts =  $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //这个人关注的用户，包含关注用户的 关注/粉丝/文章shu
        $stars = $user-> stars;
        $susers = User::whereIn('id',$stars->pluck("star_id"))->withCount(['stars','fans','posts'])->get();
        //这个人的粉丝用户，包含粉丝用户的 关注/粉丝/文章shu
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck("fan_id"))->withCount(['stars','fans','posts'])->get();

        return view('user/show',compact('user','posts','fusers','susers'));
    }

    //关注用户
    public function fan(User $user)
    {
        //当前用户关注这个用户
        $me = Auth::user();//获取当前用户
        $me->doFun($user->id);
        return [
            "error"=>0,
            "msg"=>"关注操作失败"
        ];
    }

    //取消关注
    public function unFan(User $user)
    {
        $me = Auth::user();//获取当前用户
        $me->doUnFun($user->id);
        return [
            "error"=>1,
            "msg"=>"取消关注操作失败"
        ];
    }

    //
}