<?php

namespace BW\Util\DataGrid;

use View;
use BW\Core\Assets as Assets;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class DataGridServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register views
        View::addNamespace('BW\Util\DataGrid', __DIR__ . '/Views');

        // Register os assets
        Assets::register('packages/zofe/rapyd/assets',
            base_path('vendor/zofe/rapyd/public/assets'), 'guest');

        // Register service provider
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');
    }

    //
    public function map(){}
}
