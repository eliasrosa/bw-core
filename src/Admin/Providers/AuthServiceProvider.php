<?php

namespace BW\Admin\Providers;

use Illuminate\Routing\Router;
use BW\Router\Router as BwRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        parent::boot($router);

        // publish config
        $this->publishes([__DIR__ . '/../../config/auth.php' => config_path('auth.php')], 'config');

        //
        $router->middleware('bw.auth', \BW\Admin\Middleware\Authenticate::class);
        $router->middleware('bw.csrf', \BW\Admin\Middleware\VerifyCsrfToken::class);
    }

    public function map(Router $router)
    {

    }

    public function register()
    {
    }
}
