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
                <div class="post">
                <strong><u>{{ $post->post_title }}</u></strong>
                <p>{{ $post->post_details }}</p>
                <!--<div class="pull-right">-->
                    <a href="" data-toggle="modal" data-target="#edit-modal">Edit</a> |
                    <div>
        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <input type="submit" value="Delete">
        </form>
    </div>|
                    <a href="">Comment</a>
                </div>
           
        @endforeach
        
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="post-body">Edit the Post</label>
                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

@endsection
