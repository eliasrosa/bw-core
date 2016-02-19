<?php


Route::get('login', 'BW\Controllers\Auth\AuthController@login');
Route::post('login', 'BW\Controllers\Auth\AuthController@authenticate');
Route::get('logout', 'BW\Controllers\Auth\AuthController@logout');
