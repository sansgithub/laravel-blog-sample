@extends('layouts.frontview.master')
@section('main-content')
    <div class="container content-container">  
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-6 col-md-offset-4">
                <article class="post-div well" id="post-div-{{ $post->id }}">
                <h2>{{ $post->post_title }}</h2>
                <p align="justify">{!! nl2br(e($post->post_details)) !!}</p>
                        
                     <div class="info">
                        Posted by {{ $post->user->name }} on {{$post->created_at}}
                    </div> 

                    <div id="comments"> 
                    @foreach($post->comments as $comment)
                    <div class="comment">
                    <strong>                  
                        {{ $comment->user->name }}
                        </strong> commented</br>
                        <p>{{ $comment->comment_details }}</p>
                        </div>
                    @endforeach
                    </div><!--div #comments end-->
                </article>
            </div><!--div .col end-->
        </div><!--div .row end-->
    </div><!--div .container end-->
@endsection               
            