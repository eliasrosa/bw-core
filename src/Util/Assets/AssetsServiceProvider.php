<?php

namespace BW\Util\Assets;

use BW\Core\Config as CoreConfig;
use BW\Core\Router as CoreRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        CoreConfig::register('bw.util.assets',  __DIR__ . '/config.php');

        // registra as rotas
        CoreRouter::register(__DIR__ . '/routes.php');
    }

    public function map(){}

}
