<?php

namespace BW\Providers;

use App;
use View;
use Config;
use BW\Core\Router as CoreRouter;
use BW\Core\Config as CoreConfig;
use BW\Core\Assets as CoreAssets;
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
        $this->registerAssets();
        $this->registerServiceProviders();
    }

    public function map(Router $router)
    {
        $router->group(['prefix' => Config::get('bw.admin.url')], function ($router) {

            // carega rotas
            foreach (CoreRouter::getAll() as $file) {
                require $file;
            }

            // carrega rotas do admin
            require __DIR__ . '/../Routes/admin.php';
        });
    }

    private function registerConfig(){
        CoreConfig::register('bw.admin',  __DIR__ . '/../Config');
    }

    private function registerView(){
        View::addNamespace('BW\Admin', __DIR__ . '/../Views');
    }

    private function registerAssets(){
        CoreAssets::register('sb-admin', __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8');
    }

    private function registerServiceProviders(){
        App::register('BW\Util\Assets\AssetsServiceProvider');
    }
}
