<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Croissant</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/widearea.min.css') }}" rel="stylesheet">

        <script src="{{ asset('assets/js/jquery-2.0.2.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/widearea.min.js') }}"></script>

        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>

    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <a class="brand" href="{{ url('admin') }}">Croissant</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li><a href="{{ url('admin/posts') }}">Posts</a></li>
                            <li><a href="{{ url('admin/pages') }}">Pages</a></li>
                        </ul>
                    </div>

                    <ul class="nav pull-right">
                        <ul class="nav">
                            <li><a href="{{ url('admin/users') }}" title="Users"><i class="icon-user icon-white"></i></a></li>
                            <li><a href="{{ url('admin/logout') }}" title="Log Out"><i class="icon-off icon-white"></i></a></li>
                        </ul>
                    </ul>

                </div>
            </div>
        </div>

        <div class="container">

            @yield('content')

        </div>

    </body>
</html>