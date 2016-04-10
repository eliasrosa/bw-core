<?php

//
Route::resource('/usuarios', 'BW\Admin\Controllers\UsuariosController', [
    'names' => [
        'index' => 'bw.usuarios.index'
    ]
]);


