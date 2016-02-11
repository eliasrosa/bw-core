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

        //
        $router->middleware('auth', 'BW\Middleware\Authenticate');
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

        //
        // GUEST
        //
        $router->group([
            'prefix' => Config::get('bw.admin.url'),
        ], function ($router) {

            // carega rotas middleware 'guest'
            foreach (CoreRouter::getAll('guest') as $file) {
                require $file;
            }

            // auth/login
            require __DIR__ . '/../Routes/auth.php';
        });

        //
        // AUTH
        //
        $router->group([
            'prefix' => Config::get('bw.admin.url'),
            'middleware' => 'auth',
        ], function ($router) {

            // carega rotas middleware 'auth'
            foreach (CoreRouter::getAll('auth') as $file) {
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

        //
        // Login auth
        //
        CoreAssets::register('sb-admin', __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8');


        //
        // Login guest
        //
        CoreAssets::register('sb-admin/bower_components/bootstrap/dist',
            __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8/bower_components/bootstrap/dist', 'guest');

        CoreAssets::register('sb-admin/dist',
            __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8/dist', 'guest');

        CoreAssets::register('sb-admin/bower_components/font-awesome/css',
            __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8/bower_components/font-awesome/css', 'guest');

        CoreAssets::register('sb-admin/bower_components/jquery/dist',
            __DIR__ . '/../Assets/vendor/sb-admin-2-1.0.8/bower_components/jquery/dist', 'guest');
    }

    private function registerServiceProviders(){
        App::register('BW\Util\Assets\AssetsServiceProvider');
    }
}
