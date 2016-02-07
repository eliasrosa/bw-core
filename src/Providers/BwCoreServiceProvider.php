<?php

namespace BW\Providers;

use View;
use Config;
use BW\Util\Config as UtilConfig;
use BW\Util\Assets\Assets;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class BwCoreServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        parent::boot($router);
    }

    public function register()
    {
        $this->registerConfig();
        $this->registerView();
    }

    public function map(Router $router)
    {
        $router->group(['prefix' => Config::get('bw.admin.url')], function ($router) {
            $path = __DIR__ . '/../Routes';

            // carega rota da assets
            foreach (Assets::getAll() as $name => $attr) {
                require $path . '/util/assets.php';
            }

            // carrega rotas do admin
            require $path . '/admin.php';
        });
    }

    private function registerConfig(){
        UtilConfig::register('bw.admin',  __DIR__ . '/../Config');
        UtilConfig::register('bw.util.assets',  __DIR__ . '/../Config');
    }

    private function registerView(){
        View::addNamespace('BW\Admin', __DIR__ . '/../Views');
    }
}
