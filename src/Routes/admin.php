<?php

//
Route::get('/', ['as' => 'home', 'uses' => 'BW\Controllers\DashboardController@dashboard']);

//
Route::resource('/configuracoes/usuarios', 'BW\Controllers\UsuariosController', [
    'names' => [
        'index' => 'bw.config.usuarios.index'
    ]
]);


