<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册界面
    public function index() {
        return view('register.register');
    }
    //注册行为
    public function register() {
    //validation
        $this->validate(request(),[
            'name'=>'required|unique:users,name|min:4|max:10',
            'email'=>'email|unique:users,email|required|',
            'password'=>'required|min:4|max:20',
        ]);
        //logic
        $name = request("name");
        $email = request("email");
        $password =bcrypt(request("password")) ;
        $user = User::create(compact('name','email','password'));
        //Apply colours to a drawing渲染
        return redirect("/login");
    }

}
