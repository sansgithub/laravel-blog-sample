@extends('layouts.backview.master')
@section('main-content')
<div class="container">
    <div class="row">
        @if (session('message'))
           <div class="alert alert-success col-md-4 col-md-offset-4 message">
                <button type="button" class="close" data-dismiss="alert"><span><i class="fa fa-close"></i></span></button>
                {{ session('message') }}
            </div>
        @endif
        <div class="col-md-8 col-md-offset-1 col-lg-8 col-lg-offset-1">
            {{ csrf_field() }}
            @if(count($posts) == 0)
                <p class="text-success text-sm">Posting for first time? </br><a href="/post/create" class="btn btn-success btn-xs">Post</a></p>
            @endif
        @foreach($posts as $post)
                <article class="post-div well" id="post-div-{{ $post->id }}" data-postid="{{ $post->id }}">
                    <h2>{{ $post->post_title }}</h2>
                    <p align="justify">{{ $post->post_details }}</p>
                        <div class="info">
                            Posted by {{ $post->user->name }} on {{$post->created_at}}
                        </div>
                    <div class="interaction">
                        <span><i class="fa fa-edit"></i></span> <a href="#" class="edit">Edit</a> |
                        <span><i class="fa fa-trash"></i></span> <a href='#' class="delete">
                    Delete</a> |
                        <span><i class="fa fa-comment"></i></span> <a href="#" class="comment">Comment</a>
                        <form id="show-{{ $post->id}}" class="hide">
                        <div class="form-group">
                            <textarea id="comment_details" class="form-control" name="comment_details" rows="3"></textarea></br>
                            <button type="button" class="btn btn-success" onclick="postComment()">Post Comment</button>
                        </div>
                            <input type="hidden" id="token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                    <div id="comments"> 
                    @foreach($comments as $comment)
                        @if($comment->post_id == $post->id)
                            <strong>
                            
                            {{ $comment->user->name }}
                            
                            </strong> commented</br>
                            <p>{{ $comment->comment_details }}</p>
                        @endif
                    @endforeach
                    </div>
                </article>
        @endforeach
        </div>
    </div>
</div>

<!--Add/Edit Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="Post Insert" id="post-insert-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <form>
        {{ csrf_field() }}
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input autofocus type="text" name ="post_title" class="form-control" id="post_title">
            </div>
            <div class="form-group">
                <label for="post_details">Post Details</label>
                <textarea class="form-control" name="post_details" rows="5" id="post_details"></textarea>
            </div>
            {!! method_field('PUT') !!}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modal-save">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!--Add/Edit Modal end-->

<!--Delete Modal-->
<div class="modal fade" id="delete-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
                <form>
                {{ csrf_field() }}
                    <div class="form-group">
                    <label for="delete-post_title">Post Title</label>
                    <input type="name" name ="delete-post_title" class="form-control" id="delete-post_title" disabled>
                    </div>    
                {!! method_field('DELETE') !!}    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="modal-delete">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
