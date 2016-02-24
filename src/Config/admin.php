<?php

return [

    /*
    * -------------------------------------------------------------
    *  Titulo do painel
    * -------------------------------------------------------------
    */
    'titulo' => 'Administracão',

    /*
    * -------------------------------------------------------------
    *  URL do painel, é muito recomendável a troca dessa variável
    *  para algo mais especifico ao projeto
    * -------------------------------------------------------------
    */
    'url' => 'admin',

    /*
    * -------------------------------------------------------------
    *  Views
    * -------------------------------------------------------------
    */
    'views' => [

        // Layout
        'layout' => [
            'template' => 'BW\Admin::layout.template',
            'menu' => 'BW\Admin::layout.menu',
            'busca' => 'BW\Admin::layout.busca',
            'info' => 'BW\Admin::layout.info',
        ],

    ],
];
