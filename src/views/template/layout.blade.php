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

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {!! \BW\Admin\Helpers\Html::buildStyles() !!}

    <!-- Custom Template head -->
    @yield('style', '')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url(config('bw.url')) }}">{{ config('bw.titulo') }}</a>
            </div>
            <!-- /.navbar-header -->

            @include('BW::composers.info')

            @include('BW::composers.menu')

        <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="content" class="col-lg-12">
                        @yield('content')
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/sb-admin/dist/js/sb-admin-2.js') }}"></script>

    {!! \BW\Admin\Helpers\Html::buildJavaScripts() !!}

    <!-- Custom Template JavaScript -->
    @yield('scripts', '')
</body>

</html>
