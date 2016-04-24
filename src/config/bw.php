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
            'Text'           => BW\Admin\Util\Form\Field\Text::class,
            'File'           => BW\Admin\Util\Form\Field\File::class,
            'Email'          => BW\Admin\Util\Form\Field\Email::class,
            'Hidden'         => BW\Admin\Util\Form\Field\Hidden::class,
            'Password'       => BW\Admin\Util\Form\Field\Password::class,
            'Checkbox'       => BW\Admin\Util\Form\Field\Checkbox::class,
            'CheckboxActive' => BW\Admin\Util\Form\Field\CheckboxActive::class,
        ],
    ],

];
