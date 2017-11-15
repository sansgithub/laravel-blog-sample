@extends('layouts.app')
@section('main-content')
<div class="container">
    <div class="row">
        @section('sidebar')
            @include('layouts.sidebar')
        @endsection
        @if (session('message'))
           <div class="alert alert-success col-md-4 col-md-offset-4">
                {{ session('message') }}
            </div>
@endif
        <div class="col-md-8">
        
        @foreach($posts as $post)
                <article class="post-div well" id="post-div-{{ $post->id }}" data-postid="{{ $post->id }}">
                    <h2>{{ $post->post_title }}</h2>
                    <p>{{ $post->post_details }}</p>
                    <div class="info">
                        Posted by {{ $post->id }} on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <span><i class="fa fa-comment"></i></span> <a href="#" class="comment">Comment</a>
                        <form id="show" class="hide">
                            <div class="form-group">
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </article>
        @endforeach
        
        </div>
    </div>
</div>
@endsection
