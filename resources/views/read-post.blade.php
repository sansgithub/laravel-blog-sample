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
                <div>
                <strong><u>{{ $post->post_title }}</u></strong>
                <p>{{ $post->post_details }}</p>
                <!--<div class="pull-right">-->
                    <a href="">Comment</a>
                </div>
            
        @endforeach
        
        </div>
    </div>
</div>
@endsection
