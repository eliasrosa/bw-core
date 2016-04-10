<?php

namespace BW\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
        \View::composer('BW::composers.info', 'BW\Admin\Composers\InfoComposer');
        \View::composer('BW::composers.menu', 'BW\Admin\Composers\MenuComposer');
    }

    public function register()
    {
        //
    }
}
