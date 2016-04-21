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
    * Views
    * -------------------------------------------------------------
    */
    'views' => [
        'login' => [
            'email' => 'BW::login.email'
        ]
    ],

    /*
    * -------------------------------------------------------------
    * Form/Fields
    * -------------------------------------------------------------
    */
    'form' => [
        'field' => [
            'text' => BW\Admin\Util\Form\Field\Text::class,
            'email' => BW\Admin\Util\Form\Field\Email::class,
            'password' => BW\Admin\Util\Form\Field\Password::class,
            'file' => BW\Admin\Util\Form\Field\File::class,
        ],
    ],

];
