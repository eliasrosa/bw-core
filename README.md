# BW PHP Framework
O BW é basicamente um Back-end para Larvel 5.1

## Instalação

```
composer create-project laravel/laravel projeto "5.1.*"
cd projeto
composer require eliasrosa/bw-core "dev-master"
```

Após a instalação do composer, você deve registrar o ServiceProvider

```php
'providers' => [
    ...
    BW\Providers\BwCoreServiceProvider::class,
];
```

Publicando arquivos

```
php artisan vendor:publish
```

Banco de dados

```
php artisan migrate
```

Criando usuário

```
php artisan bw:create-user
```








