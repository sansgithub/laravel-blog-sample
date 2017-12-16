@extends('layouts.frontview.master')
@section('main-content')
    <div class="container content-container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-6 col-md-offset-4">
                    <article class="post-div well" id="post-div-{{ $post->id }}" data-postid="{{ $post->id }}">
                    <h2>{{ $post->post_title }}</h2>
                    <p align="justify">{{ Str::words($post->post_details, 30,'....') }}</p>
                    <div class="info">
                        - {{ $post->user->name }}
                    </div>   
                    <a href="/post/{{ $post->slug }}">Read more...</a>
                    </article>
                </div><!--div .col end-->
            </div><!--dic .row end-->
        @endforeach
    </div><!--div .container end-->
@endsection
