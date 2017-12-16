@extends('layouts.frontview.master')
@section('main-content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-6 col-md-offset-4">
                    <article class="post-div well" id="post-div-{{ $post->id }}" data-postid="{{ $post->id }}">
                    <h2><a href="/post/{{ $post->slug }}">{{ $post->post_title }}</a></h2>
                    <p align="justify">{{ Str::words($post->post_details, 30,'....') }}</p>
                    <div class="info">
                        Posted by {{ $post->user->name }} on {{$post->created_at}}
                    </div>                    
                    
                    <div id="comments"> 
                    @foreach($comments as $comment)
                        @if($comment->post_id == $post->id)
                            <strong>                            
                                {{ $comment->user->name }}
                            </strong>commented</br>
                            <p>{{ $comment->comment_details }}</p>
                        @endif
                    @endforeach
                    </div><!--div #comments end-->

                    </article>
                </div><!--div .col end-->
            </div><!--dic .row end-->
        @endforeach
    </div><!--div .container end-->
@endsection
