@extends('layouts.backview.master')
@section('main-content')
<div class="container content-container">
    <div class="row">

        @if (session('message'))
           <div class="alert alert-success col-md-4 col-md-offset-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">        
            @foreach($posts as $post)
                <article class="post-div well" id="post-div-{{ $post->id }}" data-postid="{{ $post->id }}">
                    <h2>{{ $post->post_title }}</h2>
                    <p align="justify">{!! nl2br(e($post->post_details)) !!}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{ date('F d, Y', strtotime($post->created_at)) }} 
                    </div>
                    <div class="interaction">
                        <span><i class="fa fa-comment"></i></span> <a href="#" class="comment">Comment</a></br>
                        <form id="show-{{ $post->id }}" class="hide">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id="comment_details"></textarea></br>
                                <button type="button" class="btn btn-success" onclick="postComment()">Post Comment</button>
                            </div>
                        </form>
                    </div>

                    <div id="comments"> 
                    @foreach($comments as $comment)
                        @if($comment->post_id == $post->id)
                        <div class="comments">
                            <strong>
                        
                            {{ $comment->user->name }}
                            
                            </strong> commented</br>
                            <p>{{ $comment->comment_details }}</p>
                            </div>
                        @endif
                    @endforeach
                    </div><!--div #comments end-->
                </article>
            @endforeach
        </div><!--div .col end-->
        
    </div><!--div .row end-->
</div><!--div .container end-->
@endsection
