<?php

namespace BW\Providers;

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
        $this->app->alias('image', 'Intervention\Image\ImageManager');

        // create image
        $this->app['image'] = $this->app->share(function ($app) {
            return new ImageManager([
                'driver' => config('bw.images.driver'),
            ]);
        });

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
}
