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
                <div class="post-div">
                <strong><u>{{ $post->post_title }}</u></strong>
                <p>{{ $post->post_details }}</p>
                    <div class="info">
                        Posted by on {{$post->created_at}}
                    </div>
                <!--<div class="pull-right">-->
                    <a href="" id="edit-modal" data-toggle="modal" data-target="#post-insert-modal">Edit</a> |

                    <a href="{{'#'}}" data-toggle="modal" data-target="#myModal" class="delete-model" data-id="{{ $post->id }}">
                    Delete</a> |
                    <a href="">Comment</a>
                </div>
           
        @endforeach
        
        </div>
    </div>
</div>
<div class="modal fade"  role="dialog" aria-labelledby="Post Insert" id="post-insert-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="inputName">Name</label>
                <input autofocus type="text" name="fname" class="form-control" id="inputName">
            </div>
            <div class="form-group">
                <label for="post-body">Post Details</label>
                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="modal-save"></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
            </div>
            <form method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="delete_dividend" value="foo">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
