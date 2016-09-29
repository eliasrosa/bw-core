<?php

namespace BW\Util\Container;

class BaseContainer {

    //
    private $data;

    //
    public function __construct()
    {
        $this->data = [];
    }

    //
    public function register($config_key)
    {
        //
        $config = config($config_key, []);

        //
        if(count($config)){
            $this->data[] = $config[0];
        }

        //
        return $this;
    }

    //
    public function get()
    {
        return $this->data;
    }
}
