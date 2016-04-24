<?php
namespace BW\Admin\Providers;

use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Routing\Router;

class ResourceNoPrefixRegistrar extends ResourceRegistrar
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    /**
     * Replace prefix config bw.url for bw
     *
     * @param  string  $prefix
     * @param  string  $resource
     * @param  string  $method
     * @return string
     */
    protected function getGroupResourceName($prefix, $resource, $method)
    {
        $name_original = parent::getGroupResourceName($prefix, $resource, $method);
        $name_array = explode('.', $name_original);

        if(config('bw.url') == $name_array[0]){
            $name_array[0] = 'bw';
        }

        //
        $name_fix = join($name_array, '.');

        //
        return $name_fix;
    }
}
