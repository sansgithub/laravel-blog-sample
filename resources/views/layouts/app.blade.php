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
                                    {{ Auth::user()->name }} <span class="caret"></span>
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
    <script>
        var token = '{{ Session::token() }}';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        if(token == CSRF_TOKEN){
            console.log(true);
        }
        var urlEdit = "{{ route('qedit') }}";
        console.log(urlEdit);
        $('.post-div').find('.interaction').find('.edit').on('click',function(event){
            event.preventDefault();
            postTitleElement=event.target.parentNode.parentNode.childNodes[0];
            console.log(postTitleElement);
            postDetailElement=event.target.parentNode.parentNode.childNodes[2];
            console.log(postDetailElement);
            var postTitle = postTitleElement.textContent;
            console.log(postTitle);
            var postDetail = postDetailElement.textContent;
            console.log(postDetail);
            postId = event.target.parentNode.parentNode.dataset['postid'];
            $('#post_title').val(postTitle);
            console.log($('#post_title').val(postTitle));
            $('#post_details').val(postDetail);
            console.log($('#post_details').val(postDetail));
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
                         console.log($(postTitleElement).text(msg['new_title']));
                         $(postDetailElement).text(msg['new_details']);
                         $('#post-insert-modal').modal('hide');
                    });
        });
    </script>
    </body>
</html>
