<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('bw.titulo') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('/packages/eliasrosa/bw-core/login/style.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

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

    <!-- jQuery -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>

</html>
