<?php

namespace BW\Controllers\Componentes;

use Config;
use BW\Controllers\Admin;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class Router {


    //
    private $path_root;


    //
    private $path_views;


    //
    private $path_routers;


    //
    private $componente;


    //
    private $namespace_controllers;


    //
    private $router;


    //
    private $config;


    //
    public function __construct($componente, $router){

        //
        $this->router = $router;
        $this->componente = $componente;
        $this->path_root = $this->componente->getPath();
        $this->path_views = $this->path_root . '/Views';
        $this->path_routers = $this->path_root . '/Routers';
        $this->namespace_controllers = $componente->getNamespace() . '\Controllers';

        //
        $this->config = [
            'prefix' => Admin::getUrlPrefix() . '/' . $this->componente->getKey(),
            'namespace' => $this->namespace_controllers,
        ];
    }


    //
    public function map()
    {

        //
        //\View::addNamespace($this->componente->getNamespace(),   $this->path_views);


        $this->router->group($this->config, function () {

            $filesystem = new Filesystem(new Local($this->path_routers));
            $contents = $filesystem->listContents();

            foreach ($contents as $info) {

                if($info['type'] == 'file' && $info['extension'] == 'php'){
                    require $this->path_routers . '/' . $info['path'];
                }

            };

        });
    }


}
