<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ $site_title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">

        <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>

        <link href="{{ asset('assets/css/bootstrap-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/themes/default/style.css') }}" rel="stylesheet">

    </head>

    <body>

        <div class="container-narrow">

            <div class="masthead">
                <ul class="nav nav-pills pull-right">
                    <li><a href="{{ url() }}">Home</a></li>
                    <li><a href="{{ url('page/sample-page') }}">Sample Page</a></li>
                </ul>
                <h3 class="muted">{{ $site_title }}</h3>
            </div>

            @yield('content')

            <hr>

            <div class="footer">
                <p style="font-style: italic; text-align: center;">Blog powered by <a href="https://github.com/jesseterry/croissant">Croissant</a></p>
            </div>

        </div>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>

    </body>
</html>
