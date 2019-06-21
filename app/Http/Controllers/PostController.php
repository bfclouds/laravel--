<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    //列表
    public function index() {
//        $app = app();//用app函数获取容器
//        $log = $app->make("log");//从容器中获取日志类
//        $log->info("post_index",['data'=>'this is post index']);
        \Log::info("post_index",['data'=>'this is post index']); // 门脸类
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->with(['user'])->paginate(6);
        return view('post/index',compact("posts"));//compact创建一个$posts值的数组,传递给视图:index
    }
    //详情页面
    public function show(Post $post) {
        return view('post/show',compact("post"));
    }
    //创建文章
    public function create() {
        return view('post/create');
    }
    //创建逻辑
    public function store() {

        //$post = Post::create(htmlentities(request(['title','content'])));
        //验证逻辑
        $this->validate(request(),[
            'title' => 'required|string|max:30|min:2',
            'content' => 'required|string|min:10'
        ] );
        //逻辑
        //$params = ['title'=>request('title'),'content'=> strip_tags(str_replace("&nbsp;","",htmlspecialchars_decode(request('content'))))];//html_entity_decode将富文本的html标签过滤掉
        $user_id = Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        Post::create($params);
        //渲染
        return redirect('/posts');
    }
    //编辑逻辑
    public function edit(Post $post) {
        return view('post/edit',compact("post"));
    }
    //编辑逻辑
    public function update(Post $post) {
        //验证
        $this->validate(request(),[
            'title' => 'required|String|max:30|min:5',
            'content' => 'required|min:10'
        ]);
        $this->authorize('update', $post);//用户授权
        //逻辑
        $post->title = request("title");
        //$post->content = strip_tags(str_replace("&nbsp;","",htmlspecialchars_decode(request('content'))));
        $post->content = request('content');
        $post->save();
        //渲染
        return redirect("posts/{$post->id}");

    }
    //删除逻辑
    public function delete(Post $post) {
        //用户权限验证
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/posts');
    }

    //图片上传
    public function imageUplode(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));//获取
        return asset('storage/'.$path);
    }

    public function comment(Post $post) {
        $this->validate(request(),[
            'post_id'=>'required|exists:posts,id',
            'content'=>'required|min:10',
        ]);
        $user_id = \Auth::id();
        $params = array_merge(\request(['post_id','content']),compact('user_id'));
        Comment::create($params);
        //xuan ran
        return back();
    }

    public function zan(Post $post){
        $params = [
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ];
        Zan::firstOrCreate($params);//是否赞guo，没有则赞
        return back();
    }
    //取消赞
    public function unzan(Post $post) {
        $post->zan(Auth::id())->delete();
        return back();
    }

}

























