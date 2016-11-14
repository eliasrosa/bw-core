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
        'Select' => BW\Util\Form\Itens\Fields\Select::class,
        'Hidden' => BW\Util\Form\Itens\Fields\Hidden::class,
        'Password' => BW\Util\Form\Itens\Fields\Password::class,
        'Checkbox' => BW\Util\Form\Itens\Fields\Checkbox::class,
        'TextArea' => BW\Util\Form\Itens\Fields\TextArea::class,
        'CheckboxActive' => BW\Util\Form\Itens\Fields\CheckboxActive::class,

        // Relationships
        'Image' => BW\Util\Relationships\Image\ImageField::class,

        // Mask
        'Mask' => BW\Util\Form\Itens\Fields\Mask::class,
        'Cep' => BW\Util\Form\Itens\Fields\Cep::class,
        'Cpf' => BW\Util\Form\Itens\Fields\Cpf::class,
        'Cnpj' => BW\Util\Form\Itens\Fields\Cnpj::class,
        'CpfOrCnpj' => BW\Util\Form\Itens\Fields\CpfOrCnpj::class,
        'Integer' => BW\Util\Form\Itens\Fields\Integer::class,
        'Currency' => BW\Util\Form\Itens\Fields\Currency::class,
        'LicensePlate' => BW\Util\Form\Itens\Fields\LicensePlate::class,
        'Telephone' => BW\Util\Form\Itens\Fields\Telephone::class,

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
    * Image/Cache
    * -------------------------------------------------------------
    */
    'images' => [

        // templates filters
        'templates' => [
            'bw-small' => 'BW\Util\Filters\ImageSmallFilter',
        ],

        // caminho das imagens originais
        'storage' => 'bw/images',

        // cache - em minutos
        'lifetime' => 43800,

        // suportado: 'gd', 'imagick'
        'driver' => 'gd',

        // permitir acesso para usuários visitantes ao template 'orginal'
        'allow_acess_original' => false,

        // permitir acesso para usuários visitantes ao template 'download'
        'allow_acess_download' => false,
    ],
];
