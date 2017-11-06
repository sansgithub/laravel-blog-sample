@extends('layouts.app')

@section('main-content')   
    @section('sidebar')
        @include('layouts.sidebar')
    @endsection
    
    <div class="col-md-6 col-md-offset-2">
    <h1>Create a post</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="/post">
      <div class="form-group">
        <label for="post_title">Post Title:</label>
        <input type="text" name ="post_title" class="form-control" id="post_title">
      </div>
      <div class="form-group">
        <label for="post_details">Post:</label>
        <textarea class="form-control" name="post_details" rows="5" id="post_details"></textarea>
      </div>
      <input type="submit" class="btn btn-primary">
      <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
    </div>
@endsection