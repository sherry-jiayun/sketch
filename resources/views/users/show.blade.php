@extends('layouts.default')
@section('title', $user->name)

@section('content')
<div class="container-fluid">
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @include('shared.errors')
            <div class="panel-heading text-center">
                @include('users._user')
            </div>
        </div>
        @if((Auth::check())&&(Auth::user()->admin))
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h4><a href="{{ route('user.showrecords', $user->id) }}">管理目录</a></h4>
                </div>
                <div class="panel-body">
                   @include('admin._records')
                   @if($records->hasMorePages())
                   <div class="text-center h5">
                      <a href="{{ route('user.showrecords', $user->id) }}">全部管理记录</a>
                   </div>
                   @endif
                </div>
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showstatuses', $user->id) }}">动态目录</a></h4>
            </div>
            <div class="panel-body">
                @include('statuses._statuses')
                @if($statuses->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showstatuses', $user->id) }}">全部动态</a>
                </div>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showbooks', $user->id) }}">文章目录</a></h4>
            </div>
            <div class="panel-body">
                @include('books._books')
                @if($books->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showbooks', $user->id) }}">全部文章</a>
                </div>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showthreads', $user->id) }}">讨论帖目录</a></h4>
            </div>
            <div class="panel-body">
                @include('threads._threads')
                @if($threads->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showthreads', $user->id) }}">全部讨论帖</a>
                </div>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showlongcomments', $user->id) }}">长评目录</a></h4>
            </div>
            <div class="panel-body">
                @include('posts._posts')
                @if($posts->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showlongcomments', $user->id) }}">全部长评</a>
                </div>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showupvotes', $user->id) }}">赞赏目录</a></h4>
            </div>
            <div class="panel-body">
                @include('posts._upvotes')
                @if($upvotes->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showupvotes', $user->id) }}">全部赞赏</a>
                </div>
                @endif
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><a href="{{ route('user.showxianyus', $user->id) }}">咸鱼目录</a></h4>
            </div>
            <div class="panel-body">
                <?php $threads = $xianyus ?>
                @include('threads._threads')
                @if($xianyus->hasMorePages())
                <div class="text-center h5">
                    <a href="{{ route('user.showxianyus', $user->id) }}">全部咸鱼</a>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@stop
