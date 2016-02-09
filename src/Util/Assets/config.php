<?php

return [

    /*
    * Tempo do cache dos arquivos carregados, em minutos
    */
    'cache' => 0,

    /*
    * Headers 'Content-Type', exemplo
    *
    * 'jpg' => 'image/jpg'
    *
    * ou definido por array
    *
    * 'jpg' => [
    *     'Content-Type' => 'image/jpg',
    *     'Expires' => 'Fri, 12 Jun 2020 05:00:00 GMT'
    *      ...
    * ],
    *
    */
    'types' => [

        // Arquivos comuns
        'jpg' => 'image/jpg',
        'png' => 'image/png',
        'ico' => 'image/x-icon',
        'js'  => 'application/javascript',
        'css' => 'text/css',

        // Arquivos de fontes
        'ttf'   => 'application/x-font-ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'svg'   => 'image/svg+xml',
        'woff'  => 'application/x-font-woff',
        'woff2' => 'application/x-font-woff2',
    ],

    /*
    * Customize seus controllers, exemplo
    * 'js' => 'App\Http\Controllers\Assets\JavascriptController'
    * será executado o method init();
    *
    */
    'controllers' => [],
];
