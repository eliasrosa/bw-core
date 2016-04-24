<?php

namespace BW\Admin;

use Illuminate\Routing\Router;
use BW\Admin\Router\Router as BwRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class BwCoreServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        //
        parent::boot($router);

        // publish config
        $this->publishes([__DIR__ . '/../config/bw.php' => config_path('/bw.php')], 'config');

        // publish public
        $this->publishes([ __DIR__ . '/../public' => public_path('packages/eliasrosa/bw-core')], 'public');

        //
        $this->publishes([ __DIR__ . '/../lang' => base_path('resources/lang')]);

        // publish migrations
        $this->publishes([
              __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    public function register()
    {
        //
        \View::addNamespace('BW', __DIR__ . '/../views');

        //
        $this->app->register('BW\Admin\Providers\ComposerServiceProvider');
        $this->app->register('BW\Admin\Providers\AuthServiceProvider');
        $this->app->register('BW\Admin\Providers\DataGridServiceProvider');
        $this->app->register('BW\Admin\Providers\FlashServiceProvider');

    }

    public function map(Router $router)
    {
        $router->group(BwRouter::getParameters('guest'), function (Router $router) {
            require __DIR__ . '/../routes/login.php';
        });

        $router->group(BwRouter::getParameters('default'), function (Router $router) {
            require __DIR__ . '/../routes/usuarios.php';
            require __DIR__ . '/../routes/admin.php';
        });
    }
}
