<?php

namespace BW\Admin\Router;

class Router {

    static public function getParameters($type = 'default', $new_params = []){

        $params = [
            'default' => [
                'prefix' => config('bw.url'),
                'middleware' => [
                    'bw.auth',
                    'bw.csrf'
                ]
            ],

            'guest' =>[
                'prefix' => config('bw.url'),
                'middleware' => [
                    'bw.csrf'
                ],
            ],
        ];

        return array_merge($params[$type], $new_params);
    }
}
