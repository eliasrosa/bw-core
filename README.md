# BW PHP Framework
O BW é basicamente um Back-End para Larvel 5.1

### Instalação

```
composer create-project laravel/laravel projeto "5.1.*"
cd projeto
composer require eliasrosa/bw-core
```

Após a instalação do composer, você deve registrar o ServiceProvider

```php
'providers' => [
    ...
    BW\Providers\BwCoreServiceProvider::class,
];
```

### Publicando arquivos
É importante o uso do parâmetro "--force" para forçar a substituição do arquivo 'config/auth.php' 

```
php artisan vendor:publish --force
```

### Banco de dados

```
php artisan migrate
```

### Criando usuário 'admin'

```
php artisan bw:create-user
```

### Acessando o painel administrativo
<http://[web-app]/admin>





