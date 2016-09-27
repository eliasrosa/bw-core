<?php

namespace BW\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
        \View::composer('BW::composers.info', 'BW\Views\Composers\InfoComposer');
        \View::composer('BW::composers.menu', 'BW\Views\Composers\MenuComposer');
    }

    public function register()
    {
        //
    }
}
