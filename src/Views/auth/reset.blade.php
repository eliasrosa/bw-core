<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('bw.admin.titulo') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url(config('bw.admin.url')) }}/assets/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url(config('bw.admin.url')) }}/assets/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="{{ url(config('bw.admin.url')) }}/assets/login/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url(config('bw.admin.url')) }}/assets/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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

                <img class="img-responsive logo" src="{{ url(config('bw.admin.url')) }}/assets/login/logo.jpg">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trocando sua senha</h3>
                    </div>
                    <div class="panel-body">

                        @if ($token)

                            <form role="form" method="POST" action="{{ url(config('bw.admin.url')) }}/password/reset">
                                {!! csrf_field() !!}
                                <input name="token" type="hidden" value="{{ $token }}">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <fieldset>

                                    <div class="form-group">
                                        <input class="form-control" placeholder="Nova senha" name="password" type="password" value="" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirme sua senha" name="password_confirmation" type="password" value="">
                                    </div>

                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Atualizar senha">
                                </fieldset>
                            </form>

                        @else

                            <div class="alert alert-danger alert-dismissable">
                                <p>Token inválido!</p>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url(config('bw.admin.url')) }}/assets/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url(config('bw.admin.url')) }}/assets/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>