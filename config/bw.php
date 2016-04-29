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

        // fields
        'Text' => BW\Util\Form\Itens\Fields\Text::class,
        'File' => BW\Util\Form\Itens\Fields\File::class,
        'Email' => BW\Util\Form\Itens\Fields\Email::class,
        'Hidden' => BW\Util\Form\Itens\Fields\Hidden::class,
        'Password' => BW\Util\Form\Itens\Fields\Password::class,
        'Checkbox' => BW\Util\Form\Itens\Fields\Checkbox::class,
        'CheckboxActive' => BW\Util\Form\Itens\Fields\CheckboxActive::class,

        // Itens
        'Panel' => BW\Util\Form\Itens\Panel::class,
    ],

];
