<?php

namespace BW\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\View\Factory
 */
class BWFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bw.admin';
    }
}
