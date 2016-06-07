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
        'TextArea' => BW\Util\Form\Itens\Fields\TextArea::class,
        'CheckboxActive' => BW\Util\Form\Itens\Fields\CheckboxActive::class,

        // Itens
        'Panel' => BW\Util\Form\Itens\Panel::class,
        'IncludeFile' => BW\Util\Form\Itens\IncludeFile::class,
    ],

    /*
    * -------------------------------------------------------------
    * Middleware
    * -------------------------------------------------------------
    */
    'middleware' => [


        /*
        * -------------------------------------------------------------
        * AclRoutes
        * -------------------------------------------------------------
        */
        'aclroutes' => [
            'ignore_routes' => [
                'bw.home'
            ]
        ]
    ],

    /*
    * -------------------------------------------------------------
    * Menu do admin
    * -------------------------------------------------------------
    */
    'menus' => [
        // Dashboard
        ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'route' => 'bw.home'],

        // Medias
        ['label' => 'Mídias', 'icon' => 'fa fa-film', 'itens' => [
            ['label' => 'Imagens', 'route' => 'bw.media.images.index'],
        ]],


        // Configurações
        ['label' => 'Configurações', 'icon' => 'fa fa-gear', 'itens' => [

            // Usuários
            ['label' => 'Gerenciar usuários', 'itens' => [
                ['label' => 'Usuários', 'route' => 'bw.users.index'],
                ['label' => 'Grupos', 'route' => 'bw.users.groups.index'],
            ]],
        ]],
    ],

];
