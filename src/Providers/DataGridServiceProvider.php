<?php

namespace BW\Providers;

use Zofe\Rapyd\Rapyd;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Zofe\Rapyd\RapydServiceProvider;

class DataGridServiceProvider extends RapydServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $dir = base_path('vendor/zofe/rapyd/src');
        $this->loadViewsFrom($dir.'/../views', 'rapyd');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Collective\Html\HtmlServiceProvider');

        Rapyd::setContainer($this->app);

        $this->app->booting(function () {
            $loader  =  \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Rapyd', 'Zofe\Rapyd\Facades\Rapyd'     );
            $loader->alias('DataFilter', 'Zofe\Rapyd\Facades\DataFilter');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}


