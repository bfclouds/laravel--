@if(\Illuminate\Support\Facades\Auth::id() != $target_user->id)
<div>
    @if(\Illuminate\Support\Facades\Auth::user()->hasStar($target_user->id))
        <!--已关注了like-value为1-->
    <button class="btn btn-default like-button" like-value="1" like-user="{{$target_user->id}}" type="button">取消关注</button>
    @else
        <!--未关注like-value为0-->
    <button class="btn btn-default like-button" like-value="0" like-user="{{$target_user->id}}" type="button">关注</button>
    @endif
</div>
@endif