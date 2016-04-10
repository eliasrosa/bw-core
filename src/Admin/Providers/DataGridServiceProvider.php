<?php

namespace BW\Admin\Providers;

use Illuminate\Support\ServiceProvider as ServiceProvider;

class DataGridServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register service provider
        $this->app->register('Zofe\Rapyd\RapydServiceProvider');
    }
}
