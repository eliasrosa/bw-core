<?php

namespace BW\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
        \View::composer('BW::composers.info', 'BW\Composers\InfoComposer');
        \View::composer('BW::composers.menu', 'BW\Composers\MenuComposer');
    }

    public function register()
    {
        //
    }
}
