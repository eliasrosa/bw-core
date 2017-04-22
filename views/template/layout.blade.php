<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        <meta name="googlebot" content="noindex">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('bw.titulo') }}</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/font-awesome-4.6.3/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/packages/eliasrosa/bw-core/vendor/DataTables-1.10.12/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/packages/eliasrosa/bw-core/template/layout.css') }}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom Template head -->
        {!! \BW\Helpers\Html::buildStyles() !!}
        @yield('style', '')
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-toggle" id="btn-slidemenu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="navbar-brand" href="{{ url(config('bw.url')) }}">{{ config('bw.titulo') }}</a>
                </div>

                @include('BW::composers.info')
            </nav>

             <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">Menu principal<span class="glyphicon glyphicon-chevron-left"></span></a>
                    </li>
                    @include('BW::composers.menu')
                </ul>
            </div>

            <!-- Page Content -->
            <div id="page-wrapper">
                @yield('content')
            </div>
        </div>

        <!-- JavaScript Template -->
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/jquery/jquery-3.1.0.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/template/config.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/metisMenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/DataTables-1.10.12/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/vendor/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/template/layout.js') }}"></script>
        <script src="{{ asset('/packages/eliasrosa/bw-core/util/helpers.js') }}"></script>

        <!-- Custom Template JavaScript -->
        {!! \BW\Helpers\Html::buildJavaScripts() !!}
        @yield('script', '')

    </body>
</html>
