<?php

namespace BW\Providers;

use Storage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->createRouter();
        $this->createStorageFolder();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // register service provider
        $this->app->register('Intervention\Image\ImageServiceProvider');

        // Register alias
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Image', 'Intervention\Image\Facades\Image');

        // register command
        $this->commands('BW\Util\Relationships\Image\ImageFilterMakeCommand');
    }

    /**
     * Image Route
     *
     * @return void
     */
    private function createRouter()
    {
        // route to access template applied image file
        $this->app['router']->get('images/{template}/{filename}', [
            'uses' => 'BW\Util\Relationships\Image\ImageController@getResponse',
            'as' => 'images'
        ])->where(array('filename' => '[ \w\\.\\/\\-\\@]+'));
    }

    //
    private function createStorageFolder()
    {
        Storage::makeDirectory(config('bw.images.storage'));
    }
}
