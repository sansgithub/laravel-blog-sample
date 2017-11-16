<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .fa-plus{
            color: #4cae4c;
        }
        .fa-book{
            color: #b6a338;
        }
        .fa-male{
            color: #f7e1b5;
        }
        #side-bar{
            background-color: transparent;
            height: 250px;
        }
        #side-bar li {
            height:50px;
        }
        #side-bar li a{
            margin-top: 0;
            background-color: black;
            color: whitesmoke;
            display: block;
            padding: 10px 10px 10px 10px;
        }
        #show{
            margin-top : 15px;
            margin-left : 50px;
            width : 450px;
        }
        ul li{
            list-style: none;
        }
        a {
            text-decoration: none !important;
            color: darkorange;
        }
        a:hover{
            color : darkgreen;
            font-size: 16px;
        }
        body{
            background-color: transparent;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'QBlog') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span><i class="fa fa-user"></i></span> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        

        @yield('sidebar')
        @yield('main-content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        var token = '{{ Session::token() }}';
        var urlEdit = "{{ route('qedit') }}";

        $('.post-div').find('.interaction').find('.edit').on('click',function(event){
            event.preventDefault();
            postTitleElement=event.target.parentNode.parentNode.childNodes[0];
            postDetailElement=event.target.parentNode.parentNode.childNodes[2];
            var postTitle = postTitleElement.textContent;
            var postDetail = postDetailElement.textContent;
            postId = event.target.parentNode.parentNode.dataset['postid'];
            $('#post_title').val(postTitle);
            $('#post_details').val(postDetail);
            $('#post-insert-modal').modal();
        });

        $('#modal-save').on('click', function () {
            $.ajax({
                        method : 'POST',
                        url: urlEdit, 
                        data: {
                            postTitle : $('#post_title').val(),
                            postDetail : $('#post_details').val(),
                            postId : postId,
                            _token : token
                        }
                    })
                    .done(function (msg) {
                         $(postTitleElement).text(msg['new_title']);
                         $(postDetailElement).text(msg['new_details']);
                         $('#post-insert-modal').modal('hide');
                         toastr.success('Successfully edited Post!', 'Success Alert', {timeOut: 5000});
                    });
        });


        $('.post-div').find('.interaction').find('.delete').on('click',function(event){

            event.preventDefault();
            deletePostId = event.target.parentNode.parentNode.dataset['postid']; 
            var postTitleElement = event.target.parentNode.parentNode.childNodes[0];
            var postTitle = postTitleElement.textContent;
            $('#delete-post_title').val(postTitle);     
            $('#delete-modal').modal();
        });

        $('.modal-footer').on('click','#modal-delete', function () {
            $.ajax({
                        type : 'DELETE',
                        url: 'post/' + deletePostId,
                        data: {
                            _token : token                           
                        },
                        success : function (data) { 
                            $('#delete-modal').modal('hide');
                            articleToRemove = $('#post-div-' + data['id']);
                            articleToRemove.remove();
                            hrToRemove = $('#post-hr-' + data['id']);
                            hrToRemove.remove();         
                            toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                            
                        }
                    });                    
        });

        $('.post-div').find('.interaction').find('.comment').on('click',function(event) {
            event.preventDefault();
            commentOnId = event.target.parentNode.parentNode.dataset['postid'];
            var selected = document.getElementById('show');
            if(selected.className == 'hide'){
                selected.style.display = 'block';
                selected.className = 'show';
            }else{
                selected.style.display = 'none';
                selected.className =  'hide';
            }
        });
    </script>
    </body>
</html>
