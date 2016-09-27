<?php

namespace BW;

use BW\Util\Menu\Menu;

class BWAdmin {

    //
    private $menu;

    //
    public function __construct()
    {
        $this->menu = new Menu();
    }

    //
    public function registerMenu($config_key)
    {
        $this->menu->register($config_key);
    }

    //
    public function get($key)
    {
        return $this->{$key};
    }
}
