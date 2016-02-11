<?php

namespace BW\Core;

class Router {

    static public function register($file, $middleware = 'auth'){
        $config = SELF::getAll($middleware);

        if(!in_array($file, $config)){
            \Config::set('bw.routes.' . $middleware, array_merge([$file], $config));
        }
    }

    static public function getAll($middleware = null){

        if(!is_null($middleware)){
            $middleware = '.' . $middleware;
        }

        return \Config::get('bw.routes' . $middleware, []);
    }
}
