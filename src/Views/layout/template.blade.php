<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>

        <div class="busca">
            {!! $busca !!}
        </div>

        <div class="menu">
            {!! $menu !!}
        </div>

        <div class="info">
            {!! $info !!}
        </div>

        <div class="container">
            @yield('content')
        </div>

         @yield('post-script', '')
    </body>
</html>
