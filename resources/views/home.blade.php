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
            
                <hr>

                <article class="post-div" data-postid="{{ $post->id }}">
                    <h2>{{ $post->post_title }}</h2>
                    <p>{{ $post->post_details }}</p>
                        <div class="info">
                            Posted by {{ $post->user_id }} on {{$post->created_at}}
                        </div>
                    <div class="interaction">
                    <a href="#" class="edit">Edit</a> |
                    <!-- id="edit-modal" data-target="#post-insert-modal"-->

                    <a href='#' data-toggle="modal" data-target="#delete-modal" class="delete-model" data-id="{{ $post->id }}">
                    Delete</a> |

                    <a href="">Comment</a>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
