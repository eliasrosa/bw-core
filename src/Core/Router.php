<?php

namespace BW\Core;

class Router {

    static public function register($file){
        $config = SELF::getAll();

        if(!in_array($file, $config)){
            \Config::set('bw.routes', array_merge([$file], $config));
        }
    }

    static public function getAll(){
        return \Config::get('bw.routes', []);
    }
}
