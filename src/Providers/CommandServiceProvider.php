<?php

namespace BW\Providers;

use Illuminate\Support\ServiceProvider as ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register comands
        $this->commands('BW\Console\Commands\CreateUser');
        $this->commands('BW\Console\Commands\ListRelationship');
    }
}
