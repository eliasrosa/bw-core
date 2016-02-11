<?php

return [

    /*
    * Titulo do painel
    */
    'titulo' => 'Administracão',

    /*
    * URL do painel, é muito recomendável a troca dessa variável
    * para algo mais especifico ao projeto
    */
    'url' => 'admin',

    /*
    * Views
    */
    'views' => [

        /*
        * View login
        */
        'login' => 'BW\Admin::login',

        /*
        * View layout
        */
        'layout' => 'BW\Admin::layout.template',

        /*
        * View menu
        */
        'menu' => 'BW\Admin::layout.menu',

        /*
        * View busca
        */
        'busca' => 'BW\Admin::layout.busca',

        /*
        * View informações
        */
        'info' => 'BW\Admin::layout.info',
    ],
];
