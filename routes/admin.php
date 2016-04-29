<?php

//
Route::get('/', [
    'as' => 'bw.home',
    'uses' => 'BW\Controllers\DashboardController@dashboard',
]);

//
Route::resource('usuarios', 'BW\Controllers\UsuariosController');
