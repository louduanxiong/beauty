<link rel="stylesheet" href="{{asset('css/github-markdown.css')}}">
<style>
.author{
    margin: 30px 0 40px;
}
.author .avatar {
    width: 48px;
    height: 48px;
    display: inline-block;
}
.avatar img {
    width: 100%;
    height: 100%;
    border: 1px solid #ddd;
    border-radius: 50%;
}
.author .info {
    vertical-align: middle;
    display: inline-block;
    margin-left: 8px;
}
.author .name {
    margin-right: 3px;
    font-size: 16px;
    vertical-align: middle;
}
.author .meta {
    font-family: -apple-system,SF UI Text,Arial,PingFang SC,Hiragino Sans GB,Microsoft YaHei,WenQuanYi Micro Hei,sans-serif;
    margin-top: 5px;
    font-size: 12px;
    color: #969696;
}
.author .info img.badge-icon {
    margin-right: 5px;
    width: 20px;
    height: 20px;
    border-radius: 0;
    border: 0;
}
.follow {
        border-color: #42c02e!important;
        padding: 0 7px 0 5px!important;
        font-size: 12px!important;
        color: #fff!important;
        border-radius: 40px!important;
}
.follow-detail{
    padding: 20px;
    background-color: #F4F9FF;
    border: 1px solid #e1e1e1;
    border-radius: 4px;
    font-size: 12px;
}
.signature{
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e1e1e1;
    color: #969696;
    /*overflow: hidden;*/
    /*text-overflow: ellipsis;*/
    /*white-space: nowrap;*/
}
    .content{
        min-height: 500px;
    }
    .content img{
        max-width:100%;
    }
</style>
@extends('layouts.app')
@section('title', $article->title)
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1>{{$article->title}}</h1>
        <div class="author">
            <a class="avatar" href="/u/802c88dbbc05">
                <img src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80" alt="96">
            </a>
            <div class="info">
                <span class="name"><a href="/u/802c88dbbc05">{{$article->user->name}}</a></span>
                <!-- 关注用户按钮 -->
                <a class="btn btn-success follow"><i class="iconfont ic-follow"></i><span>关注</span></a>
                <!-- 文章数据信息 -->
                <div class="meta">
                    <!-- 如果文章更新时间大于发布时间，那么使用 tooltip 显示更新时间 -->
                    <span class="publish-time">{{$article->post_at}}</span>
                    <span class="wordage hidden-xs">字数 {{intval(strlen($article->content)/3)}}</span>
                    <span class="views-count ">阅读 {{$article->hits}}</span>
                    <span class="comments-count ">评论 33</span>
                    <span class="likes-count hidden-xs">喜欢 175</span>
                    <span class="rewards-count hidden-xs">赞赏 1</span>
                </div>
            </div>
            <!-- 如果是当前作者，加入编辑按钮 -->
            @if($article->author_id==session('userId'))
                <a href="/article/edit/{{$article->id}}" class="btn btn-success" style="margin-left: 10%;display: inline;">
                    编辑
                </a>
            @endif
        </div>
        <div id="content" class="content markdown-body">
            <?php echo $article->content ?>
        </div>
        <div class="author follow-detail">
            <div class="info">
                <a class="avatar" href="/u/802c88dbbc05">
                    <img src="//upload.jianshu.io/users/upload_avatars/1931381/71a4c916-0559-4bcc-8153-8ba87c751110.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96" alt="96">
                </a>
                <a class="title" href="/u/802c88dbbc05">{{$article->user->name}}</a>
                <span class="meta">写了 337295 字，被 15281 人关注，获得了 16785 个喜欢</span>
            </div>
            <div class="signature">
                音乐是怎样也戒不掉的毒药，那不如就一起在旋律中一醉方休。
            </div>
        </div>
        {{--评论模块--}}
        @if(session('user'))
        <comment></comment>
        @else
            <div style="text-align: center;">
                <a href="/login" class="btn btn-primary">登录</a>
                登录后可评论
            </div>
        @endif
        {{--评论--}}
        <comments></comments>

    </div>
    <div class="col-md-2"></div>

</div>
@endsection