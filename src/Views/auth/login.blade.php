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
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" method="POST" action="">
                            {!! csrf_field() !!}

                            @if (session('mensagem'))
                                <div class="alert alert-{{ session('mensagem_tipo', 'danger') }} alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('mensagem') }}
                                </div>
                            @endif

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email', Cookie::get('bw_login_remember')) }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="1"{{ Cookie::has('bw_login_remember') ? ' checked' : '' }}>Lembrar e-mail
                                    </label>
                                </div>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Entrar">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="remember">
                    <a class="link" href="remember">Esqueci minha senha</a>
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
