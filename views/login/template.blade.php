<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">

        <title>{{ config('bw.titulo') }} / Login</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/packages/eliasrosa/bw-core/login/style.css') }}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 ">
                    <img class="img-responsive logo" src="{{ asset('/packages/eliasrosa/bw-core/login/logo.jpg') }}">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- JavaScript Template -->
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/jquery/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

    </body>
</html>
