<?php

//
Route::get('/', [
    'as' => 'bw.home',
    'uses' => 'BW\Controllers\DashboardController@dashboard',
]);

$except = ['except' => ['show']];

Route::resource('users/groups', '\BW\Controllers\UsersGroupsController', $except);
Route::resource('users', '\BW\Controllers\UsersController', $except);
