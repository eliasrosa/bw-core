<?php

namespace BW\Providers;

use Illuminate\Routing\Router;
use BW\Router\Router as BwRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class BwCoreServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        //
        parent::boot($router);

        // publish config
        $this->publishes([__DIR__ . '/../../config/bw.php' => config_path('/bw.php')], 'config');
        $this->publishes([__DIR__ . '/../../config/auth.php' => config_path('auth.php')], 'config');
        $this->publishes([__DIR__ . '/../../public' => public_path('packages/eliasrosa/bw-core')], 'public');
        $this->publishes([__DIR__ . '/../../lang' => base_path('resources/lang')]);
        $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], 'migrations');

        //
        $router->middleware('bw.auth', \BW\Middleware\Authenticate::class);
        $router->middleware('bw.csrf', \BW\Middleware\VerifyCsrfToken::class);
        $router->middleware('bw.aclroutes', \BW\Middleware\AclRoutes::class);
    }

    public function register()
    {
        //
        \View::addNamespace('BW', __DIR__ . '/../../views');

        //
        $this->app->register('BW\Providers\CommandServiceProvider');
        $this->app->register('BW\Providers\ComposerServiceProvider');
        $this->app->register('BW\Providers\DataGridServiceProvider');
        $this->app->register('BW\Providers\FlashServiceProvider');

        //
        \App::bind('Illuminate\Routing\ResourceRegistrar', function ()
        {
            return \App::make('BW\Providers\ResourceNoPrefixRegistrar');
        });
    }

    public function map(Router $router)
    {
        $router->group(BwRouter::getParameters('guest'), function (Router $router) {
            require __DIR__ . '/../../routes/login.php';
        });

        $router->group(BwRouter::getParameters('default'), function (Router $router) {
            require __DIR__ . '/../../routes/admin.php';
        });
    }
}
