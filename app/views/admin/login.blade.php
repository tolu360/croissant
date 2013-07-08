<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Croissant</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }

        </style>
        
        <script src="{{ asset('assets/js/jquery-2.0.2.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        
        <script type="text/javascript">
            $().ready(function() {
                $('#username').focus();
            });
        </script>
    
    </head>

    <body>

        <div class="container">

            <form method="post" class="form-signin">
                <input type="text" name="username" class="input-block-level" id="username" placeholder="Username">
                <input type="password" name="password" class="input-block-level" placeholder="Password">
                <label class="checkbox">
                    <input type="checkbox" name="remember_me" value="1"> Remember me
                </label>
                <button class="btn btn-primary" type="submit">Sign in</button>
            </form>

        </div>

    </body>
</html>