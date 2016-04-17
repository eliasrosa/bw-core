<?php

//
Route::resource('usuarios', 'BW\Admin\Controllers\UsuariosController', [
    'names' => [
        'index' => 'bw.usuarios.index',
        'create' => 'bw.usuarios.create'
    ]
]);


