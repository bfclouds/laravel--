<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //登录页面
    public function index() {
        return view("login.login");
    }
    //login action
    public function login() {
        //验证
        $this->validate(request(),[
            'email'=>'email|required|',
            'password'=>'required|min:4|max:20',
            'id_remember' =>'integer',
        ]);
        //逻辑
        $users = \request(['email','password']);
        $is_remember = boolval(\request('is_remember'));
        if (Auth::attempt($users,$is_remember)) {
            return redirect('/posts');
        }
        //渲染
        return Redirect::back()->withErrors("error");
    }
    //loginOut action
    public function logout() {
        Auth::logout();
        return \redirect('/login');
    }
}
