<?php

namespace BW;

use BW\Util\Menu\Menu;
use BW\Util\Relationships\Relationships;

class BWAdmin {

    //
    private $menu;
    private $relations;

    //
    public function __construct()
    {
        $this->menu = new Menu();
        $this->relationships = new Relationships();
    }

    //
    public function registerMenu($config_key)
    {
        $this->menu->register($config_key);
    }

    //
    public function registerRelationships($config_key)
    {
        $this->relationships->register($config_key);
    }

    //
    public function get($key)
    {
        return $this->{$key};
    }
}
